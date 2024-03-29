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

            $stockItem = StockItem::find($item['stock_item_id']);
            $stockItem->stock_level -= $item['quantity'];
            $stockItem->save();
        }
    }

    public static function updateStockSalesForSale($saleId, $items)
    {
        $stockSales = StockSale::where('sale_id', $saleId)->get();

        //check if any items match any stock sales and update if need be
        foreach ($stockSales as $stockSale) {
            $matchFound = false;
            foreach ($items as $item) {
                if ($stockSale->stock_item_id == $item['stock_item_id']) {
                    if ($stockSale->quantity != $item['quantity']) {
                        //reverse previous stock sale quantity from stock item
                        $stockItem = StockItem::find($item['stock_item_id']);
                        $stockItem->stock_level += $stockSale->quantity;

                        //save stock sale
                        $stockSale->quantity = $item['quantity'];
                        $stockSale->price = $item['price'];
                        $stockSale->save();

                        //add new stock sale quantity change to stock item
                        $stockItem->stock_level -= $stockSale->quantity;
                        $stockItem->save();
                    }
                    $matchFound = true;
                }
            }

            //if current stock sale doesn't match any items, delete it
            if (!$matchFound) {
                $stockSale->delete();

                //reset previous stock item
                $oldStockItem = StockItem::find($stockSale->stock_item_id);
                $oldStockItem->stock_level += $stockSale->quantity;
                $oldStockItem->save();
            }
        }

        //check if any items do not match an existing stock sale
        //if not, then create a new stock sale from the item
        foreach ($items as $item) {
            $matchFound = false;
            foreach ($stockSales as $stockSale) {
                if ($stockSale->stock_item_id == $item['stock_item_id']) {
                    $matchFound = true;
                }
            }

            //if existing stock sale doesn't match any new stock sales, delete it
            //and create new stock sale from item
            if (!$matchFound) {
                $newStockSale = new StockSale();
                $newStockSale->stock_item_id = $item['stock_item_id'];
                $newStockSale->quantity = $item['quantity'];
                $newStockSale->price = $item['price'];
                $newStockSale->sale_id = $saleId;
                $newStockSale->save();

                //decrease stock level of new stock item
                $stockItem = StockItem::find($item['stock_item_id']);
                $stockItem->stock_level -= $item['quantity'];
                $stockItem->save();
            }
        }
    }
}
