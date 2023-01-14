<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        return DeliveryResource::collection(Delivery::all());
    }

    public function show(Delivery $delivery)
    {
        return new DeliveryResource($delivery);
    }

    public function store(StoreDeliveryRequest $request)
    {
        Delivery::create($request->validated());
        return response()->json("delivery created!");
    }

    public function update(StoreDeliveryRequest $request, Delivery $delivery)
    {
        $delivery->update($request->validated());
        return response()->json("delivery updated");
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return response()->json("delivery deleted");
    }
}
