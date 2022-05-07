<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Vat;
use PDF2;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cart = session()->get('cart', []);
        $info = session()->get('info', []);
        $info2 = session()->get('info2', []);
        $vat = Vat::all();
        return $data = [
            'info' => $info,
            'info2' => $info2,
            'cart' => $cart,
            'vat' => $vat,
        ];
        // return array_keys($data['cart']);
        // return $data['cart'][5]['name'];
        // return $s=array_sum(array_column($cart, 'price'));
        // return array_sum($s);
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "50000000");
        view()->share('data', $data);
        $pdf = PDF2::loadView('pdf2', $data);
        // $pdf = PDF::loadView('pdf', $data);
        // download PDF file with download method
        $output = $pdf->output();
        $name = 'upload/Doc.' .session()->get('info', [])['info']['docNo']. '.pdf';
        file_put_contents($name, $output);
        Document::Create([
            'docNo' => session()->get('info', [])['info']['docNo'],
            'doc' => $name
        ]);
        //TODO un comment the 3 line under this
        session()->forget('cart');
        session()->forget('info');
        session()->forget('info2');
        return $pdf->download('pdf_file.pdf');
        // return $pdf->stream('document.pdf');

    }
}
