<?php

namespace App\Http\Livewire\Template;

use App\Models\Template;
use Livewire\WithFileUploads;
use Livewire\Component;

class Create extends Component
{
    use WithFileUploads;
    public $template_name;
    public $template_desc;
    public $template_pic;
    public $template_with_visit_type;
    public $template_instructions;
    public $signatures;

    public $signatures_arr = [];


    public function clear()
    {
        $this->template_name = null;
        $this->template_desc = null;
        $this->template_pic = null;
        $this->template_with_visit_type = 1;
        $this->template_instructions = null;
        $this->signatures = [];
    }

    public function mount()
    {
        $this->template_with_visit_type = 1;
    }

    public function add_signatures()
    {
        $this->validate([
            'signatures' => ['required', 'string', 'max:72'],
        ]);
        array_push($this->signatures_arr, ['title' => $this->signatures]);
        $this->signatures = null;
    }

    public function create_template()
    {
        $this->validate([
            'template_name' => ['required', 'string', 'max:144'],
            'template_desc' => ['required', 'string', 'max:288'],
            'template_pic' => ['required', 'mimes:png,jpg,jpeg', 'max:10500'],
            'template_with_visit_type' => ['required', 'boolean'],
            'template_instructions' => ['required', 'string', 'max:1440'],
            // 'template_category' => ['json'],
        ]);
        $newTemplate = Template::Create([
            'name' => $this->template_name ?? '',
            'desc' => $this->template_desc ?? '',
            'pic' => $this->template_pic->getClientOriginalName() ?? '', //'https://c-rpt.com/storage/app/public/images/' .
            'with_visit_type' =>  $this->template_with_visit_type ?? 0,
            'instructions' =>  $this->template_instructions ?? '',
            'signatures' =>  $this->signatures_arr ?? [],
            'user_id' => session()->get('LoggedAccount')['user_id'] ?? '',
        ]);
        if ($newTemplate) {
            if (!$this->template_pic) {
                response()->json([
                    'status' => 'fails',
                    'code' => 200,
                    'message' => 'upload file not found',
                ], 200);
            } else {
                $this->template_pic->storeAs('public/images', $this->template_pic->getClientOriginalName());
                response()->json([
                    'status' => 'success',
                    'code' => 200,
                    'message' => 'images saved',
                ], 200);
            }
        }
        session()->flash('message', 'Template Created Successfully');
        $this->clear();
        return redirect()->route('template.manage', $newTemplate->template_id);
    }


    public function render()
    {
        return view('livewire.template.create');
    }
}
