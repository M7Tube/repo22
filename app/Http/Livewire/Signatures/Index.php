<?php

namespace App\Http\Livewire\Signatures;

use App\Models\Signature;
use Livewire\Component;
use Livewire\WithPagination as LivewireWithPagination;

class Index extends Component
{
    use LivewireWithPagination;

    public $signature_id;
    public $name;
    public $signature;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function edit($id)
    {
        $signature = Signature::where('signature_id', $id)->first();
        if ($signature) {
            $this->signature_id = $signature->signature_id;
            $this->name = $signature->name;
            $this->signature = $signature->signature;
        } else {
            return session()->flash('WrongSignature', 'You Can Not Edit This Signature');
        }
    }

    public function clear()
    {
        $this->signature_id = null;
        $this->name = null;
        $this->signature = null;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:48'],
        ]);
        $signature = Signature::find($this->signature_id);
        if ($signature) {
            $signature->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Signature Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This Signature');
        }
        $this->emit('signatureUpdated');
    }

    public function delete()
    {
        $image = Signature::find($this->signature_id);
        unlink("upload/" . $image->signature);
        Signature::where('signature_id', $this->signature_id)->delete();
        session()->flash('message', 'Signature Deleted Successfully');
    }

    public function render()
    {
        return view(
            'livewire.signatures.index',
            [
                'signatures' => Signature::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
            ]
        );
    }
}
