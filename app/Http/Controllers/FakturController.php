<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
use App\Models\Product;
use App\Models\ProductDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FakturController extends Controller
{
  public function storeFakturList(Request $request)
  {
    $validated = $request->validate([
      'user_id' => "required|exists:users,id",
      "product_id" => "required|exists:products,id"
    ]);

    $returned = DB::table("temp_faktur_list")
      ->where("user_id", $request->input("user_id"))
      ->where("product_id", $request->input("product_id"))
      ->get()->first();

    if ($returned) return json_encode([
      "status" => "error",
      "message" => "Product already exist in faktur"
    ]);

    $inserted = DB::table("temp_faktur_list")->insert([
      "user_id" => $validated["user_id"],
      "product_id" => $validated["product_id"]
    ]);

    if ($inserted) return json_encode([
      "status" => "ok",
      "message" => "Product successfully added to faktur"
    ]);
    return json_encode([
      "status" => "error",
      "message" => "Something went wrong, cant add product to faktur"
    ]);
  }

  public function storeFaktur(Request $request)
  {
    $request->validate([
      "invoice" => "required|unique:fakturs,invoice",
      "user_id" => "required|exists:users,id",
      "receiver_address" => "required",
      "receiver_postal_code" => "required|numeric",
      "products.*.product_id" => "required|exists:products,id",
      "products.*.new_qty" => "required|numeric"
    ]);

    DB::beginTransaction();

    try {
      $validated = $request->only([
        "invoice", "user_id", "receiver_address", "receiver_postal_code"
      ]);

      $faktur = Faktur::create($validated);
      $request_products = $request->input("products");

      $total = 0;
      foreach ($request_products as $request_product) {
        $product = Product::where("id", $request_product["product_id"])->get()->first();
        $new_qty = $request_product["new_qty"];

        if ($new_qty > $product->quantity) throw new \Exception("Bad request");

        $created = ProductDetail::create([
          "faktur_id" => $faktur->id,
          "name" => $product->name,
          "quantity" => $new_qty,
          "category" => $product->category->name,
          "subtotal" => $product->price * $new_qty
        ]);

        if (!$created) throw new \Exception("Something went wrong");

        $product->quantity = $product->quantity - $new_qty;
        $product->save();

        if (!$product->wasChanged()) throw new \Exception("Something went wrong");
        $total += $product->price * $new_qty;
      }

      $faktur->total = $total;
      $faktur->save();

      if (!$faktur->wasChanged('total')) throw new \Exception("Something went wrong");

      $deleted = DB::table("temp_faktur_list")->where("user_id", $request->input("user_id"))->delete();
      if (!$deleted) throw new \Exception("Something went wrong");

      DB::commit();
    } catch (\Exception $exception) {
      DB::rollBack();
      return redirect()->back()->with("Error", $exception->getMessage());
    }
    return redirect()->back()->with("Success", "Success");
  }

  public function resetTempFakturListUser(Request $request)
  {
    $validated = $request->validate([
      "user_id" => "required|exists:users,id"
    ]);

    DB::table("temp_faktur_list")->where("user_id", $validated["user_id"])->delete();
    return redirect()->back();
  }
}
