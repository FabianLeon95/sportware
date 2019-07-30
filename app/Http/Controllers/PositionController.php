<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::paginate(10);
        return view('position.index', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position.create');
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PositionRequest $request)
    {
        Position::create([
            'position_name'=>$request->position_name
        ]);

        return redirect()->route('positions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
        return view('position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Position $position
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PositionRequest $request, Position $position)
    {
        $position->update([
            'position_name'=>$request->position_name
        ]);

        $position->save();

        return redirect()->route('positions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Position $position
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Position $position)
    {
        $position->delete();

        return redirect()->route('positions.index');
    }
}
