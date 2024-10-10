<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name', 'address', 'city', 'postal_code', 'country', 'total_amount', 'status'
    ];
}