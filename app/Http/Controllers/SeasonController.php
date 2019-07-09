<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeasonRequest;
use App\Models\Season;
use Illuminate\View\Factory;

class SeasonController extends Controller
{
    protected $season;
    protected $view;

    public function __construct(Season $season, Factory $view)
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats');
        $this->season = $season;
        $this->view = $view;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seasons = $this->season->all();

        return $this->view->make('season.index', compact('seasons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->view->make('season.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SeasonRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SeasonRequest $request)
    {
       $this->season->create([
            'year' => $request->year,
            'description' => $request->description
        ]);

        return redirect()->route('seasons.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function show(Season $season)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function edit(Season $season)
    {
        return view('season.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function update(SeasonRequest $request, Season $season)
    {
        $season->update([
            'year' => $request->year,
            'description' => $request->description
        ]);

        $season->save();

        return redirect()->route('seasons.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Season  $season
     * @return \Illuminate\Http\Response
     */
    public function destroy(Season $season)
    {
        $season->delete();

        return redirect()->route('seasons.index');
    }
}
