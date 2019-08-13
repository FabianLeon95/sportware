<?php

namespace App\Http\Controllers;

use App\Models\Match;
use App\Services\StatsService;

class StatsController extends Controller
{
    private $statsService;

    /**
     * StatsController constructor.
     */
    public function __construct(StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    public function index()
    {
        $matches = Match::orderBy('season_id')->paginate(10);
        return view('stats.index', compact('matches'));
    }

    public function show($match)
    {
        $match = Match::findOrFail($match);
        $statsService = new StatsService();
        $stats = $statsService->teamStatComparision($match);

        return view('stats.show', compact('stats','match'));
    }

    public function test()
    {
        $stast = $this->statsService->teamStatComparision(Match::find(3));
        dd($stast);
    }

}
