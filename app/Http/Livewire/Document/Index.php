<?php

namespace App\Http\Livewire\Document;

use App\Models\Document;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use ZipArchive;
use File;

class Index extends Component
{

    public function download($doc)
    {
        return Storage::download('pdf/' . $doc, $doc, array(
            'Content-Type: application/pdf',
        ));
        // //PDF file is stored under project/public/download/info.pdf
        // $file = storage_path() . "/app/pdf/" . $doc;

        // $headers = array(
        //     'Content-Type: application/pdf',
        // );

        // return response()->download($file, 'filename.pdf', $headers);
    }

    public function downloadAll()
    {
        $zip = new ZipArchive;
        $fileName = 'Backup' . rand(1111111111, 9999999999) . '.zip';
        if ($zip->open(storage_path($fileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(storage_path('app/pdf'));
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }
        return response()->download(storage_path($fileName));
    }

    public function render()
    {
        return view('livewire.document.index', [
            'docs' => Document::simplePaginate()
        ]);
    }
}
