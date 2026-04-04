<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'purchase_invoice_no',
        'qty',
        'mrp',
        'purchase_exc_tax',
        'purchase_inc_tax',
        'tax_amount',
        'unit_price',
        'price',
        'shipping_charges',
        'paid_amount',
        'payment_mode',
        'round_off',
        'discount',
        'total_amount'
    ];
}
