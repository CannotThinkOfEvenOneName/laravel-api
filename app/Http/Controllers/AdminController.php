<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginApi(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        if (auth("admin")->attempt($incomingFields)) {
            $admin = Admin::where('name', $incomingFields['name'])->first();
            $token = $admin->createToken('adminstoken')->plainTextToken;
            return $token;
        }
        return 'Failed to login!!!';
    }
    public function registerApi(Request $request) {
        $incomingFields = $request->validate([
            'name' => "required",
            'email' => "required",
            'password' => "required",
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $admin = Admin::create($incomingFields);
        return $admin;
    }
}
