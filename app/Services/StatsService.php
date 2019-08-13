<?php


namespace App\Services;


use App\Models\Fumble;
use App\Models\Interception;
use App\Models\Kick;
use App\Models\Match;
use App\Models\Pass;
use App\Models\Penalty;
use App\Models\Play;
use App\Models\Punt;
use App\Models\Run;

class StatsService
{
    public function teamStatComparision(Match $match)
    {
        $boxScore = $this->boxScore($match);
        $offense = [
            'home' => $this->offense($match, $match->home_team_id),
            'visit' => $this->offense($match, $match->visit_team_id),
        ];
        $passing = [
            'home' => $this->passing($match, $match->home_team_id),
            'visit' => $this->passing($match, $match->visit_team_id),
        ];
        $rushing = [
            'home' => $this->rushing($match, $match->home_team_id),
            'visit' => $this->rushing($match, $match->visit_team_id),
        ];
        $penalties = [
            'home' => $this->penalties($match, $match->home_team_id),
            'visit' => $this->penalties($match, $match->visit_team_id),
        ];
        $turnovers = [
            'home' => $this->turnover($match, $match->home_team_id),
            'visit' => $this->turnover($match, $match->visit_team_id),
        ];
        $punts = [
            'home' => $this->punts($match, $match->home_team_id),
            'visit' => $this->punts($match, $match->visit_team_id),
        ];
        $sacks = [
            'home' => $this->defensiveSacks($match, $match->home_team_id),
            'visit' => $this->defensiveSacks($match, $match->visit_team_id),
        ];
        $firstDowns = [
            'home' => $this->firstDowns($match, $match->home_team_id),
            'visit' => $this->firstDowns($match, $match->visit_team_id),
        ];
        $thirdDownConversions = [
            'home' => $this->downConversions($match, $match->home_team_id, 3),
            'visit' => $this->downConversions($match, $match->visit_team_id, 3),
        ];
        $fourthDownConversions = [
            'home' => $this->downConversions($match, $match->home_team_id, 4),
            'visit' => $this->downConversions($match, $match->visit_team_id, 4),
        ];

        $result = compact('boxScore', 'offense', 'passing', 'rushing', 'penalties', 'turnovers', 'punts', 'sacks', 'firstDowns', 'thirdDownConversions', 'fourthDownConversions');

        return $result;
    }

    public function boxScore(Match $match)
    {
        $score = Play::where('match_id', $match->id)
            ->where('quarter', '!=', 5)
            ->groupBy('quarter')->selectRaw('sum(home_points) as home_points, sum(visit_points) as visit_points, quarter')
            ->orderBy('quarter')
            ->get();

        return ['home_total' => $score->sum('home_points'), 'visit_total' => $score->sum('visit_points'), 'quarters' => $score->toArray()];
    }

    public function offense(Match $match, $team_id)
    {
        $runs = Run::where('match_id', $match->id)
            ->where('team_id', $team_id)->groupBy('team_id')
            ->selectRaw('count(*) as number_of_plays, sum(yards) as total_offense, avg(yards) as yards_per_play, team_id')->first();

        $passes = Pass::where('match_id', $match->id)
            ->where('team_id', $team_id)->groupBy('team_id')
            ->selectRaw('count(*) as number_of_plays, sum(yards) as total_offense, avg(yards) as yards_per_play, team_id')->first();

        $numberOfPlays = 0;
        $totalOffense = 0;
        $yardsPerPlay = 0;

        if ($runs) {
            $numberOfPlays += $runs->number_of_plays;
            $totalOffense += $runs->total_offense;
            $yardsPerPlay += $runs->yards_per_play;
        }
        if ($passes) {
            $numberOfPlays += $passes->number_of_plays;
            $totalOffense += $passes->total_offense;
            $yardsPerPlay += $passes->yards_per_play;
        }

        $offense = [
            'number_of_plays' => $numberOfPlays,
            'total_offense' => $totalOffense,
            'yards_per_play' => $yardsPerPlay/2
        ];

        return $offense;

    }

