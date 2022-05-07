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

    public $Cname;
    public $template_id;

    public function mount()
    {
        $this->categorys = ReportCategory::where('template_id', request()->query('template_id'))->get();
        $this->categoryCount = ReportCategory::where('template_id', request()->query('template_id'))->count();
        $this->prevQuestions = Selector::where(
            'template_id',
            request()->query('template_id')
        )->get();
        $this->template_id = request()->query('template_id');
    }

    public function clear()
    {
        $this->name = null;
        $this->template_id = null;
    }

    public function render()
    {
        return view('livewire.selector.create', [
            'templates' => Template::all(),
        ]);
    }
}
