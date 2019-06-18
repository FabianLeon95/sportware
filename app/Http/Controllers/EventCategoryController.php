<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = EventCategory::all();

        return view('event_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        EventCategory::create([
            'category_name'=>$request->category_name,
            'description'=>$request->description
        ]);

        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function show(EventCategory $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(EventCategory $category)
    {
        return view('event_category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventCategory $category)
    {
        $category->update([
            'category_name'=>$request->category_name,
            'description'=>$request->description
        ]);

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventCategory  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventCategory $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
