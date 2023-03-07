<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockOrder;

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
        'created_at',
        'updated_at',
        'fulfilled'
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

    public function deletelinkedOrderItems($order)
    {
        $stockOrders = StockOrder::where('order_id', $order->id)->get();
        foreach ($stockOrders as $stockOrder) {
            $stockOrder->delete();
        }
    }

    public function fulfill($order)
    {
        $order->fulfilled = 1;
        $order->save();
    }
}
