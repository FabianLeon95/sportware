<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRookieRequest;
use App\Http\Requests\EditRookieRequest;
use App\Models\Position;
use App\Models\Rookie;
use App\Models\User;
use Illuminate\Http\Request;

class RookieController extends Controller
{
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
        $rookies = Rookie::with('user', 'position')->paginate(10);

        return view('rookie.index', compact('rookies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $diffUserIds = Rookie::get('user_id')->toArray();
//
//        $users = User::where('role_id', 5)
//            ->get()
//            ->diff(User::findMany($diffUserIds));

        $positions = Position::get(['id','position_name']);

        return view('rookie.create', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRookieRequest $request)
    {
        $user = User::create([
            'role_id' => \Config::get('constants.roles.player'),
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> bcrypt('123')
        ]);

        Rookie::create([
            'user_id'=>$user->id,
            'position_id'=>$request->position,
            'observations'=>$request->observations
        ]);

        return redirect()->route('rookies.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Rookie $rookie
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Rookie $rookie)
    {
        $positions = Position::get(['id','position_name']);

        return view('rookie.edit', compact('rookie','positions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Rookie $rookie
     */
    public function update(EditRookieRequest $request, Rookie $rookie)
    {
        $rookie->update([
            'position_id' => $request->position,
            'observations' => $request->observations
        ]);

        $rookie->save();

        return redirect()->route('rookies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
