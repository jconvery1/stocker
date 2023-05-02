<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreOrderRequest;
use App\Mail\OrderStock;
use App\Models\Order;
use App\Models\StockItem;
use App\Models\StockOrder;
use App\Models\Supplier;
use App\Models\User;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);

        foreach ($orders as $order) {
            $supplier = Supplier::find($order->supplier_id);
            $user = User::find($order->user_id);
            $order->supplier_name = $supplier->name;
            $order->user_name = $user->username;
        }

        return $orders;
    }

    public function orderDropdown()
    {
        // return Order::all()->map(function ($order) {
        //     $supplier = Supplier::find($order->supplier_id);
        //     $user = User::find($order->user_id);
        //     $order->supplier_name = $supplier->name;
        //     $order->user_name = $user->username;
        //     return $order;
        // });

        $orders = Order::all();

        foreach ($orders as $order) {
            $supplier = Supplier::find($order->supplier_id);
            $user = User::find($order->user_id);
            $order->supplier_name = $supplier->name;
            $order->user_name = $user->username;
        }

        return $orders;
    }

    public function show(Order $order)
    {
        return StockOrder::where('order_id', $order->id)->get()->map(function ($stockOrder) {
            $order = Order::find($stockOrder->order_id);
            $supplier = Supplier::find($order->supplier_id);
            $stockItem = StockItem::find($stockOrder->stock_item_id);
            $stockOrder->supplier_id = $supplier->id;
            $stockOrder->stock_item_name = $stockItem->name;
            $stockOrder->barcode = $stockItem->barcode;
            $stockOrder->notes = $order->notes;
            return $stockOrder;
        });
    }

    public function store(StoreOrderRequest $request)
    {
        $order = Order::create($request->validated());
        StockOrder::createStockOrderFromOrder($order->id, $request->stock_orders);
        $stockOrders = StockOrder::where('order_id', $order->id)->get();
        foreach($stockOrders as $stockOrder) {
            $stockItem = StockItem::find($stockOrder->stock_item_id);
            $stockOrder->item_name = $stockItem->name;
        }
        $supplier = Supplier::find($order->supplier_id);
        Mail::to($supplier->email)->send(new OrderStock($order, $stockOrders));
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
        $stockOrders = StockOrder::where('order_id', $order->id)->get();
        $order->fulfill($order);
        StockItem::updateStockLevelsFromFulfillment($stockOrders);
        return response()->json("order fulfilled!");
    }
}
