<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use Illuminate\Http\Request;

class SignatureController extends Controller
{
    public function index()
    {
        return view('signatures.signature-pad');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:72']
        ]);
        $folderPath = public_path('upload/');
        $image_parts = explode(";base64,", $request->signed);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $signature = uniqid() . '.' . $image_type;
        $file = $folderPath . $signature;
        file_put_contents($file, $image_base64);
        // $d = new Signature;
        // $d->name = $request->name;
        // $d->signature = $signature
        // $d->save();
        Signature::Create([
            'name' => $request->name,
            'signature' => $signature
        ]);
        return back()->with('success', 'Signature Submitted Successfully');
    }
}
