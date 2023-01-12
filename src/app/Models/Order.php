<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Get the delivery associated with the order.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

    /**
     * Get the user that created the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the stock orders for the order.
     */
    public function stock_order()
    {
        return $this->hasMany(StockOrder::class);
    }
}
