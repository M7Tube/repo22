<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Vat;
use Illuminate\Http\Request;
use PDF2;

class ArabicExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $Arcart = session()->get('Arcart', []);
        $Arinfo = session()->get('Arinfo', []);
        $Arinfo2 = session()->get('Arinfo2', []);
        $vat = Vat::all();
        $data = [
            'info' => $Arinfo,
            'info2' => $Arinfo2,
            'cart' => $Arcart,
            'vat' => $vat,
        ];
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "5000000");
        view()->share('data', $data);
        $pdf = PDF2::loadView('Arpdf', $data);
        $output = $pdf->output();
        $name = 'upload/Doc.' . session()->get('Arinfo', [])['Arinfo']['docNo'] . '.pdf';
        file_put_contents($name, $output);
        Document::Create([
            'docNo' => session()->get('Arinfo', [])['Arinfo']['docNo'],
            'doc' => $name
        ]);
        //TODO un comment the 3 line under this
        // session()->forget('Arcart');
        // session()->forget('Arinfo');
        // session()->forget('Arinfo2');
        // return $pdf->stream('document.pdf');
        return $pdf->download('pdf_file.pdf');

        // $data = [
        //     'foo' => 'bar'
        // ];
        // $pdf = PDF2::loadView('pdf.document', $data);
        // return $pdf->stream('document.pdf');
    }
}
