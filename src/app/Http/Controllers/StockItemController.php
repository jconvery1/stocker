<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockItemRequest;
use App\Http\Resources\StockItemResource;
use App\Models\StockItem;
use App\Models\Supplier;

class StockItemController extends Controller
{
    public function index()
    {
        return StockItemResource::collection(StockItem::all());
        // $builtStockItems = [];
        // foreach($stockitems as $stockitem) {
        //     $supplierId = $stockitem->supplier_id;
        //     $supplier = Supplier::where('id', $supplierId)->get();
        //     $stockitem->resource->attributes->supplier_name = $supplier[0]->name;
        //     // $builtStockItems = $stockitem;
        // }
        // return $stockitems;
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
