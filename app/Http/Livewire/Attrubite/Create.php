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

    public $name;
    public $status = [];
    public $dateAndTime = [];
    public $is_required;
    public $template_id;
    public $category_id;

    public function mount()
    {
        $this->categorys = ReportCategory::where('template_id', request()->query('template_id'))->get();
        $this->categoryCount = ReportCategory::where('template_id', request()->query('template_id'))->count();
        $this->prevQuestions = Attrubite::where(
            'template_id',
            request()->query('template_id')
        )->get();
        $this->template_id = request()->query('template_id');
        $this->is_required = 0;
    }

    // public function updatedprevQuestions()
    // {
    //     $this->selectedCategory = ReportCategory::where(
    //         'template_id',
    //         request()->query('template_id')
    //     );
    // }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:288'],
            // 'status' => ['required', 'array', 'max:4'],
            'is_required' => ['required', 'boolean'],
            'category_id' => ['required', 'integer', 'exists:report_categories,category_id'],
        ]);
        $question = Attrubite::Create([
            'name' => $this->name,
            'status' => $this->status,
            'is_required' => $this->is_required ?? 0,
            'dateAndTime' => $this->dateAndTime ?? [],
            'template_id' => $this->template_id,
            'category_id' => $this->category_id,
        ]);
    }

    public function clear()
    {
        $this->name = null;
        $this->status = [];
        $this->dateAndTime = [];
        $this->is_required = null;
        $this->category_id = null;
    }

    public function render()
    {
        return view('livewire.attrubite.create', [
            'templates' => Template::all(),
        ]);
    }
}
