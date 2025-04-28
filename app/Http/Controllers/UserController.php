<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function loginApi(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if (auth("web")->attempt($incomingFields)) {
            $user = User::where('name', $incomingFields['name'])->first();
            $token = $user->createToken('userstoken')->plainTextToken;
            return $token;
        }
        return 'Failed to login!!!';
    }
    public function registerApi(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => "required",
            'email' => "required",
            'password' => "required"
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);
        return $user;
    }
}
