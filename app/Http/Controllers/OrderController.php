<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Notifications\BookingStatusNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function storeBooking(Request $req)
    {
        $req->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'prefferable_time' => 'required',
            'quantity' => 'required|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        $order = new Order();
        $order->user_id = $req->user_id;
        $order->service_id = $req->service_id;
        $order->prefferable_time = $req->prefferable_time;
        $order->quantity = $req->quantity;
        $order->total_price = $req->total_price;
        $order->payment_method = $req->payment_method;
        $order->save();

        $order = Order::with('service')->get();

        return response()->json(['message' => 'Oder place successfully', 'order' => $order], 201);
    }

    public function bookingList()
    {
        $orderList = Order::with('service')->get();
        return response()->json($orderList);
    }


public function searchBooking($key)
{
   
    return Order::join('services', 'orders.service_id', '=', 'services.id')
    ->where('services.name', 'Like', "%$key%")
    ->select('orders.*', 'services.name as service_name')
    ->get();
}
   
}
