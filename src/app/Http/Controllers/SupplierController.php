<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::paginate(10);
    }

    public function supplierDropdown()
    {
        return Supplier::all();
    }

    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    public function store(StoreSupplierRequest $request)
    {
        Supplier::create($request->validated());
        return response()->json("supplier created!");
    }

    public function update(StoreSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        return response()->json("supplier updated");
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json("supplier deleted");
    }
}
