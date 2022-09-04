<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
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
}
