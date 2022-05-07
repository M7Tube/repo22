<?php

namespace App\Http\Controllers;

use App\Models\Selector;
use Illuminate\Http\Request;

class SelectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Selector::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('selector.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO valdiation
        Selector::Create($request->all());
        return back()->with('success', 'Selector Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Selector  $selector
     * @return \Illuminate\Http\Response
     */
    public function show(Selector $selector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Selector  $selector
     * @return \Illuminate\Http\Response
     */
    public function edit(Selector $selector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Selector  $selector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selector $selector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Selector  $selector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selector $selector)
    {
        //
    }
}
