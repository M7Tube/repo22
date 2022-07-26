<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'], //, 'unique:users,email'
            'password' => ['required'],
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            //the user is found
            if (Hash::check($request->password, $user->password)) {
                //the password is correct
                //give him a session with his info
                $request->session()->put('LoggedAccount', $user);
                return redirect()->route('control');
            } else {
                //the password is incorrect
                //return him back
                return back()->with('fail', 'the password is incorrect');
            }
        } else {
            //the user is missing
            return back()->with('fail', 'the email is incorrect');
        }
    }
}
