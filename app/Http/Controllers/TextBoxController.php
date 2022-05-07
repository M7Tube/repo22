<?php

namespace App\Http\Controllers;

use App\Models\TextBox;
use Illuminate\Http\Request;

class TextBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('textbox.create');
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
        TextBox::Create($request->all());
        return back()->with('success', 'Text Box Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function show(TextBox $textBox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function edit(TextBox $textBox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TextBox $textBox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TextBox  $textBox
     * @return \Illuminate\Http\Response
     */
    public function destroy(TextBox $textBox)
    {
        //
    }
}
