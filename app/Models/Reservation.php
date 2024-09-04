<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'service',
        'barber',
        'date',
        'time',
        'user_id', // Ensure user_id is fillable
    ];

    // Optionally, define a relationship if needed
    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
}
