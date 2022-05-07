<?php

namespace App\Http\Livewire\Form;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use PDF2;

class Create2 extends Component
{
    use WithFileUploads;
    public $photos = [];

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:10240', // 10MB Max
        ]);
        // return redirect()->route('dashboard');
        $files =  session()->get('files' . session()->get('LoggedAccount')['email'], []);
        foreach ($this->photos as $key => $photo) {
            if (Storage::disk('local')->exists('images/', $photo->getClientOriginalName())) {
                Storage::delete('images/', $photo->getClientOriginalName());
                $single = $photo->storeAs('images', $photo->getClientOriginalName());
            }
            $single = $photo->storeAs('images', $photo->getClientOriginalName());
            // $name = $photo->getClientOriginalName();
            // $single = $photo->storeAs('images', $name);
            if (isset($files[0][$key])) {
                $files[$single] = [
                    "name" => $single,
                ];
            } else {
                $files[0][$single] = [
                    "name" => $single,
                ];
            }
            $this->status = 'sdfdsf';
            session()->put('files' . session()->get('LoggedAccount')['email'], $files);
        }
        // $this->photos = null;
        session()->flash('messageFile', 'Photos Added Successfully');
    }

    public function export()
    {
        // $info = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        // $files = session()->get('files' . session()->get('LoggedAccount')['email'], []);
        // $request = session()->get('request' . session()->get('LoggedAccount')['email'], []);
        // $data = session()->get('data' . session()->get('LoggedAccount')['email'], []);
        // if (isset($data['data' . session()->get('LoggedAccount')['email']])) {
        //     session()->forget('data' . session()->get('LoggedAccount')['email']);
        //     $data['data' . session()->get('LoggedAccount')['email']] = [
        //         'info' => $info,
        //         'files' => $files,
        //         0 => $request
        //     ];
        // } else {
        //     $data['data' . session()->get('LoggedAccount')['email']] = [
        //         'info' => $info,
        //         'files' => $files,
        //         0 => $request
        //     ];
        // }
        // session()->put('data' . session()->get('LoggedAccount')['email'], $data);
        // // return redirect()->route('Exportform');
        // /////////////////////////////////////////
        // ini_set('max_execution_time', '300');
        // ini_set("pcre.backtrack_limit", "50000000");
        // view()->share('data', $data);
        // $pdf = PDF2::chunkLoadView('<html-separator/>', 'pdf', $data);
        // // $pdf = PDF2::loadView('pdf', $data);
        // $output = $pdf->output();
        // $name = 'upload/Doc.' . session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'] . '.pdf';
        // file_put_contents($name, $output);
        // $document = Document::Create([
        //     'docNo' => session()->get('Quinfo' . session()->get('LoggedAccount')['email'], [])['Quinfo' . session()->get('LoggedAccount')['email']]['docNo'],
        //     'doc' => $name
        // ]);
        // //TODO un comment the 3 line under this
        // // session()->forget('Quinfo');
        // // session()->forget('files');
        // // download PDF file with download method
        // return $pdf->download('Report' . $document->docNo . '.pdf');
    }
    public function render()
    {
        return view('livewire.form.create2');
    }
}
