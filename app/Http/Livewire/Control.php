<?php

namespace App\Http\Livewire;

use App\Models\Attrubite;
use App\Models\ReportCategory;
use App\Models\Template;
use App\Models\User;
use Livewire\Component;

class Control extends Component
{
    public $templateCount;
    public $userCount;
    public $categoryCount;
    public $questionCount;

    public function mount()
    {
        $this->templateCount=Template::count();
        $this->userCount=User::count();
        $this->categoryCount=ReportCategory::count();
        $this->questionCount=Attrubite::count();
    }
    public function render()
    {
        return view('livewire.control');
    }
}
