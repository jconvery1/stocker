<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDeliveryRequest;
use App\Http\Resources\DeliveryResource;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\User;

class DeliveryController extends Controller
{
    public function index()
    {
        return Delivery::all()->map(function ($delivery) {
            $user = User::where('id', $delivery->user_id)->get();
            $delivery->user_name = $user[0]->username;
            return $delivery;
        });
    }

    public function show(Delivery $delivery)
    {
        return new DeliveryResource($delivery);
    }

    public function store(StoreDeliveryRequest $request)
    {
        Delivery::create($request->validated());
        $order = Order::where('id', $request->order_id)->get();
        $order[0]->fulfilled = 1;
        $order[0]->save();
        return response()->json("delivery created!");
    }

    public function update(StoreDeliveryRequest $request, Delivery $delivery)
    {
        if ($delivery->order_id != $request->order_id) {
            //unfulfill previous order
            $previousOrder = Order::where('id', $delivery->order_id)->get();
            $previousOrder[0]->fulfilled = 0;
            $previousOrder[0]->save();

            //fulfill new order
            $order = Order::where('id', $request->order_id)->get();
            $order[0]->fulfilled = 1;
            $order[0]->save();
        }

        $delivery->update($request->validated());
        return response()->json("delivery updated");
    }

    public function destroy(Delivery $delivery)
    {
        //mark order as unfulfilled if delivery is deleted
        $order = Order::where('id', $delivery->order_id)->get();
        $order[0]->fulfilled = 0;
        $order[0]->save();
        $delivery->delete();
        return response()->json("delivery deleted");
    }
}
