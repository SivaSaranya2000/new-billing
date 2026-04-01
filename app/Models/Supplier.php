<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
  protected $fillable = [
        'name',
        'phone',
        'email',
        'supplier_code',
        'city',
        'state',
        'gst_number',
        'address',
    ];
}
