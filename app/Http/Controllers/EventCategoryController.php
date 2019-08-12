<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCategoryRequest;
use App\Models\EventCategory;


class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = EventCategory::paginate(10);

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
    public function store(EventCategoryRequest $request)
    {
        EventCategory::create([
            'category_name'=>$request->category_name,
            'color' => $request->color,
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
    public function update(EventCategoryRequest $request, EventCategory $category)
    {
        $category->update([
            'category_name'=>$request->category_name,
            'color' => $request->color,
            'description'=>$request->description
        ]);

        $category->save();

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EventCategory $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(EventCategory $category)
    {
        $category->delete();
        return redirect()->route('category.index');
    }
}
