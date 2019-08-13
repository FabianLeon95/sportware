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

    public function test()
    {
        $stast = $this->statsService->teamStatComparision(Match::find(2));
        dd($stast);
    }

}
