<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\StockItem;
use App\Models\StockOrder;
use App\Models\Supplier;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all()->map(function ($order) {
            $supplier = Supplier::where('id', $order->supplier_id)->get();
            $user = User::where('id', $order->user_id)->get();
            $order->supplier_name = $supplier[0]->name;
            $order->user_name = $user[0]->username;
            return $order;
        });
    }

    public function show(Order $order)
    {
        return StockOrder::where('order_id', $order->id)->get()->map(function ($stockOrder) {
            $order = Order::where('id', $stockOrder->order_id)->get();
            $supplier = Supplier::where('id', $order[0]->supplier_id)->get();
            $stockItem = StockItem::where('id', $stockOrder->stock_item_id)->get();
            $stockOrder->supplier_id = $supplier[0]->id;
            $stockOrder->stock_item_name = $stockItem[0]->name;
            return $stockOrder;
        });
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        StockOrder::createStockOrderFromOrder($order->id, $request->stock_orders);
        return response()->json("order created!");
    }

    public function update(StoreOrderRequest $request, Order $order)
    {
        $order->update($request->validated());
        StockOrder::updateStockOrdersForOrder($order->id, $request->stock_orders);
        return response()->json("order updated");
    }

    public function destroy(Order $order)
    {
        $order->deleteLinkedOrderItems($order);
        $order->delete();
        return response()->json("order deleted");
    }

    public function fulfillOrder(Order $order)
    {
        $order->fulfill($order);
        return response()->json("order fulfilled!");
    }
}
