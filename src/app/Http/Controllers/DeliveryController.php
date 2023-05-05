<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\StockItem;
use App\Models\StockOrder;
use App\Models\User;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::paginate(10);

        foreach ($deliveries as $delivery) {
            $user = User::find($delivery->user_id);
            $delivery->user_name = $user->username;
        }

        return $deliveries;
    }

    public function allDeliveries()
    {
        $deliveries = Delivery::all();

        foreach ($deliveries as $delivery) {
            $user = User::find($delivery->user_id);
            $delivery->user_name = $user->username;
        }

        return $deliveries;
    }

    public function show(Delivery $delivery)
    {
        return new DeliveryResource($delivery);
    }

    public function store(StoreDeliveryRequest $request)
    {
        Delivery::create($request->validated());
        $order = Order::find($request->order_id);
        $order->fulfilled = 1;
        $order->save();
        $stockOrders = StockOrder::where('order_id', $order->id)->get();
        StockItem::updateStockLevelsFromFulfillment($stockOrders);
        return response()->json("delivery created!");
    }

    public function update(StoreDeliveryRequest $request, Delivery $delivery)
    {
        if ($delivery->order_id != $request->order_id) {
            $previousOrder = Order::find($delivery->order_id);
            $previousOrder->fulfilled = 0;
            $previousOrder->save();
            $stockOrders = StockOrder::where('order_id', $previousOrder->id)->get();
            StockItem::updateStockLevelsFromDeliveryEdit($stockOrders);

            $order = Order::find($request->order_id);
            $order->fulfilled = 1;
            $order->save();
            $newStockOrders = StockOrder::where('order_id', $order->id)->get();
            StockItem::updateStockLevelsFromFulfillment($newStockOrders);
        }

        $delivery->update($request->validated());
        return response()->json("delivery updated");
    }

    public function destroy(Delivery $delivery)
    {
        $order = Order::find($delivery->order_id);
        $order->fulfilled = 0;
        $order->save();
        $delivery->delete();
        return response()->json("delivery deleted");
    }
}
