<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Models\Statu;
use App\Models\Attrubite;
use Illuminate\Http\Request;
use PDF2;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attrubites = Attrubite::all();
        return view('status.create', compact('attrubites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StatusRequest $request)
    {
        Statu::Create($request->all());
        return back()->with('message');
    }
    public function createPDF(Request $request)
    {
        // $t=Statu::all();
        // share data to view
        return $data = [
            $request->at=>$request->st
        ];
        view()->share('Status', $data);
        $pdf = PDF2::loadView('pdf', $data);

        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Statu  $statu
     * @return \Illuminate\Http\Response
     */
    public function show(Statu $statu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Statu  $statu
     * @return \Illuminate\Http\Response
     */
    public function edit(Statu $statu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Statu  $statu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Statu $statu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Statu  $statu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Statu $statu)
    {
        //
    }
}
