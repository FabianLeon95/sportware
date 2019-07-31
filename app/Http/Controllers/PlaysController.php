<?php

namespace App\Http\Controllers;

use App\Models\FieldGoal;
use App\Models\Foul;
use App\Models\Interception;
use App\Models\Kick;
use App\Models\Match;
use App\Models\Pass;
use App\Models\PassStatus;
use App\Models\Player;
use App\Models\Punt;
use App\Models\Run;
use App\Models\Team;
use App\Services\PlayDescriptionService;
use App\Services\PlaysService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PlaysController extends Controller
{

    private $kickOffYardLine = 30;
    private $touchbackYardLine = 20;
    private $ps;

    public function __construct(PlaysService $ps)
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats');
        $this->ps = $ps;
    }

    public function index(Match $match)
    {
        $this->ps->init($match);
        $this->ps->playStartup($match);
        $play = $this->ps->getPlayStatus();
        $score = $this->ps->score($match);

        return view('plays.index', compact('play', 'match', 'score'));
    }

    public function swap()
    {
        $this->ps->swapTeams();
        return redirect()->back();
    }

    public function playsTesting(Match $match)
    {
        $pds = new PlayDescriptionService();
        $pds->plays($match);
    }

    public function kickOff(Match $match)
    {
        $play = $this->ps->getPlayStatus();
        return view('plays.kickoff', compact('match', 'play'));
    }

    public function kick(Request $request, Match $match)
    {
        $this->ps->kick($request, $match);
        return $this->specialRedirect($match);
    }

    public function returnForm(Match $match)
    {
        $play = $this->ps->getPlayStatus();

        $startTeam = Session::get('team_start', false);

        if ($startTeam == $match->home_team_id) {
            $team = Team::find($match->visit_team_id);
        } else {
            $team = Team::find($match->home_team_id);
        }

        $players = Player::where('team_id', $team->id)->get();

//        Session::put('team_start', $team->id);

        return view('plays.return', compact('match', 'play', 'team', 'players'));
    }

    public function return(Request $request, Match $match)
    {
        $this->ps->return($request, $match);
        return $this->specialRedirect($match);
    }

    public function tackleForm(Match $match)
    {

        $startTeam = Session::get('team_start', false);

        if ($startTeam == $match->home_team_id) {
            $team = Team::find($match->visit_team_id);
        } else {
            $team = Team::find($match->home_team_id);
        }

        $players = Player::where('team_id', $team->id)->get();

        return view('plays.tackle', compact('match', 'team', 'players'));
    }

    public function tackle(Request $request, Match $match)
    {
        $this->ps->tackle($request, $match);
        return $this->specialRedirect($match);
    }

    public function fumbleForm(Match $match)
    {
        $startTeam = Session::get('team_start', false);

        if ($startTeam == $match->home_team_id) {
            $team = Team::find($match->visit_team_id);
        } else {
            $team = Team::find($match->home_team_id);
        }

        $players = Player::where('team_id', $team->id)->get();

        Session::put('switch_team', $startTeam);

        return view('plays.fumble', compact('match', 'team', 'players'));
    }

    public function fumble(Request $request, Match $match)
    {
        $this->ps->fumble($request, $match);
        return $this->specialRedirect($match);
    }

    public function recoveryForm(Match $match)
    {
        $play = $this->ps->getPlayStatus();

        $startTeam = Session::get('team_start', false);

        if ($startTeam == $match->home_team_id) {
            $team = Team::find($match->visit_team_id);
        } else {
            $team = Team::find($match->home_team_id);
        }

        $players = Player::where('team_id', $team->id)->get();

//        Session::put('team_start', $team->id);

        return view('plays.recovery', compact('match', 'play', 'team', 'players'));
    }

    public function recovery(Request $request, Match $match)
    {
        $this->ps->recovery($request, $match);
        return $this->specialRedirect($match);
    }

    public function passForm(Match $match)
    {
        $play = $this->ps->getPlayStatus();
        $team = Team::find($play->team_id);
        $statuses = PassStatus::all();
        $players = Player::where('team_id', $play->team_id)->get();
        return view('plays.pass', compact('match', 'play', 'players', 'team', 'statuses'));
    }

    public function getPlayResult(Request $request, $multiplier)
    {
        $newBallOn = $request->ball_on + $request->yards;
        $outDown = false;
        $toGo = Session::get('to_go');
        $down = Session::get('down');

        if (($request->yards * $multiplier) >= $toGo) {
            Session::put('to_go', 10);
            Session::put('down', 1);
        } else {
            if ($down >= 4) {
                $outDown = true;
            } else {
                Session::put('to_go', $toGo - ($request->yards * $multiplier));
                Session::put('down', ++$down);
            }
        }
        Session::put('ball_on', $newBallOn);

        return $outDown;
    }

    public function evaluateTeamSidePlay(Request $request, Match $match, Collection $specials)
    {
        $newBallOn = $request->ball_on + $request->yards;
        $outDown = false;
        $touchdown = 0;

        if ($request->team == Session::get('left_team_id')) {
            if ($newBallOn >= 100) {
                $touchdown = 1;
                $this->ps->addPoints($match, $request->team, 6);
                Session::put('ball_on', 0 + $this->kickOffYardLine);
            } else {
                $outDown = $this->getPlayResult($request, 1);
            }
        } else {
            if ($newBallOn <= 0) {
                $touchdown = 1;
                $this->ps->addPoints($match, $request->team, 6);
                $specials->push('point_after');
                Session::put('ball_on', 100 - $this->kickOffYardLine);
            } else {
                $outDown = $this->getPlayResult($request, -1);
            }
        }

        return collect(['touchdown' => $touchdown, 'outDown' => $outDown]);
    }

    public function pass(Request $request, Match $match)
    {
        $this->ps->playStartup($match);
        $specials = collect($request->specials)->reverse();
        $playResult = $this->evaluateTeamSidePlay($request, $match, $specials);

        $outDown = $playResult->get('outDown');
        $touchdown = $playResult->get('touchdown');

        switch ($request->status) {
            case 1: // Comp
                if (!($specials->contains('touch_down') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                if ($outDown) {
                    Session::put('switch_team', $request->team);
                }
                break;
            case 2: // Incomp
                Session::put('ball_on', $request->ball_on);
                if ($outDown) {
                    Session::put('switch_team', $request->team);
                }
                break;
            case 3: // Int
                $specials->push('interception');
                break;
            case 4: // Sack
                if (!($specials->contains('touch_down') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                if ($outDown) {
                    Session::put('switch_team', $request->team);
                }
                break;
            default:
                break;
        }

        $play = $this->ps->getPlayStatus();

        Pass::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'passer_id' => $request->passer,
            'receiver_id' => $request->receiver,
            'yards' => ($request->team == $play->left_team->id) ? $request->yards : ($request->yards * -1),
            'status_id' => $request->status,
            'touchdown' => $touchdown
        ]);

        Session::put('specials', $specials);
        Session::put('team_start', $request->team);

        return $this->specialRedirect($match);
    }

    public function interceptionForm(Match $match)
    {
        $play = $this->ps->getPlayStatus();

        $startTeam = Session::get('team_start', false);

        if ($startTeam == $match->home_team_id) {
            $team = Team::find($match->visit_team_id);
        } else {
            $team = Team::find($match->home_team_id);
        }

        $players = Player::where('team_id', $team->id)->get();

        return view('plays.interception', compact('match', 'play', 'team', 'players'));
    }

    public function interception(Request $request, Match $match)
    {
        $play = $this->ps->getPlayStatus();
        Session::put('switch_team', Session::get('team_start'));
        Session::put('team_start', $request->team);
        $touchdown = 0;

        $specials = collect($request->specials)->reverse();

        $newBallOn = $request->ball_on + $request->yards;

        if ($request->team == Session::get('left_team_id')) {
            if ($newBallOn >= 100) {
                $this->ps->addPoints($match, $request->team, 6);
                $specials->push('point_after');
                Session::put('ball_on', 100 - $this->touchbackYardLine);
                $touchdown = 1;
            } else {
                // Hay tackle a menos que haya fair catch o fumble
                if (!($specials->contains('touch_down') || $specials->contains('fumble'))) {
                    $specials->push('tackle');
                }
                Session::put('ball_on', $newBallOn);
            }
        } else {
            if ($newBallOn <= 0) {
                $this->ps->addPoints($match, $request->team, 6);
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

        Interception::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'interceptor_id' => $request->interceptor,
            'yards' => ($request->team == $play->left_team->id) ? $request->yards : ($request->yards * -1),
            'touchdown' => $touchdown
        ]);

        $currentSpecials = Session::get('specials');
        Session::put('specials', $currentSpecials->concat($specials));

        return $this->specialRedirect($match);
    }

    public function runForm(Match $match)
    {
        $play = $this->ps->getPlayStatus();
        $team = Team::find($play->team_id);
        $players = Player::where('team_id', $play->team_id)->get();
        return view('plays.run', compact('match', 'play', 'players', 'team'));
    }

    public function run(Request $request, Match $match)
    {
        $this->ps->playStartup($match);
        $specials = collect($request->specials)->reverse();
        $playResult = $this->evaluateTeamSidePlay($request, $match, $specials);

        $outDown = $playResult->get('outDown');
        $touchdown = $playResult->get('touchdown');

        if (!($specials->contains('touch_down') || $specials->contains('fumble'))) {
            $specials->push('tackle');
        }
        if ($outDown) {
            Session::put('switch_team', $request->team);
        }

        $play = $this->ps->getPlayStatus();

        Run::create([
            'match_id' => $match->id,
            'play_id' => $play->id,
            'team_id' => $request->team,
            'runner_id' => $request->runner,
            'yards' => ($request->team == $play->left_team->id) ? $request->yards : ($request->yards * -1),
            'touchdown' => $touchdown
        ]);

        Session::put('specials', $specials);
        Session::put('team_start', $request->team);

        return $this->specialRedirect($match);

    }

    public function pointAfterForm(Match $match)
    {
        $startTeam = Session::get('team_start', false);
        $team = Team::find($startTeam);
        $players = Player::where('team_id', $team->id)->get();

        return view('plays.point_after', compact('match', 'team', 'players'));
    }

    public function pointAfter(Request $request, Match $match)
    {
        switch ($request->type) {
            case 'kick':
                $kick = Kick::create([
                    'match_id' => $match->id,
                    'play_id' => Session::get('play_id'),
                    'team_id' => $request->team,
                    'kicker_id' => $request->kicker,
                    'yards' => 0,
                    'type' => 'point_after'
                ]);
                if ($request->status == 'good') {
                    $this->ps->addPoints($match, $request->team, 1);
                    $kick->update([
                        'yards' => 2,
                    ]);
                    $kick->save();
                }
                break;

            case 'run':
                $run = Run::create([
                    'match_id' => $match->id,
                    'play_id' => Session::get('play_id'),
                    'team_id' => $request->team,
                    'runner_id' => $request->runner,
                    'yards' => 0,
                    'touchdown' => 0
                ]);
                if ($request->status == 'good') {
                    $this->ps->addPoints($match, $request->team, 2);
                    $run->update([
                        'yards' => 2,
                    ]);
                    $run->save();
                }
                break;

            case 'pass':
                $pass = Run::create([
                    'match_id' => $match->id,
                    'play_id' => Session::get('play_id'),
                    'team_id' => $request->team,
                    'passer_id' => $request->passer,
                    'receiver_id' => $request->receiver,
                    'yards' => 0,
                    'status_id' => 'incomp',
                    'special_id' => 0
                ]);
                if ($request->status == 'good') {
                    $this->ps->addPoints($match, $request->team, 2);
                    $pass->update([
                        'yards' => 2,
                        'status_id' => 'comp',
                    ]);
                    $pass->save();
                }
                break;
        }
        return $this->specialRedirect($match);
    }

    public function puntForm(Match $match)
    {
        $this->ps->playStartup($match);
        $play = $this->ps->getPlayStatus();
        $team = Team::find($play->team_id);
        $players = Player::where('team_id', $team->id)->get();

        return view('plays.punt', compact('match', 'play', 'team', 'players'));
    }

    public function punt(Request $request, Match $match)
    {
        $this->ps->playStartup($match);
        $play = $this->ps->getPlayStatus();
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

        Punt::create([
            'match_id' => $match->id,
            'play_id' => Session::get('play_id'),
            'team_id' => $request->team,
            'kicker_id' => $request->kicker,
            'yards' => ($request->team == $play->left_team->id) ? $request->yards : ($request->yards * -1),
        ]);

        Session::put('switch_team', $request->team);
        Session::put('team_start', $request->team);

        return $this->specialRedirect($match);
    }

    public function fieldGoalForm(Match $match)
    {
        $this->ps->playStartup($match);
        $play = $this->ps->getPlayStatus();
        $team = Team::find($play->team_id);
        $players = Player::where('team_id', $team->id)->get();

        return view('plays.field_goal', compact('match', 'play', 'team', 'players'));
    }

    public function fieldGoal(Request $request, Match $match)
    {
        $this->ps->playStartup($match);
        $newBallOn = $request->ball_on + $request->yards;
        $good = 0;

        if ($request->team == Session::get('left_team_id')) {
            if (($newBallOn >= 100) && ($request->status == 1)) {
                $this->ps->addPoints($match, $request->team, 3);
                Session::put('ball_on', 0 + $this->kickOffYardLine);
                $good = 1;
            } else {
                Session::put('ball_on', $request->ball_on);
                Session::put('switch_team', $request->team);
            }
        } else {
            if (($newBallOn <= 0) && ($request->status == 1)) {
                $this->ps->addPoints($match, $request->team, 3);
                Session::put('ball_on', 100 - $this->kickOffYardLine);
                $good = 1;
            } else {
                Session::put('ball_on', $request->ball_on);
                Session::put('switch_team', $request->team);
            }
        }

        FieldGoal::create([
            'match_id' => $match->id,
            'play_id' => Session::get('play_id'),
            'team_id' => $request->team,
            'kicker_id' => $request->kicker,
            'good' => $good
        ]);

        return $this->specialRedirect($match);
    }

    public function penaltyForm(Match $match)
    {
        $fouls = Foul::all();
        return view('plays.penalty', compact('match', 'fouls'));
    }

    public function penaltyBsForm(Match $match)
    {
        $fouls = Foul::all();
        return view('plays.penalty_before_snap', compact('match', 'fouls'));
    }

    public function penalty(Request $request, Match $match)
    {
        $this->ps->penalty($request, $match);
        return $this->specialRedirect($match);
    }

    public function specialRedirect(Match $match)
    {
        $specials = Session::get('specials');
        if ($special = $specials->pop()) {
            switch ($special) {
                case 'touchback':
                    return $this->specialRedirect($match);
                case 'penalty':
                    return redirect()->route('plays.penalty', $match);
                case 'return':
                    return redirect()->route('plays.return', $match);
                case 'no_return':
                    return $this->specialRedirect($match);
                case 'tackle':
                    return redirect()->route('plays.tackle', $match);
                case 'point_after':
                    return redirect()->route('plays.point-after', $match);
                case 'fumble':
                    return redirect()->route('plays.fumble', $match);
                case 'recovery':
                    return redirect()->route('plays.recovery', $match);
                case 'touch_down':
                    return $this->specialRedirect($match);
                case 'interception':
                    return redirect()->route('plays.interception', $match);
                default:
                    return $this->specialRedirect($match);
            }
        }
        $this->ps->endPlay($match);
        return redirect()->route('plays.index', $match);
    }

    public function getKickOffYardLine($team)
    {
        return $this->ps->getKickOffYardLine($team);
    }

}
