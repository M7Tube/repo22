<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' =>  ['required', 'string']
        ]);
        // Check User If He Exict
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'fails',
                'code' => 200,
                'message' => 'This Email Is not Found'
            ], 200);
        } else {
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'fails',
                    'code' => 200,
                    'message' => 'Wrong Password'
                ], 200);
            }
        }
        $token = $user->createToken('LoginToken')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'code' => 200,
            'message' => 'Login Successfully',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ], 200);
    }

    public function logout(Request $request)
    {
        if (auth()->user()->tokens()->delete())
            return response()->json([
                'status' => 'success',
                'code' => 200,
                'message' => 'Logout Done'
            ], 200);
    }
}
