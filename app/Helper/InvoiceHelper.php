<?php

namespace App\Helper;

use App\Models\Faktur;

class InvoiceHelper
{
  public static function generateInvoice(): string
  {
    $latest = Faktur::latest()->first();
    if (!$latest) return "PMJ0001";
    $new_invoice = preg_replace("/[^0-9\.]/", '', $latest->invoice);
    return "PMJ" . sprintf("%05d", $new_invoice + 1);
  }
}
