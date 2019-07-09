<?php

namespace Tests\Unit;

use App\Http\Controllers\SeasonController;
use App\Http\Requests\SeasonRequest;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\View\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeasonControllerTest extends TestCase
{
    protected $season;
    protected $view;
    protected $controller;

    public function setUp(): void
    {
        $this->season = \Mockery::mock(Season::class);
        $this->view = \Mockery::mock(Factory::class);
        $this->controller = new SeasonController($this->season, $this->view);
    }

    public function testIndex()
    {
        $this->season->shouldReceive('all')
            ->once()
            ->andReturn('all_seasons');

        $this->view->shouldReceive('make')
            ->with('season.index', ['seasons' => 'all_seasons'])
            ->once();

        $this->controller->index();
    }

    public function testCreate()
    {
        $this->view->shouldReceive('make')
            ->with('season.create')
            ->once();

        $this->controller->create();
    }

    public function testStore()
    {
        $request = \Mockery::mock(SeasonRequest::class);

        $this->season->shouldReceive('create')
            ->once();

        $this->controller->store($request);
    }
}