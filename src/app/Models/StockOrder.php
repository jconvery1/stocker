<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOrder extends Model
{
    use HasFactory;

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
}
