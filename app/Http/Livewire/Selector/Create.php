<?php

namespace App\Http\Livewire\Selector;

use App\Models\Attrubite;
use App\Models\ReportCategory;
use App\Models\Selector;
use App\Models\Template;
use Livewire\Component;

class Create extends Component
{
    public $categorys;
    public $categoryCount;

    public $selectedCategory;

    public $prevQuestions;

    public $name;
    public $values;
    public $is_required;
    public $is_multi;
    public $template_id;
    public $category_id;

    public function mount()
    {
        $this->categorys = ReportCategory::where('template_id', request()->query('template_id'))->get();
        $this->categoryCount = ReportCategory::where('template_id', request()->query('template_id'))->count();
        $this->prevQuestions = Selector::where(
            'template_id',
            request()->query('template_id')
        )->get();
        $this->template_id = request()->query('template_id');
        $this->is_required = 0;
        $this->is_multi = 0;
    }

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:144'],
            'values' => ['required', 'string', 'max:144'],
            'is_required' => ['required', 'boolean'],
            'is_multi' => ['required', 'boolean'],
            'category_id' => ['required', 'integer', 'exists:report_categories,category_id'],
        ]);
        $selector = Selector::Create([
            'name' => $this->name,
            'values' => $this->values,
            'is_required' => $this->is_required,
            'is_multi' => $this->is_multi,
            'template_id' => $this->template_id,
            'category_id' => $this->category_id,
        ]);
        if ($selector) {
            $this->clear();
            return redirect()->route('template.manage', $this->template_id);
        }
    }

    public function clear()
    {
        $this->name = null;
        $this->values = null;
        $this->is_required = 0;
        $this->is_multi = 0;
        $this->category_id = null;
    }

    public function render()
    {
        return view('livewire.selector.create', [
            'templates' => Template::all(),
        ]);
    }
}
