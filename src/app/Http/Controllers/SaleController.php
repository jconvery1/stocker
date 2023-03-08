<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Customer;
use App\Models\User;
use App\Models\Sale;
use App\Models\StockItem;
use App\Models\StockSale;

class SaleController extends Controller
{
    public function index()
    {
        return Sale::all()->map(function ($sale) {
            $customer = Customer::where('id', $sale->customer_id)->get();
            $user = User::where('id', $sale->user_id)->get();
            $sale->customer_name = $customer[0]->forename . ' ' . $customer[0]->surname;
            $sale->user_name = $user[0]->username;
            return $sale;
        });
    }

    public function show(Sale $sale)
    {
        // return new SaleResource($sale);
        return StockSale::where('sale_id', $sale->id)->get()->map(function ($stockSale) {
            $stockItem = StockItem::where('id', $stockSale->stock_item_id)->get();
            $stockSale->name = $stockItem[0]->name;
            return $stockSale;
        });
    }

    public function store(StoreSaleRequest $request)
    {
        $sale = Sale::create($request->validated());
        StockSale::createStockSaleFromSale($sale->id, $request->stock_sales);
        return response()->json("sale created!");
    }

    public function update(StoreSaleRequest $request, Sale $sale)
    {
        // $sale->update($request->validated());
        // return response()->json("sale updated");
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
