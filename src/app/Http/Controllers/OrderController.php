<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        Order::create($request->validated());
        return response()->json("order created!");
    }

    public function update(StoreOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        return response()->json("order updated");
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json("order deleted");
    }
}
