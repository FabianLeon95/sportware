<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Position;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $players = Player::with('user', 'position')->get();

        return view('player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diffUserIds = Player::get('user_id')->toArray();

        $users = User::where('role_id', 3)
            ->get()
            ->diff(User::findMany($diffUserIds));

        $positions = Position::get(['id','position_name']);

        return view('player.create', compact('positions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Player::create([
            'user_id'=>$request->user,
            'position_id'=>$request->position,
            'shirt_number'=>$request->shirt_number,
            'joined_at'=> Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        return redirect()->route('players.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeWithUser(Request $request)
    {
        $user = User::create([
            'role_id' => 3,
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Str::random(8)
        ]);

        Player::create([
            'user_id'=>$user->id,
            'position_id'=>$request->position,
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

        return view('player.edit', compact('player', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Player $player)
    {
        $player->update([
            'position_id'=>$request->position,
            'shirt_number'=>$request->shirt_number,
            'joined_at'=>Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        $player->save();

        return redirect()->route('users.index');
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
}
