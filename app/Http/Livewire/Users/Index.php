<?php

namespace App\Http\Livewire\Users;

use App\Models\Department;
use App\Models\User;
use Livewire\WithPagination as LivewireWithPagination;
use Livewire\WithFileUploads;

use Livewire\Component;

class Index extends Component
{
    use LivewireWithPagination;
    use WithFileUploads;

    public $user_id;
    public $name;
    public $email;
    public $password;
    public $pic;
    public $department_id;

    public $orderBy = 'name';
    public $orderAsc = true;
    public $search = '';

    public function edit($id)
    {
        $user = User::where('user_id', $id)->first();
        if ($user) {
            $this->user_id = $user->user_id;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->pic = $user->pic;
            $this->department_id = $user->department_id;
        } else {
            return session()->flash('WrongUser', 'You Can Not Edit This User');
        }
    }
    public function clear()
    {
        $this->user_id = null;
        $this->name = null;
        $this->email = null;
        $this->password = null;
        $this->pic = null;
        $this->department_id = null;
    }
    public function update()
    {
        $this->validate([
            'name' => ['string', 'max:48'],
            // 'email'=>[email','unique:users,email'],
            'password' => ['min:8', 'max:72'],
            'pic' => ['nullable', 'mimes:png,jpg,jpeg'],
            'department_id' => ['exists:departments,department_id']
        ]);
        if ($this->pic) {
            $editedPhoto = $this->pic->storeAs('upload', $this->pic->getClientOriginalName());
        }
        $user = User::find($this->user_id);
        if ($user) {
            $user->update([
                'name' => $this->name,
                // 'email' => $this->email,
                'password' => $this->password,
                'pic' => $editedPhoto ?? $user->pic,
                'department_id' => $this->department_id,
            ]);
            session()->flash('message', 'User Updated Successfully');
        } else {
            session()->flash('message', 'You Can Not Edit This User');
        }
        $this->emit('userUpdated');
    }

    public function delete()
    {
        User::where('user_id', $this->user_id)->delete();
        session()->flash('message', 'User Deleted Successfully');
        // if (session('LoggedAccount')->account_type_id == 1) {
        //     CatogaryDetails::where('ad_catogary_id',$this->ad_catogary_id)->delete();
        //     Ad::where('ad_catogary_id',$this->ad_catogary_id)->delete();
        //     AdDescription::where('ad_catogary_id',$this->ad_catogary_id)->delete();
        //     AdTypeName::where('ad_catogary_id',$this->ad_catogary_id)->delete();
        //     AdInfo::where('ad_catogary_id',$this->ad_catogary_id)->delete();
        //     AdCatogary::where('ad_catogary_id', $this->ad_catogary_id)->delete();
        //     session()->flash('message', 'Catogary Deleted Successfully');
        // } else {
        //     session()->flash('message', 'YOu Can Not Delete This Catogary');
        // }
    }

    public function render()
    {
        return view(
            'livewire.users.index',
            [
                'users' => User::search($this->search)
                    ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                    ->simplePaginate(5),
                'departments' => Department::all(),
            ]
        );
    }
}
