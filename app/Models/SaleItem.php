<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
    'sells_id',
    'product_id',
    'qty',
    'price',
    'discount',
    'tax',
    'tax_amount',
    'total'
];

public function sale()
{
    return $this->belongsTo(Sale::class);
}
}
