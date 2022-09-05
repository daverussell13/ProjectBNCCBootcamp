<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Backtrace\File;

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
      "id" => "required|exists:products,id",
    ]);

    $product_id = $request->only("id");
    $data_product = Product::find($product_id)->first();

    return response()->json([
      "id" => $data_product->id,
      "name" => $data_product->name,
      "category" => $data_product->category_id,
      "price" => $data_product->price,
      "quantity" => $data_product->quantity,
      "picture" => $data_product->picture
    ]);
  }

  public function update(Request $request)
  {
    $validated = $request->validate([
      "id" => "required|exists:products,id",
      "name" => "required",
      "price" => "required|numeric",
      "category" => "required",
      "quantity" => "required",
    ]);

    Product::where("id", $request->input("id"))->update([
      "name" => $validated["name"],
      "price" => $validated["price"],
      "category_id" => $validated["category"],
      "quantity" => $validated["quantity"]
    ]);


    if ($request->file("picture")) {
      $request->validate([
        "picture" => "image|file|max:10240"
      ]);

      $product = Product::find($request->input("id"))->first();

      if ($product->picture != '' && $product->picture != null) {
        $path = public_path() . '/storage/';
        $old_file = $path . $product->picture;
        if (file_exists($old_file)) {
          unlink($old_file);
        }
      }

      $filename = $request->file("picture")->store("images");
      DB::table('products')->where("id", $request->input("id"))->update(["picture" => $filename]);
    }

    return redirect()->back()->with("UpdateSuccess", "Products have been successfully updated");
  }

  public function delete(Request $request)
  {
    $request->validate([
      "id" => "required|exists:products,id"
    ]);

    $id = $request->input("id");
    $deleted = Product::destroy($id);

    if (!$deleted) return redirect()->back()->with("Fail", "Something went wrong");
    return redirect()->back()->with("Success", "Product deleted successfully");
  }
}
