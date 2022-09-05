<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

  public function getProductData(Request $request)
  {
    $request->validate([
      "id" => "required",
    ]);

    $product_id = $request->only("id");
    $data_product = Product::find($product_id)->first();

    return response()->json([
      "name" => $data_product->name,
      "category" => $data_product->category_id,
      "price" => $data_product->price,
      "quantity" => $data_product->quantity,
      "picture" => $data_product->picture
    ]);
  }
}
