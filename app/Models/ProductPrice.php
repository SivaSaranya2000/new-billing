<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable = [
        'product_id',
        'mrp',
        'purchase_exc_tax',
        'purchase_inc_tax',
        'margin',
        'sell_exc_price',
        'sell_inc_price',
        'tax_percentage',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
