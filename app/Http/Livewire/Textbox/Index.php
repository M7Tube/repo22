<?php

namespace App\Http\Livewire\Textbox;

use App\Models\ReportCategory;
use App\Models\Template;
use App\Models\TextBox;
use Livewire\Component;
use Livewire\WithPagination as LivewireWithPagination;

class Index extends Component
{

    use LivewireWithPagination;

    public $box_id;
    public $name;
    public $template_id;
    public $category_id;
    public $is_required;

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
        $textbox = TextBox::where('box_id', $id)->first();
        if ($textbox) {
            $this->box_id = $textbox->box_id;
            $this->name = $textbox->name;
            $this->template_id = $textbox->template_id;
            $this->category_id = $textbox->category_id;
            $this->is_required = $textbox->is_required;
        } else {
            return session()->flash('WrongStatus', 'You Can Not Edit This Text Box');
        }
    }
    public function clear()
    {
        $this->box_id = null;
        $this->name = null;
        $this->template_id = null;
        $this->is_required = null;
        $this->category_id = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['string', 'max:144'],
        ]);
        $textbox = TextBox::find($this->box_id);
        if ($textbox) {
            $textbox->update([
                'name' => $this->name,
                'template_id' => $this->template_id,
                'category_id' => $this->category_id,
                'is_required' => $this->is_required,
            ]);
            session()->flash('message', 'Text Box Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Text Box');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        TextBox::where('box_id', $this->box_id)->delete();
        session()->flash('message', 'Text Box Deleted Successfully');
    }

    public function render()
    {
        return view(
            'livewire.textbox.index',
            [
                'textboxes' => TextBox::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
