<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Resources\SaleResource;
use App\Models\Sale;

class SaleController extends Controller
{
    public function index()
    {
        return SaleResource::collection(Sale::all());
    }

    public function show(Sale $sale)
    {
        return new SaleResource($sale);
    }

    public function store(StoreSaleRequest $request)
    {
        Sale::create($request->validated());
        return response()->json("sale created!");
    }

    public function update(StoreSaleRequest $request, Sale $sale)
    {
        $sale->update($request->validated());
        return response()->json("sale updated");
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();
        return response()->json("sale deleted");
    }
}
