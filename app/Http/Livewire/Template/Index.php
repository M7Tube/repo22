<?php

namespace App\Http\Livewire\Template;

use App\Models\Template;
use Livewire\WithPagination as LivewireWithPagination;
use Livewire\WithFileUploads;
use Livewire\Component;

class Index extends Component
{
    use LivewireWithPagination;
    use WithFileUploads;

    public $template_id;
    public $name;
    public $pic;
    public $user_id;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function edit($id)
    {
        $template = Template::where('template_id', $id)->first();
        if ($template) {
            $this->template_id = $template->template_id;
            $this->name = $template->name;
        } else {
            return session()->flash('WrongTemplate', 'You Can Not Edit This Template');
        }
    }
    public function clear()
    {
        $this->template_id = null;
        $this->name = null;
        $this->pic = null;
        $this->user_id = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['string', 'max:48'],
            'pic' => ['nullable', 'mimes:png,jpg,jpeg'],
        ]);
        if ($this->pic) {
            $name = $this->pic->getClientOriginalName();
            $editedPhoto = $this->pic->storeAs('public/images', $name);
        }
        $template = Template::find($this->template_id);
        if ($template) {
            $template->update([
                'name' => $this->name,
                'pic' => $name ?? $template->pic,
                // 'email' => $this->email,
            ]);
            session()->flash('message', 'Template Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Template');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        Template::where('template_id', $this->template_id)->delete();
        session()->flash('message', 'Template Deleted Successfully');
    }

    public function render()
    {
        return view(
            'livewire.template.index',
            [
                'templates' => Template::searchaa($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
