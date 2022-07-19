<?php

namespace App\Http\Livewire\VisitType;

use App\Models\VisitType;
use Livewire\WithPagination as LivewireWithPagination;
use Livewire\Component;

class Index extends Component
{

    use LivewireWithPagination;

    public $visit_type_id;
    public $name;


    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:144']
        ]);
        $VisitType = VisitType::Create([
            'name' => $this->name
        ]);
        if ($VisitType) {
            session()->flash('message', 'VisitType Created Successfully');
        } else {
        }
    }
    public function edit($id)
    {
        $VisitType = VisitType::where('visit_type_id', $id)->first();
        if ($VisitType) {
            $this->visit_type_id = $VisitType->visit_type_id;
            $this->name = $VisitType->name;
        } else {
            return session()->flash('WrongStatus', 'You Can Not Edit This VisitType');
        }
    }
    public function clear()
    {
        $this->visit_type_id = null;
        $this->name = null;
    }

    public function update()
    {
        $this->validate([
            'name' => ['string', 'max:144'],
        ]);
        $VisitType = VisitType::find($this->visit_type_id);
        if ($VisitType) {
            $VisitType->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'VisitType Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This VisitType');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        VisitType::where('visit_type_id', $this->visit_type_id)->delete();
        session()->flash('message', 'VisitType Deleted Successfully');
    }


    public function render()
    {
        return view(
            'livewire.visit-type.index',
            [
                'visit_types' => VisitType::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
