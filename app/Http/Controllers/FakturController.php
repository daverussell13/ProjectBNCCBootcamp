<?php

namespace App\Http\Controllers;

use App\Models\Faktur;
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
}
