<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
    'supplier_id',
    'purchase_date',
    'purchase_invoice_no',
    'shipping_charges',
    'paid_amount',
    'payment_mode',
    'round_off',
    'discount',
    'total_amount'
];
}
