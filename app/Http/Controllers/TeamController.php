<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::paginate(10);
        return view('team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     *
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TeamRequest $request)
    {
        $team = Team::create([
            'name' => $request->name,
            'location' => $request->location
        ]);

        for ($i = 1; $i <= 99; $i++) {
            Player::create([
                'team_id' => $team->id,
                'shirt_number' => $i,
            ]);
        }


        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        return view('team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(TeamRequest $request, Team $team)
    {
        $team->update([
            'name' => $request->name,
            'location' => $request->location
        ]);

        $team->save();

        return redirect()->route('teams.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Team $team
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return redirect()->route('teams.index');
    }
}
