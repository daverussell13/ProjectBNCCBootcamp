<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      "name" => "required",
      "price" => "required|numeric",
      "category" => "required",
      "quantity" => "required",
      "picture" => "required|image|file|max:10240"
    ]);

    $validated = $request->only("name", "price", "quantity");
    $validated["picture"] = $request->file("picture")->store("images");
    $validated["category_id"] = $request->input("category");

    $product = Product::create($validated);

    if (!$product) return redirect()->back()->with("Failed", "Something went wrong");
    return redirect()->back()->with("Success", "New product has been successfully added");
  }
}
