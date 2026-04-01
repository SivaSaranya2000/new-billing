<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
   protected $fillable=[
    'name',
    'number',
    'phone',
    'email',
    'website',
    'address',
    'city',
    'state',
    'country',
    'zip_code',
    'gst_number',
    'pan_number',

   ];
}
