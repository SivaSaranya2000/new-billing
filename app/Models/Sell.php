<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sell extends Model
{
  protected $fillable = [
    'customer_id',
    'sales_code',
    'sales_date',
    'reference_no',
    'subtotal',
    'other_charges',
    'discount',
    'grand_total'
];

public function items()
{
    return $this->hasMany(SaleItem::class);
}
}
