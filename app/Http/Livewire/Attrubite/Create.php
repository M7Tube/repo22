<?php

namespace App\Http\Livewire\Attrubite;

use App\Models\Attrubite;
use App\Models\ReportCategory;
use App\Models\Template;
use Livewire\Component;

class Create extends Component
{

    public $categorys;
    public $categoryCount;

    public $selectedCategory;

    public $prevQuestions;

    public $Cname;
    public $template_id;

    public function mount()
    {
        $this->categorys = ReportCategory::where('template_id', request()->query('template_id'))->get();
        $this->categoryCount = ReportCategory::where('template_id', request()->query('template_id'))->count();
        $this->prevQuestions = Attrubite::where(
            'template_id',
            request()->query('template_id')
        )->get();
        $this->template_id = request()->query('template_id');
    }

    // public function updatedprevQuestions()
    // {
    //     $this->selectedCategory = ReportCategory::where(
    //         'template_id',
    //         request()->query('template_id')
    //     );
    // }

    public function clear()
    {
        $this->name = null;
        $this->template_id = null;
    }

    public function render()
    {
        return view('livewire.attrubite.create', [
            'templates' => Template::all(),
        ]);
    }
}
