<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOrder extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'stock_item_id',
        'quantity',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the order that the stock order belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the stock item that the stock order belongs to.
     */
    public function stock_item()
    {
        return $this->belongsTo(StockItem::class);
    }

    public static function createStockOrderFromOrder($orderId, $request) {
        $stockOrder = new StockOrder();
        $stockOrder->order_id = $orderId;
        $stockOrder->stock_item_id = $request->stock_item_id;
        $stockOrder->quantity = $request->quantity;
        $stockOrder->save();
    }
}
