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

    public static function createStockOrderFromOrder($orderId, $items) {
        foreach ($items as $item) {
            $stockOrder = new StockOrder();
            $stockOrder->order_id = $orderId;
            $stockOrder->stock_item_id = $item['stock_item_id'];
            $stockOrder->quantity = $item['quantity'];
            $stockOrder->save();
        }
    }

    public static function updateStockOrdersForOrder($orderId, $items)
    {
        $stockOrders = StockOrder::where('order_id', $orderId)->get();

        //check if any items match any stock orders and update if need be
        foreach ($stockOrders as $stockOrder) {
            $matchFound = false;
            foreach ($items as $item) {
                if ($stockOrder->stock_item_id == $item['stock_item_id']) {
                    if ($stockOrder->quantity != $item['quantity']) {
                        $stockOrder->quantity = $item['quantity'];
                        $stockOrder->save();
                    }
                    $matchFound = true;
                }
            }

            //if current stock order doesn't match any items, delete it
            if (!$matchFound) {
                $stockOrder->delete();
            }
        }

        //check if any items do not match an existing stock order
        //if not, then create a new stock order from the item
        foreach ($items as $item) {
            $matchFound = false;
            foreach ($stockOrders as $stockOrder) {
                if ($stockOrder->stock_item_id == $item['stock_item_id']) {
                    $matchFound = true;
                }
            }

            //if existing stock order doesn't match any new stock orders, delete it
            //and create new stock order from item
            if (!$matchFound) {
                $newStockOrder = new StockOrder();
                $newStockOrder->stock_item_id = $item['stock_item_id'];
                $newStockOrder->quantity = $item['quantity'];
                $newStockOrder->order_id = $orderId;
                $newStockOrder->save();
            }
        }
    }
}
