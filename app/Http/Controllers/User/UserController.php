<?php

namespace App\Http\Controllers\User;

use App\Helper\InvoiceHelper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
      "products" => Product::with("category")->get(),
      "user" => Auth::user()
    ]);
  }

  public function faktur()
  {
    $user_id = Auth::user()->id;

    $results = DB::table("temp_faktur_list")
      ->where("user_id", $user_id)
      ->get();

    $products = [];
    $total = 0;

    foreach ($results as $result) {
      $product = Product::with("category")->where("id", $result->product_id)->get()->first();
      $products[] = $product;
      $total += $product->price;
    }

    return view("user.faktur", [
      "user" => Auth::user(),
      "products" => $products,
      "total" => $total,
      "invoice" => InvoiceHelper::generateInvoice()
    ]);
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
