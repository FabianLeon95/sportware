<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePlayerRequest;
use App\Http\Requests\EditPlayerRequest;
use App\Models\Player;
use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * PlayerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::where('team_id', 1)->with('user', 'position')->paginate(10);
        return view('player.index', compact('players'));
    }

    /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function create()
    {
        $positions = Position::get(['id','position_name']);
        $teams = Team::get(['id', 'name']);

        return view('player.create', compact('positions', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlayerRequest $request)
    {
        $user = User::create([
            'role_id' => \Config::get('constants.roles.player'),
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt('123')
        ]);

        Player::create([
            'user_id'=>$user->id,
            'position_id'=>$request->position,
            'team_id' => $request->team,
            'shirt_number'=>$request->shirt_number,
            'joined_at'=> Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        return redirect()->route('players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $positions = Position::get(['id','position_name']);

        $teams = Team::get(['id', 'name']);

        return view('player.edit', compact('player', 'positions', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(EditPlayerRequest $request, Player $player)
    {
        $player->update([
            'position_id'=>$request->position,
            'team_id' => $request->team,
            'shirt_number'=>$request->shirt_number,
            'joined_at'=>Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        $player->save();

        return redirect()->route('players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }

    public function getPlayers($team){
        $players = Player::where('team_id', $team)->with('user')->get();

        return json_encode($players);
    }
}
