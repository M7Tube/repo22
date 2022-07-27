<?php

namespace App\Http\Livewire\Form;

use App\Models\Attrubite;
use App\Models\Document;
use App\Models\Signature;
use App\Models\Statu;
use App\Models\Subject;
use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    //new
    public $name;
    public $desc;
    public $date;
    public $location;
    public $docNo;
    public $template_id;
    public $sitename;




    public $att;
    public $stt;

    public $status;

    // public $signture;

    public $photos = [];

    public function updatedPhotos()
    {
        $this->validate([
            'photos.*' => 'image|max:10240', // 10MB Max
        ]);
        // return redirect()->route('dashboard');
        $files =  session()->get('files', []);
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
            session()->put('files', $files);
        }
        // $this->photos = null;
        session()->flash('messageFile', 'Photos Added Successfully');
    }

    public function updatedName()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:144'],
            'desc' => ['required', 'string', 'max:1440'],
            'clientPhone' => ['required', 'string', 'max:15'],
            'docNo' => ['required', 'integer'],
        ]);
        $Quinfo = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        if (isset($Quinfo['Quinfo' . session()->get('LoggedAccount')['email']])) {
            session()->forget('Quinfo' . session()->get('LoggedAccount')['email']);
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        } else {
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        }
        session()->put('Quinfo' . session()->get('LoggedAccount')['email'], $Quinfo);
        session()->flash('QuInfomessage', 'QuInfo Added Successfully');
    }

    public function updatedCompanyName()
    {
        $this->validate([
            'companyName' => ['required', 'string', 'max:72'],
            // 'clientName' => ['required', 'string', 'max:72'],
            'clientPhone' => ['required', 'string', 'max:15'],
            'docNo' => ['required', 'integer'],
        ]);
        $Quinfo = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        if (isset($Quinfo['Quinfo' . session()->get('LoggedAccount')['email']])) {
            session()->forget('Quinfo' . session()->get('LoggedAccount')['email']);
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        } else {
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        }
        session()->put('Quinfo' . session()->get('LoggedAccount')['email'], $Quinfo);
        session()->flash('QuInfomessage', 'QuInfo Added Successfully');
    }

    public function updatedClientPhone()
    {
        $this->validate([
            'companyName' => ['required', 'string', 'max:72'],
            // 'clientName' => ['required', 'string', 'max:72'],
            'clientPhone' => ['required', 'string', 'max:15'],
            'docNo' => ['required', 'integer'],
        ]);
        $Quinfo = session()->get('Quinfo' . session()->get('LoggedAccount')['email'], []);
        if (isset($Quinfo['Quinfo' . session()->get('LoggedAccount')['email']])) {
            session()->forget('Quinfo' . session()->get('LoggedAccount')['email']);
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        } else {
            $Quinfo['Quinfo' . session()->get('LoggedAccount')['email']] = [
                "companyName" => $this->companyName,
                // "clientName" => $this->clientName,
                "clientPhone" => $this->clientPhone,
                "docNo" => $this->docNo,
                "date" => date('Y-m-d H:i:s'),
            ];
        }
        session()->put('Quinfo' . session()->get('LoggedAccount')['email'], $Quinfo);
        session()->flash('QuInfomessage', 'QuInfo Added Successfully');
    }

    // public function save()
    // {
    //     $this->validate([
    //         'companyName' => ['required', 'string', 'max:72'],
    //         'clientName' => ['required', 'string', 'max:72'],
    //         'clientPhone' => ['required', 'string', 'max:15'],
    //         'docNo' => ['required', 'integer'],
    //     ]);
    //     $Quinfo = session()->get('Quinfo'.session()->get('LoggedAccount')['email'], []);
    //     if (isset($Quinfo['Quinfo'.session()->get('LoggedAccount')['email']])) {
    //         session()->forget('Quinfo'.session()->get('LoggedAccount')['email']);
    //         $Quinfo['Quinfo'.session()->get('LoggedAccount')['email']] = [
    //             "companyName" => $this->companyName,
    //             "clientName" => $this->clientName,
    //             "clientPhone" => $this->clientPhone,
    //             "docNo" => $this->docNo,
    //             "date" => date('Y-m-d H:i:s'),
    //         ];
    //     } else {
    //         $Quinfo['Quinfo'.session()->get('LoggedAccount')['email']] = [
    //             "companyName" => $this->companyName,
    //             "clientName" => $this->clientName,
    //             "clientPhone" => $this->clientPhone,
    //             "docNo" => $this->docNo,
    //             "date" => date('Y-m-d H:i:s'),
    //         ];
    //     }
    //     session()->put('Quinfo'.session()->get('LoggedAccount')['email'], $Quinfo);
    //     session()->flash('QuInfomessage', 'QuInfo Added Successfully');
    //     $this->readyForExport = true;
    //     // return redirect('https://erp-com.preview-domain.com/public/admin/itemss');
    // }

    public function mount($selectedSubjects = null)
    {
        $this->readyForExport = false;
        $do = Document::all()->last();
        if ($do) {
            $this->docNo = $do->docNo + 1;
        } else {
            $this->docNo = 1;
        }
        $this->template_id = request()->query('template_id');
        $this->sitename = Template::find(request()->query('template_id'))['name'];
        $this->instruction = Template::find(request()->query('template_id'))['instructions'];
        // $this->signture = Signature::all('name', 'signature');
    }

    public function render()
    {
        return view(
            'livewire.form.create',
            [
                'signture' => Signature::all('name', 'signature'),
            ]
        );
    }
}
