<?php

namespace App\Models;

use App\Mail\OrderStock;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Automation extends Model
{
    public $table = "automation";
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'reorder_level',
        'reorder_amount',
        'enabled',
        'created_at',
        'updated_at'
    ];

    public static function reorder($item, $amount, $level, $sale) {
        $order = new Order();
        $order->notes = "Automated Reorder: $item->name";
        $order->user_id = 1;
        $order->supplier_id = $item->supplier_id;
        $order->fulfilled = 0;
        $order->order_datetime = substr($sale->created_at, 0, 16);
        $order->save();

        $stockOrder = new StockOrder();
        $stockOrder->order_id = $order->id;
        $stockOrder->stock_item_id = $item->id;
        $stockOrder->quantity = $amount;
        // $stockOrder->quantity = $level - $item->stock_level;
        $stockOrder->save();

        $stockOrders = StockOrder::where('order_id', $order->id)->get();
        foreach ($stockOrders as $stockOrder) {
            $stockItem = StockItem::find($stockOrder->stock_item_id);
            $stockOrder->item_name = $stockItem->name;
        }

        $supplier = Supplier::find($order->supplier_id);
        Mail::to($supplier->email)->send(new OrderStock($order, $stockOrders));
    }
}
