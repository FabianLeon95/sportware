<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Models\Season;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function index()
    {
        $seasons = Season::all();
        return view('match.index', compact('seasons'));
    }

    public function season(Request $request)
    {
        $season = Season::find($request->season);

        return redirect()->route('match.matches', $season);
    }

    public function matches(Season $season)
    {
        $matches = Match::where('season_id', $season->id)->get();

        return view('match.matches', compact('matches', 'season'));
    }

    public function create(Season $season)
    {
        $opponents = Team::where('id', '!=', 1)->get();
        return view('match.create', compact('opponents', 'season'));
    }

    public function store(Request $request, Season $season)
    {
        if ($request->game_location == 'home') {
            $home = 1;
            $visit = $request->opponent;
        } else {
            $visit = 1;
            $home = $request->opponent;
        }
        Match::create([
            'season_id' => $season->id,
            'home_team_id' => $home,
            'visit_team_id' => $visit,
            'game_type' => $request->type,
            'date' => Carbon::parse($request->date)->format('Y-m-d')
        ]);
        return redirect()->route('match.matches', $season);
    }
}
