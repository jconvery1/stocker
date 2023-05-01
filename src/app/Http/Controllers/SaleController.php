<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Automation;
use App\Models\Customer;
use App\Models\User;
use App\Models\Sale;
use App\Models\StockItem;
use App\Models\StockOrder;
use App\Models\StockSale;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::all()->map(function ($sale) {
            $customer = Customer::find($sale->customer_id);
            $user = User::find($sale->user_id);
            $sale->customer_name = $customer->forename . ' ' . $customer->surname;
            $sale->user_name = $user->username;
            return $sale;
        });
    }

    public function show(Sale $sale)
    {
        return StockSale::where('sale_id', $sale->id)->get()->map(function ($stockSale) {
            $stockItem = StockItem::find($stockSale->stock_item_id);
            $stockSale->name = $stockItem->name;
            $stockSale->barcode = $stockItem->barcode;
            return $stockSale;
        });
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->validated());
        StockSale::createStockSaleFromSale($sale->id, $request->stock_sales);
        $stockSales = StockSale::where('sale_id', $sale->id)->get();
        $settings = Automation::find(1);
        if ($settings->enabled) {
            foreach ($stockSales as $stockSale) {
                $item = StockItem::find($stockSale->stock_item_id);
                $stockLevel = $item->stock_level;
                if ($stockLevel <= $settings->reorder_level) {
                    Automation::reorder($item, $settings->reorder_amount, $settings->reorder_level, $sale);
                }
            }
        }
        return response()->json("sale created!");
    }

    public function update(StoreSaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());
        StockSale::updateStockSalesForSale($sale->id, $request->stock_sales);
        return response()->json("sale updated");
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json("sale deleted");
    }
}
