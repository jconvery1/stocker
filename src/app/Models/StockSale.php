<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockSale extends Model
{
    use HasFactory;

    /**
     * Get the sale that the stock sale belongs to.
     */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Get the stock item that the stock sale belongs to.
     */
    public function stock_item()
    {
        return $this->belongsTo(StockItem::class);
    }
}
