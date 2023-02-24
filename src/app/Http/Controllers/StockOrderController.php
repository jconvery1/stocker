<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOrderRequest;
use App\Http\Resources\StockOrderResource;
use App\Models\Order;
use App\Models\StockOrder;

class StockOrderController extends Controller
{
    public function index()
    {
        return StockOrderResource::collection(StockOrder::all());
    }

    public function show(StockOrder $stockorder)
    {
        return new StockOrderResource($stockorder);
    }

    public function store(StoreStockOrderRequest $request)
    {
        StockOrder::create($request->validated());
        return response()->json("stock order created!");
    }

    public function update(StoreStockOrderRequest $request, StockOrder $stockorder)
    {
        $stockorder->update($request->validated());
        return response()->json("stock order updated");
    }

    public function destroy(StockOrder $stockorder)
    {
        $stockorder->delete();
        return response()->json("stock order deleted");
    }
}
