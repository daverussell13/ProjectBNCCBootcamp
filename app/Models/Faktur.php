<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
  use HasFactory;

  protected $fillable = [
    "user_id",
    "invoice",
    "receiver_address",
    "receiver_postal_code",
    "total",
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function product_details()
  {
    return $this->hasMany(ProductDetail::class);
  }
}
