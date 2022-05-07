<?php

namespace App\Http\Livewire\Category;

use App\Models\Attrubite;
use App\Models\ReportCategory;
use Livewire\WithPagination as LivewireWithPagination;

use Livewire\Component;

class Control extends Component
{
    use LivewireWithPagination;

    public $category_id;
    public $name;
    public $template_id;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function edit($id)
    {
        $category = ReportCategory::where('category_id', $id)->first();
        if ($category) {
            $this->category_id = $category->category_id;
            $this->name = $category->name;
            $this->template_id = $category->template_id;
        } else {
            return session()->flash('WrongCategory', 'You Can Not Edit This Quastion');
        }
    }
    public function clear()
    {
        $this->category_id = null;
        $this->name = null;
        $this->template_id = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:48'],
        ]);
        $category = ReportCategory::find($this->category_id);
        if ($category) {
            $category->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Category Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Category');
        }
        $this->emit('categoryUpdated');
    }

    public function delete()
    {
        Attrubite::where('category_id', $this->category_id)->delete();
        ReportCategory::where('category_id', $this->category_id)->delete();
        session()->flash('message', 'Category Deleted Successfully');
    }


    public function render()
    {
        return view(
            'livewire.category.control',
            [
                'categoris' => ReportCategory::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
