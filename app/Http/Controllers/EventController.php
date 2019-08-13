<?php

namespace App\Http\Controllers;

use App\Events\EventWasCreated;
use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\EventCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin,stats,medic')->except(['index', 'show', 'allEvents']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EventCategory::all();
        return view('event.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event = Event::create([
            'event_category_id' => $request->get('category'),
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'time' => Carbon::parse($request->time)->toTimeString(),
            'description' => $request->description,
            'location' => $request->location,
            'observations' => $request->observations
        ]);

        \event(new EventWasCreated($event));

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with('playersWhoAttended')->findOrFail($id);
        $event->date = Carbon::parse($event->date)->toFormattedDateString();
        $event->time = Carbon::parse($event->time)->format('h:i A');
        return view('event.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $event->date = Carbon::parse($event->date)->toFormattedDateString();
        $event->time = Carbon::parse($event->time)->format('h:i A');
        $categories = EventCategory::all();
        return view('event.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'event_category_id' => $request->category,
            'date' => Carbon::parse($request->date)->format('Y-m-d'),
            'time' => Carbon::parse($request->time)->toTimeString(),
            'description' => $request->description,
            'location' => $request->location,
            'observations' => $request->observations
        ]);
        $event->save();

        return redirect()->route('events.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        try {
            $event->playersWhoAttended()->detach();
            $event->delete();
        } catch (\Exception $e) {
            return back('404');
        }

        return redirect()->route('events.index');
    }

    public function allEvents($event)
    {
        $categories = EventCategory::with('events')->get();
        return response()->json($categories);
    }

}
