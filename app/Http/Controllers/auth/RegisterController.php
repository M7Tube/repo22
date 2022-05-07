<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UserRequest $request)
    {
        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pic' => $request->pic,
            'department_id' => $request->department_id,
            'role_id' => $request->role_id,
        ]);
        if ($user) {
            return back()->with('success', 'The User Has been added successfuly');
        } else {
            return back()->with('fail', 'Somthing Wrong is Happening');
        }
    }
}
