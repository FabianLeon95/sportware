<?php


namespace App\Services;


use App\Models\Kick;
use App\Models\Match;
use App\Models\Play;
use App\Models\ReturnPlay;
use App\Models\Run;
use App\Models\Tackle;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class PlayDescriptionService
{

    public function plays(Match $match)
    {
        $plays = Play::where('match_id', $match->id)->orderBy('created_at','asc')->get();
        $actions = "";
        $play = $plays->last();

        dd($plays->last()->id, $this->actionsPerPlay($play));
    }

    public function actionsPerPlay($play)
    {
        $string = '';
        $tables = ['kicks', 'return_plays', 'runs', 'tackles', 'passes'];

        foreach ($tables as $table) {
            $actions = DB::table($table)->where('play_id', $play->id)->get();
            switch ($table) {
                case 'kicks':
                    foreach ($actions as $action) {
                        $kick = Kick::find($action->id);
                        $msg = $kick->type . " for " . $kick->yards . " yards by player #" . $kick->kicker->shirt_number
                            . " (" . $kick->team->name . ")";
                        $string = $string . $msg . ', ';
                    }
                    break;
                case 'return_plays':
                    foreach ($actions as $action) {
                        $return = ReturnPlay::find($action->id);
                        $msg = "return for " . $return->yards . " yards by player #" . $return->runner->shirt_number
                            . " (" . $return->team->name . ")";
                        $string = $string . $msg . ', ';
                    }
                    break;
                case 'tackles':
                    foreach ($actions as $action) {
                        $tackle = Tackle::find($action->id);
                        $msg = "tackle by player #" . $tackle->tackler->shirt_number
                            . (($tackle->assist != null) ? " assist by #" . $tackle->assist->shirt_number : "") . " (" . $tackle->team->name . ")";
                        $string = $string . $msg . ', ';
                    }
                    break;
                case 'runs':
                    foreach ($actions as $action) {
                        $run = Run::find($action->id);
                        $msg = (($run->touchdown == 1) ? "TOUCHDOWN " : "") . "run for " . $run->yards . " yards by player #" . $run->runner->shirt_number
                            . " (" . $run->team->name . ")";
                        $string = $string . $msg . ', ';
                    }
                    break;
            }
        }
        return $string;
    }
}