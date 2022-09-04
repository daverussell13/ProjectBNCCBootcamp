<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
  public function home()
  {
    return view("admin.home", [
      "user" => Auth::guard("admin")->user(),
      "section_title" => "Table"
    ]);
  }

  public function login()
  {
    return view("admin.login", [
      "loginRoute" => "/admin/login"
    ]);
  }

  public function postLogin(Request $request)
  {
    $request->validate([
      "admin_id" => "required",
      "password" => "required"
    ]);

    $creds = $request->only("admin_id", "password");

    if (Auth::guard("admin")->attempt($creds)) {
      $request->session()->regenerate();
      return redirect()->intended(route("admin.home"));
    }

    return redirect()->back()->with("Fail", "Invalid Credentials");
  }

  public function logout()
  {
    Auth::guard("admin")->logout();
    return redirect()->route("admin.login");
  }
}