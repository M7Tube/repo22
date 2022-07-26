<?php

namespace App\Http\Livewire\Textbox;

use App\Models\ReportCategory;
use App\Models\Template;
use App\Models\TextBox;
use Livewire\Component;

class Create extends Component
{
    public $categorys;
    public $categoryCount;

    public $selectedCategory;

    public $prevQuestions;

    public $name;
    public $is_required;
    public $is_number;
    public $template_id;
    public $category_id;

    public function mount()
    {
        $this->categorys = ReportCategory::where('template_id', request()->query('template_id'))->get();
        $this->categoryCount = ReportCategory::where('template_id', request()->query('template_id'))->count();
        $this->prevQuestions = TextBox::where(
            'template_id',
            request()->query('template_id')
        )->get();
        $this->template_id = request()->query('template_id');
        $this->is_required = 0;
        $this->is_number = 0;
    }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:144'],
            'is_required' => ['required', 'boolean'],
            'is_number' => ['required', 'boolean'],
            'category_id' => ['required', 'integer', 'exists:report_categories,category_id'],
        ]);
        $textbox = TextBox::Create([
            'name' => $this->name,
            'is_required' => $this->is_required,
            'is_number' => $this->is_number,
            'template_id' => $this->template_id,
            'category_id' => $this->category_id,
        ]);
        if ($textbox) {
            $this->clear();
            return redirect()->route('template.manage', $this->template_id);
        }
    }

    public function clear()
    {
        $this->name = null;
        $this->is_required = 0;
        $this->is_number = 0;
        $this->category_id = null;
    }

    public function render()
    {
        return view('livewire.textbox.create', [
            'templates' => Template::all(),
        ]);
    }
}
