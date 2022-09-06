<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
  use HasFactory;

  protected $fillable = [
    "faktur_id",
    "name",
    "quantity",
    "category",
    "subtotal",
  ];

  public function faktur()
  {
    return $this->belongsTo(Faktur::class);
  }
}
