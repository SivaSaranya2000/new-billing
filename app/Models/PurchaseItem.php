<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
   protected $fillable = [
    'purchase_id',
    'product_id',
    'qty',
    'mrp',
    'purchase_exc_tax',
    'purchase_inc_tax',
    'tax_amount',
    'unit_price',
    'price'
];
}
