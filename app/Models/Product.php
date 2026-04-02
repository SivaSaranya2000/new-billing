<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'hsn_code',
        'barcode_type',
        'unit',
        'brand',
        'category',
        'sub_category',
        'business_location',
        'alert_quantity',
        'manage_stock',
        'product_type',
        'tax_type',
        
    ];
    public function price()
    {
        return $this->hasOne(ProductPrice::class);
    }
}
