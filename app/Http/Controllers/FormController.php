<?php

namespace App\Http\Controllers;

use App\Models\Attrubite;
use App\Models\Document;
use App\Models\Form;
use App\Models\ReportCategory;
use App\Models\Statu;
use Illuminate\Http\Request;
use PDF2;

class FormController extends Controller
{

    public function Exportform()
    {
        return view('form.create2');
    }

    public function ExportformPost(Request $request)
    {
        $info = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        $files = session()->get('files' . session()->get('LoggedAccount')['email'], []);
        $request = session()->get('request' . session()->get('LoggedAccount')['email'], []);
        $data = session()->get('data' . session()->get('LoggedAccount')['email'], []);
        if (isset($data['data' . session()->get('LoggedAccount')['email']])) {
            session()->forget('data' . session()->get('LoggedAccount')['email']);
            $data['data' . session()->get('LoggedAccount')['email']] = [
                'info' => $info,
                'files' => $files,
                0 => $request
            ];
        } else {
            $data['data' . session()->get('LoggedAccount')['email']] = [
                'info' => $info,
                'files' => $files,
                0 => $request
            ];
        }
        session()->put('data' . session()->get('LoggedAccount')['email'], $data);
        // return redirect()->route('Exportform');
        /////////////////////////////////////////
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "50000000");
        view()->share('data', $data);
        $pdf = PDF2::chunkLoadView('<html-separator/>', 'pdf', $data);
        // $pdf = PDF2::loadView('pdf', $data);
        $output = $pdf->output();
        $name = 'upload/Doc.' . session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'] . '.pdf';
        file_put_contents($name, $output);
        $document = Document::Create([
            'docNo' => session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'],
            'doc' => $name
        ]);
        //TODO un comment the 3 line under this
        // session()->forget('Quinfo');
        // session()->forget('files');
        // download PDF file with download method
        return $pdf->download('Report' . $document->docNo . '.pdf');
    }

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
        $att = ReportCategory::where('template_id', request()->query('template_id'))->with('att', 'selector', 'textbox')->get();
        // $stt=Statu::all();
        return view('form.create', compact('att'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'companyName' => ['required', 'string', 'max:72'],
        //     // 'clientName' => ['required', 'string', 'max:72'],
        //     'clientPhone' => ['required', 'string', 'max:15'],
        //     'docNo' => ['integer'],
        // ]);
        // return $clientIP = \Request::getClientIp(true);

        // dd($clientIP);
        // return $request->all();
        // $t=Statu::all();
        // share data to view
        session()->put('request' . session()->get('LoggedAccount')['email'], $request->all());
        return redirect()->route('Exportform');
        $info = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        // $files = session()->get('files', []);
        // return explode('\./','asdwqeasd\./warning');
        // return substr('asdwqeasd\./waadsadsrning', strpos('asdwqeasd\./warning', "\./") + 3);
        $data = session()->get('data' . session()->get('LoggedAccount')['email'], []);
        if (isset($data['data' . session()->get('LoggedAccount')['email']])) {
            session()->forget('data' . session()->get('LoggedAccount')['email']);
            $data['data' . session()->get('LoggedAccount')['email']] = [
                'info' => $info,
                // 'files' => $files,
                0 => $request->all()
            ];
        } else {
            $data['data' . session()->get('LoggedAccount')['email']] = [
                'info' => $info,
                // 'files' => $files,
                0 => $request->all()
            ];
        }
        session()->put('data' . session()->get('LoggedAccount')['email'], $data);
        /////////////////////////////////////////
        ini_set('max_execution_time', '300');
        ini_set("pcre.backtrack_limit", "50000000");
        view()->share('data', $data);
        $pdf = PDF2::chunkLoadView('<html-separator/>', 'pdf', $data);
        // $pdf = PDF2::loadView('pdf', $data);
        $output = $pdf->output();
        $name = 'upload/Doc.' . session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'] . '.pdf';
        file_put_contents($name, $output);
        $document = Document::Create([
            'docNo' => session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'],
            'doc' => $name
        ]);
        //TODO un comment the 3 line under this
        // session()->forget('Quinfo');
        // session()->forget('files');
        // download PDF file with download method
        return $pdf->download('Report' . $document->docNo . '.pdf');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function show(Form $form)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        //
    }
}
