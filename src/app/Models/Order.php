<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_datetime',
        'notes',
        'user_id',
        'supplier_id',
        'delivery_id',
        'created_at',
        'updated_at'
    ];

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
