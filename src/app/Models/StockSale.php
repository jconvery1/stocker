<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockSale extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sale_id',
        'stock_item_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];

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

    public static function createStockSaleFromSale($saleId, $items)
    {
        foreach ($items as $item) {
            $stockSale = new StockSale();
            $stockSale->sale_id = $saleId;
            $stockSale->stock_item_id = $item['stock_item_id'];
            $stockSale->quantity = $item['quantity'];
            $stockSale->price = $item['price'];
            $stockSale->save();
        }
    }
}
