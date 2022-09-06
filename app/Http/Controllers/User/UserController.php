<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function login()
  {
    return view("user.login", [
      "loginRoute" => "/user/login"
    ]);
  }

  public function register()
  {
    return view("user.register");
  }

  public function home()
  {
    return view("user.home", [
      "products" => Product::with("category")->get()
    ]);
  }

  public function faktur()
  {
    return view("user.faktur");
  }

  public function postRegister(Request $request)
  {
    $request->validate([
      "name" => "required|min:3|max:40",
      "email" => "required|unique:users,email|ends_with:@gmail.com",
      "phone" => "required|starts_with:08|numeric",
      "password" => "required|min:6|max:12",
      "cpassword" => "required|same:password",
    ], [
      "cpassword.same" => "Confirmation password didn't match"
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

  public function postLogin(Request $request)
  {
    $request->validate([
      "email" => "required|email",
      "password" => "required"
    ]);

    $creds = $request->only("email", "password");

    if (Auth::guard("web")->attempt($creds)) {
      $request->session()->regenerate();
      return redirect()->intended(route("user.home"));
    }

    return redirect()->back()->with("Fail", "Invalid Credentials");
  }

  public function logout()
  {
    Auth::guard("web")->logout();
    return redirect()->route("user.login");
  }
}
