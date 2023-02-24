<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\StockOrderResource;
use App\Models\Order;
use App\Models\StockOrder;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    public function show(Order $order)
    {
        $stockorder = StockOrder::where('order_id', $order->id)->get();
        // return new OrderResource($order);
        return [new OrderResource($order), new StockOrderResource($stockorder[0])];
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        StockOrder::createStockOrderFromOrder($order->id, $request);
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
