<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model
{
    use HasFactory;

    /**
     * Get the supplier that supplies the stock item.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Get the stock orders for the stock item.
     */
    public function stock_order()
    {
        return $this->hasMany(StockOrder::class);
    }

    /**
     * Get the stock sales for the stock item.
     */
    public function stock_sale()
    {
        return $this->hasMany(StockSale::class);
    }
}
