<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Player;
use Illuminate\Http\Request;

class EventAssistanceController extends Controller
{


    /**
     * EventAssistanceController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats');
    }

    public function create(Event $event){
        $players = Player::where('team_id', 1)->get();

        return view('assistance.create', compact('event', 'players'));
    }

    public function update(Request $request, Event $event){
        $attendedPlayers = Player::findMany($request->assistance);
        $event->playersWhoAttended()->detach();
        foreach ($attendedPlayers as $player){
            $event->playersWhoAttended()->attach($player);
        }

        return redirect()->route('events.show', $event);
    }
}
