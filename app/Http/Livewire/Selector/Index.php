<?php

namespace App\Http\Livewire\Selector;

use App\Models\ReportCategory;
use App\Models\Selector;
use App\Models\Template;
use Livewire\Component;
use Livewire\WithPagination as LivewireWithPagination;

class Index extends Component
{
    use LivewireWithPagination;

    public $selector_id;
    public $name;
    public $values;
    public $template_id;
    public $category_id;
    public $is_required;
    public $is_multi;

    public $templates;
    public $categorys;


    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function mount()
    {
        $this->templates = Template::all(['template_id', 'name']);
        $this->categorys = ReportCategory::all(['category_id', 'name']);
    }
    public function edit($id)
    {
        $selector = Selector::where('selector_id', $id)->first();
        if ($selector) {
            $this->selector_id = $selector->selector_id;
            $this->name = $selector->name;
            $this->values = $selector->values;
            $this->template_id = $selector->template_id;
            $this->category_id = $selector->category_id;
            $this->is_required = $selector->is_required;
            $this->is_multi = $selector->is_multi;
        } else {
            return session()->flash('WrongStatus', 'You Can Not Edit This Selector');
        }
    }
    public function clear()
    {
        $this->selector_id = null;
        $this->name = null;
        $this->values = null;
        $this->template_id = null;
        $this->is_required = null;
        $this->category_id = null;
        $this->is_multi = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['string', 'max:144'],
        ]);
        $selector = Selector::find($this->selector_id);
        if ($selector) {
            $selector->update([
                'name' => $this->name,
                'values' => $this->values,
                'template_id' => $this->template_id,
                'category_id' => $this->category_id,
                'is_required' => $this->is_required,
                'is_multi' => $this->is_multi,
            ]);
            session()->flash('message', 'Selector Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Selector');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        Selector::where('selector_id', $this->selector_id)->delete();
        session()->flash('message', 'Selector Deleted Successfully');
    }

    public function render()
    {
        return view(
            'livewire.selector.index',
            [
                'selectors' => Selector::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
