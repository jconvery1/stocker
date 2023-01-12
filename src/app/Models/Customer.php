<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * Get the sales for the customer
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
