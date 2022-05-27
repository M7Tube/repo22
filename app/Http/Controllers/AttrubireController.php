<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttrubiteRequest;
use App\Models\Attrubite;
use Illuminate\Http\Request;
use PDF;

class AttrubireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attrubite.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('attrubite.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttrubiteRequest $request)
    {
        Attrubite::Create($request->all());
        return back()->with('success', 'Question Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attrubite  $attrubite
     * @return \Illuminate\Http\Response
     */
    public function show(Attrubite $attrubite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attrubite  $attrubite
     * @return \Illuminate\Http\Response
     */
    public function edit(Attrubite $attrubite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attrubite  $attrubite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attrubite $attrubite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attrubite  $attrubite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attrubite $attrubite)
    {
        //
    }
}
