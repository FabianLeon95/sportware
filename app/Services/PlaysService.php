<?php


namespace App\Services;


use App\Models\Foul;
use App\Models\Fumble;
use App\Models\Kick;
use App\Models\Match;
use App\Models\Penalty;
use App\Models\Play;
use App\Models\Recovery;
use App\Models\ReturnPlay;
use App\Models\Tackle;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PlaysService
{
    private $kickOffYardLine = 30;
    private $touchbackYardLine = 20;
    private $touchdownPoint = 6;

    public function init(Match $match): void
    {
        $play = Play::where('match_id', $match->id);
        if (!$play->exists()) {
            $this->clearState();
            $playId = Str::uuid();
            Session::put('play_id', $playId);
            Play::create([
                'id' => $playId,
                'match_id' => $match->id,
                'team_id' => $match->homeTeam->id,
                'left_team_id' => $match->home_team_id,
                'right_team_id' => $match->visit_team_id,
                'down' => 1,
                'to_go' => 10,
                'ball_on' => $this->kickOffYardLine,
                'quarter' => 1,
                'home_points' => 0,
                'visit_points' => 0,
            ]);
        }
    }

    public function clearState()
    {
        Session::put('play_id', null);
        Session::put('match_id', null);
        Session::put('team_id', null);
        Session::put('down', null);
        Session::put('to_go', null);
        Session::put('ball_on', null);
        Session::put('quarter', null);
        Session::put('home_points', null);
        Session::put('visit_points', null);
        Session::put('left_team_id', null);
        Session::put('right_team_id', null);
    }

    public function currentPlay(Match $match): Play
    {
        $play = Play::where('match_id', $match->id)->latest()->first();
        return $play;
    }

    public function score(Match $match)
    {
        $score = [
            'home' => Play::where('match_id', $match->id)->sum('home_points'),
            'visit' => Play::where('match_id', $match->id)->sum('visit_points')
        ];

        return $score;
    }

    public function kick(Request $request, Match $match)
    {
        if ($request->kickoff) {
            $this->playStartup($match);
            $newBallOn = $request->ball_on + $request->yards;

            if ($request->team == Session::get('left_team_id')) {
                if ($newBallOn >= 100) {
                    Session::put('ball_on', 100 - $this->touchbackYardLine);
                } else {
                    Session::put('ball_on', $newBallOn);
                }
            } else {
                if ($newBallOn <= 0) {
                    Session::put('ball_on', 0 + $this->touchbackYardLine);
                } else {
                    Session::put('ball_on', $newBallOn);
                }
            }

            $specials = collect($request->specials);
            if ($specials->contains('no_return') || $specials->contains('touchback')) {
                Session::put('specials', $specials->reverse());
            } else {
                Session::put('specials', $specials->reverse()->push('return'));
            }

            Kick::create([
                'match_id' => $match->id,
                'play_id' => Session::get('play_id'),
                'team_id' => $request->team,
                'kicker_id' => $request->kicker,
                'yards' => ($request->team == $match->left_team_id) ? $request->yards : ($request->yards * -1),
                'type' => 'kickoff'
            ]);

            Session::put('switch_team', $request->team);
            Session::put('team_start', $request->team);
        }
    }

    public function return(Request $request, Match $match)
    {
        $play = $this->getPlayStatus();
        Session::put('team_start', $request->team);
        $specials = collect($request->specials)->reverse();
        $newBallOn = $request->ball_on + $request->yards;
        $touchdown = 0;

        if ($request->team == Session::get('left_team_id')) {
            if ($newBallOn >= 100) {
                $this->addPoints($match, $request->team, $this->touchdownPoint);
                $specials->push('point_after');
                Session::put('ball_on', 100 - $this->touchbackYardLine);
                $touchdown = 1;
            } else {
                // Hay tackle a menos que haya fair catch o fumble
                if (!($specials->contains('fair_catch') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                Session::put('ball_on', $newBallOn);
            }
        } else {
            if ($newBallOn <= 0) {
                $this->addPoints($match, $request->team, $this->touchdownPoint);
                $specials->push('point_after');
                Session::put('ball_on', 0 + $this->touchbackYardLine);
                $touchdown = 1;
            } else {
                // Hay tackle a menos que haya fair catch
                if (!($specials->contains('fair_catch') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                Session::put('ball_on', $newBallOn);
            }
        }

        ReturnPlay::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'yards' => ($request->team == $match->left_team_id) ? $request->yards : ($request->yards * -1),
            'touchdown' => $touchdown
        ]);

        $currentSpecials = Session::get('specials');
        Session::put('specials', $currentSpecials->concat($specials));
    }

    public function tackle(Request $request, Match $match)
    {
        $play = $this->getPlayStatus();
        Tackle::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'tackler_id' => $request->tackler,
            'assist_id' => $request->assist != -1 ? $request->assist : null
        ]);
    }

    public function fumble(Request $request, Match $match)
    {
        $play = $this->getPlayStatus();
        Fumble::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'caused_by_id' => $request->caused_by,
        ]);

        $specials = collect(Session::get('specials'))->push('recovery');
        Session::put('specials', $specials);
    }

    public function recovery(Request $request, Match $match)
    {
        $play = $this->getPlayStatus();
        Session::put('team_start', $request->team);
        $touchdown = 0;

        $specials = collect($request->specials)->reverse();

        $newBallOn = $request->ball_on + $request->yards;

        if ($request->team == Session::get('left_team_id')) {
            if ($newBallOn >= 100) {
                $this->addPoints($match, $request->team, $this->touchdownPoint);
                $specials->push('point_after');
                Session::put('ball_on', 100 - $this->touchbackYardLine);
                $touchdown = 1;
            } else {
                // Hay tackle a menos que haya fair catch o fumble
                if (!($specials->contains('fair_catch') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                Session::put('ball_on', $newBallOn);
            }
        } else {
            if ($newBallOn <= 0) {
                $this->addPoints($match, $request->team, $this->touchdownPoint);
                $specials->push('point_after');
                Session::put('ball_on', 0 + $this->touchbackYardLine);
                $touchdown = 1;
            } else {
                // Hay tackle a menos que haya fair catch
                if (!($specials->contains('fair_catch') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                Session::put('ball_on', $newBallOn);
            }
        }

        Recovery::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'recover_id' => $request->recover,
            'yards' => ($request->team == $match->left_team_id) ? $request->yards : ($request->yards * -1),
            'touchdown' => $touchdown
        ]);

        $currentSpecials = Session::get('specials');
        Session::put('specials', $currentSpecials->concat($specials));
    }

    public function penalty(Request $request, Match $match)
    {
        if ($request->before_snap) {
            $this->playStartup($match);
        }
        $play = $this->getPlayStatus();

        if ($request->home_foul != -1) {
            $foul = Foul::find($request->home_foul);
            if ($play->left_team->id == $match->home_team_id) {
                Session::put('ball_on', Session::get('ball_on') - $foul->distance);
            } else {
                Session::put('ball_on', Session::get('ball_on') + $foul->distance);
            }
            Penalty::create([
                'match_id' => $match->id,
                'play_id' => $play->id,
                'team_id' => $match->home_team_id,
                'foul_id' => $request->home_foul,
            ]);
        }
        if ($request->visit_foul != -1) {
            $foul = Foul::find($request->visit_foul);
            if ($play->left_team->id == $match->visit_team_id) {
                Session::put('ball_on', Session::get('ball_on') - $foul->distance);
            } else {
                Session::put('ball_on', Session::get('ball_on') + $foul->distance);
            }
            Penalty::create([
                'match_id' => $match->id,
                'play_id' => $play->id,
                'team_id' => $match->visit_team_id,
                'foul_id' => $request->visit_foul,
            ]);
        }

        $currentPlay = $this->currentPlay($match);
        if ($currentPlay->team_id === $currentPlay->left_team_id) {
            $toGo = $currentPlay->to_go;
            $advanced = Session::get('ball_on') - $currentPlay->ball_on;
            if ($advanced < $toGo) {
                Session::put('to_go', $toGo - $advanced);
                Session::put('down', (int)$currentPlay->down + 1);
            }
        } else {
            $toGo = $currentPlay->to_go;
            $advanced = $currentPlay->ball_on - Session::get('ball_on');
            if ($advanced < $toGo) {
                Session::put('to_go', $toGo - $advanced);
                Session::put('down', (int)$currentPlay->down + 1);
            }
        }
    }

    public function playStartup(Match $match)
    {
        $play = $this->currentPlay($match);


        Session::put('play_id', Str::uuid());
        Session::put('match_id', $play->match_id);
        Session::put('team_id', $play->team_id);
        Session::put('down', $play->down);
        Session::put('to_go', $play->to_go);
        Session::put('ball_on', $play->ball_on);
        Session::put('quarter', $play->quarter);
        Session::put('home_points', 0);
        Session::put('visit_points', 0);

        if (!(Session::get('left_team_id') || Session::get('right_team_id'))) {
            Session::put('left_team_id', $play->left_team_id);
            Session::put('right_team_id', $play->right_team_id);
        }
    }

    public function endPlay(Match $match)
    {
        if ($team = Session::get('switch_team', false)) {
            Session::put('down', 1);
            Session::put('to_go', 10);
            Session::put('switch_team', false);
            if ($team == $match->home_team_id) {
                Session::put('team_id', $match->visit_team_id);
            } else {
                Session::put('team_id', $match->home_team_id);
            }
        }

        Play::create([
            'id' => Session::get('play_id'),
            'match_id' => $match->id,
            'team_id' => Session::get('team_id'),
            'left_team_id' => Session::get('left_team_id'),
            'right_team_id' => Session::get('right_team_id'),
            'down' => Session::get('down'),
            'to_go' => Session::get('to_go'),
            'ball_on' => Session::get('ball_on'),
            'quarter' => Session::get('quarter'),
            'home_points' => Session::get('home_points'),
            'visit_points' => Session::get('visit_points')
        ]);
    }

    public function getPlayStatus()
    {
        $play = (object)array(
            'id' => Session::get('play_id'),
            'match_id' => Session::get('match_id'),
            'team_id' => Session::get('team_id'),
            'left_team' => Team::find(Session::get('left_team_id')),
            'right_team' => Team::find(Session::get('right_team_id')),
            'down' => Session::get('down'),
            'to_go' => Session::get('to_go'),
            'ball_on' => Session::get('ball_on'),
            'quarter' => Session::get('quarter'),
            'home_points' => Session::get('home_points'),
            'visit_points' => Session::get('visit_points')
        );
        return $play;
    }

    public function swapTeams()
    {
        $right = Session::get('left_team_id');
        $left = Session::get('right_team_id');
        Session::put('left_team_id', $left);
        Session::put('right_team_id', $right);
    }

    public function getKickOffYardLine($team)
    {
        if (Session::get('left_team_id') == $team) {
            return 30;
        } else {
            return 70;
        }
    }

    public function addPoints(Match $match, $teamId, $points): void
    {
        if ($teamId == $match->home_team_id) {
            Session::put('home_points', Session::get('home_points') + $points);
        } else {
            Session::put('visit_points', Session::get('visit_points') + $points);
        }
    }

}