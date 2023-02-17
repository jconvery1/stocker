<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockItemRequest;
use App\Http\Resources\StockItemResource;
use App\Models\StockItem;

class StockItemController extends Controller
{
    public function index()
    {
        return StockItemResource::collection(StockItem::all());
    }

    public function show(StockItem $stockitem)
    {
        return new StockItemResource($stockitem);
    }

    public function store(StoreStockItemRequest $request)
    {
        StockItem::create($request->validated());
        return response()->json("stock item created!");
    }

    public function update(StoreStockItemRequest $request, StockItem $stockitem)
    {
        $stockitem->update($request->validated());
        return response()->json("stock item updated");
    }

    public function destroy(StockItem $stockitem)
    {
        $stockitem->delete();
        return response()->json("stock item deleted");
    }
}
