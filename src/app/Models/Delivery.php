<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    /**
     * Get the order associated with the delivery.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * Get the user that created the delivery.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
