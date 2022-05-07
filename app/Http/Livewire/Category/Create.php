<?php

namespace App\Http\Livewire\Category;

use App\Models\ReportCategory;
use Livewire\Component;

class Create extends Component
{
    public $category_id;
    public $name;
    public $template_id;

    public function mount()
    {
        $this->template_id=request()->query('template_id');
    }
    public function create()
    {
        $this->validate([
            'name' => ['required', 'string'],
        ]);
        ReportCategory::Create([
            'name' => $this->name,
            'template_id' => $this->template_id
        ]);
        session()->flash('success', 'Category Added Successfully');
        $this->clear();
    }

    public function clear()
    {
        $this->category_id = null;
        $this->name = null;
        // $this->template_id = null;
    }
    public function render()
    {
        return view('livewire.category.create');
    }
}
