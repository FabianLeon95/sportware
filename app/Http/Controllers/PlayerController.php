<?php

namespace App\Http\Controllers;

use App\Events\UserWasCreated;
use App\Http\Requests\CreatePlayerRequest;
use App\Http\Requests\EditPlayerRequest;
use App\Http\Requests\PlayerFromUserRequest;
use App\Models\Player;
use App\Models\Position;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PlayerController extends Controller
{
    /**
     * PlayerController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
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
        $positions = Position::get(['id', 'position_name']);
        $teams = Team::get(['id', 'name']);

        return view('player.create', compact('positions', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlayerRequest $request)
    {
        $user = User::create([
            'role_id' => \Config::get('constants.roles.player'),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make(Str::random(8)),
            'registration_token' => Uuid::uuid()
        ]);

        event(new UserWasCreated($user));

        Player::create([
            'user_id' => $user->id,
            'position_id' => $request->position,
            'team_id' => 1,
            'shirt_number' => $request->shirt_number,
            'joined_at' => Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        return redirect()->route('players.index');
    }

    public function createFromUser()
    {
        $positions = Position::get(['id', 'position_name']);
        $users = User::where('role_id', 3)->get();
        $players = Player::with('user')->where('user_id', '!=', null)->get();
        $userPlayers = collect();
        foreach ($players as $player) {
            $userPlayers->push($player->user);
        }
        $users = $users->diff($userPlayers);

        return view('player.create_user', compact('positions', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeFromUser(PlayerFromUserRequest $request)
    {
        Player::create([
            'user_id' => $request->user,
            'position_id' => $request->position,
            'team_id' => 1,
            'shirt_number' => $request->shirt_number,
            'joined_at' => Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        return redirect()->route('players.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function edit(Player $player)
    {
        $positions = Position::get(['id', 'position_name']);

        $teams = Team::get(['id', 'name']);

        return view('player.edit', compact('player', 'positions', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function update(EditPlayerRequest $request, Player $player)
    {
        $player->update([
            'position_id' => $request->position,
            'team_id' => $request->team,
            'shirt_number' => $request->shirt_number,
            'joined_at' => Carbon::parse($request->joined_at)->format('Y-m-d')
        ]);

        $player->save();

        return redirect()->route('players.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Player $player
     * @return \Illuminate\Http\Response
     */
    public function destroy(Player $player)
    {
        //
    }

    public function getPlayers($team)
    {
        $players = Player::where('team_id', $team)->with('user')->get();

        return json_encode($players);
    }
}