    public function passing(Match $match, $team_id)
    {
        $passes = Pass::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->groupBy('team_id')
            ->selectRaw("
            sum(yards) as passing,
            count(*) as attempts,
            sum(DISTINCT case when status_id = 1 then 1 else 0 end) as completions,
            sum(DISTINCT case when status_id = 3 then 1 else 0 end) as interceptions,
            sum(touchdown) as touchdowns,
            avg(yards) as yards_per_pass")->first();

        if ($passes) {
            $passes = $passes->toArray();
        } else {
            $passes = [
                'passing' => 0,
                'attempts' => 0,
                'completions' => 0,
                'interceptions' => 0,
                'touchdowns' => 0,
                'yards_per_pass' => 0
            ];
        }


        return $passes;
    }

    public function rushing(Match $match, $team_id)
    {
        $runs = Run::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->groupBy('team_id')
            ->selectRaw("
            sum(yards) as rushing,
            count(*) as rushing_attempts,
            sum(touchdown) as touchdowns,
            avg(yards) as yards_per_rush")->first();

        if ($runs){
            $runs = $runs->toArray();
        } else {
            $runs = [
                'rushing' => 0,
                'rushing_attempts' => 0,
                'touchdowns' => 0,
                'yards_per_rush' => 0
            ];
        }

        return $runs;
    }

    public function penalties(Match $match, $team_id)
    {
        $penalties = Penalty::where('penalties.match_id', $match->id)
            ->where('penalties.team_id', $team_id)
            ->join('fouls', 'penalties.foul_id', '=', 'fouls.id')
            ->groupBy('penalties.team_id')
            ->selectRaw('count(penalties.id) as penalties, sum(fouls.distance) as yards_loss')->first();

        if ($penalties){
            $penalties = $penalties->toArray();
        } else {
            $penalties = [
                'penalties' => 0,
                'yards_loss' => 0
            ];
        }

        return $penalties;
    }

    public function turnover(Match $match, $team_id)
    {
        $fumbles = Fumble::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->selectRaw('count(*) as count')->get()->first();

        $interceptions = Interception::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->selectRaw('count(*) as count')->get()->first();

        return [
            'turnovers' => $fumbles->count + $interceptions->count,
            'fumbles' => $fumbles->count,
            'interceptions' => $interceptions->count
        ];
    }

    public function punts(Match $match, $team_id)
    {
        $punts = Punt::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->selectRaw('count(*) as attempts, avg(yards) as average_distance')->first()->toArray();

        return $punts;
    }

    public function defensiveSacks(Match $match, $team_id)
    {
        if ($match->home_team_id == $team_id) {
            $opposing_team = $match->visit_team_id;
        } else {
            $opposing_team = $match->home_team_id;
        }

        $sacks = Pass::where('match_id', $match->id)
            ->where('team_id', $opposing_team)
            ->where('status_id', 4)
            ->selectRaw('count(*) as defensive_sacks, avg(abs(yards)) as yards')->first()->toArray();

        return $sacks;
    }

    public function downConversions(Match $match, $team_id, $down)
    {
        $plays = Play::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->orderBy('created_at')->get();

        $attempts = 0;
        $conversions = 0;

        for ($i = 0; $i < count($plays); $i++) {
            if ($plays[$i]->down == $down) {
                $attempts++;
                if (($i + 1) < count($plays)) {
                    if ($plays[$i + 1]->down == 1) {
                        $conversions++;
                    }
                }
            }
        }

        $percentage = ($attempts != 0) ? ($conversions / $attempts) * 100 : 0;

        return ['attempts' => $attempts, 'conversions' => $conversions, 'percentage' => $percentage];

    }

    public function firstDowns(Match $match, $team_id)
    {
        $firstDowns = Play::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->where('down', 1)->selectRaw('count(*) first_downs')->first();

        $kickoffs = Kick::where('match_id', $match->id)
            ->where('team_id', $team_id)
            ->where('type', 'kickoff')->selectRaw('count(*) kickoffs')->first();

        return $firstDowns->first_downs - $kickoffs->kickoffs;
    }
}