<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function registerApi(Request $request) {
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
