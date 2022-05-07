<?php

namespace App\Http\Livewire\Attrubite;

use App\Models\Attrubite;
use Livewire\WithPagination as LivewireWithPagination;

use Livewire\Component;

class Index extends Component
{
    use LivewireWithPagination;

    public $attrubite_id;
    public $name;
    public $template_id;
    public $status;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function edit($id)
    {
        $attrubite = Attrubite::where('attrubite_id', $id)->first();
        if ($attrubite) {
            $this->attrubite_id = $attrubite->attrubite_id;
            $this->name = $attrubite->name;
            $this->template_id = $attrubite->template_id;
            $this->status = $attrubite->status;
        } else {
            return session()->flash('WrongStatus', 'You Can Not Edit This Quastion');
        }
    }
    public function clear()
    {
        $this->attrubite_id = null;
        $this->name = null;
        $this->template_id = null;
        $this->status = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:48'],
        ]);
        $attrubite = Attrubite::find($this->attrubite_id);
        if ($attrubite) {
            $attrubite->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Quastion Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Quastion');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        Attrubite::where('attrubite_id', $this->attrubite_id)->delete();
        session()->flash('message', 'Quastion Deleted Successfully');
    }

    public function render()
    {
        return view(
            'livewire.attrubite.index',
            [
                'attrubites' => Attrubite::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
