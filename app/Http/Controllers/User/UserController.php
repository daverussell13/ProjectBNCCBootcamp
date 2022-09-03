<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function postRegister(Request $request)
    {
        $request->validate([
            "name" => "required|min:3|max:40",
            "email" => "required|unique:users,email|ends_with:@gmail.com",
            "phone" => "required|starts_with:08|numeric",
            "password" => "required|min:6|max:12",
            "cpassword" => "required|same:password",
        ]);

        $user = User::create([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "phone" => $request->input("phone"),
            "password" => Hash::make($request->input("password"))
        ]);

        if (!$user) return redirect()->back()->with("Failed", "Something went wrong");
        return redirect()->back()->with("Success", "Your account has been registered");
    }
}