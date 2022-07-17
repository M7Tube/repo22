<?php

namespace App\Http\Livewire\InporgressInspections;

use App\Models\InProgressInspection;
use Livewire\Component;
use Livewire\WithPagination as LivewireWithPagination;

class Index extends Component
{

    use LivewireWithPagination;

    public $IPI_id;
    public $name;
    public $desc;
    public $location;
    public $date;
    public $doc_no;
    public $value;
    public $is_complated;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function makeComplate($id)
    {
        $check = InProgressInspection::find($id);
        $check->is_complated=1;
        $check->value=null;
        $check->save();

    }
    public function clear()
    {
        $this->IPI_id = null;
        $this->name = null;
        $this->desc = null;
        $this->location = null;
        $this->date = null;
        $this->is_complated = null;
        $this->doc_no = null;
    }

    public function render()
    {
        return view(
            'livewire.inporgress-inspections.index',
            [
                'ipis' => InProgressInspection::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
