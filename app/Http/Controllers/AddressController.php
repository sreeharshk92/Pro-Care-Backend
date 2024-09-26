<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function storeAddress(Request $req)
    {

        $req->validate([
            'user_id' => 'required|exists:users,id',
            'order_id' => 'required|exists:orders,id',
            'first_name' => 'required|string|max:255',
            'phone_number' => 'required|numeric|min:10',
            'email_address' => 'required|string|email',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'zip_code' => 'required|numeric',
        ]);

        $address = new Address();
        $address->user_id = $req->user_id;
        $address->order_id = $req->order_id;
        $address->first_name = $req->first_name;
        $address->phone_number = $req->phone_number;
        $address->email_address = $req->email_address;
        $address->street_address = $req->street_address;
        $address->city = $req->city;
        $address->state = $req->state;
        $address->country = $req->country;
        $address->zip_code = $req->zip_code;
        $address->save();

        return response()->json(['message' => 'Address saved', 'address' => $address], 201);
    }

    public function getAddressByOrderId($orderId)
    {
        $address = Address::where('order_id', $orderId)->first();
        if ($address) {
            return response()->json($address);
        } else {
            return response()->json(['message' => 'Address not found'], 404);
        }
    }


    public function getLatestOrderId(Request $request)
    {

        $userId = $request->user_id;

        $latestOrder = Order::where('user_id', $userId)->latest()->first();

        if ($latestOrder) {
            return response()->json(['order_id' => $latestOrder->id]);
        } else {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }
    }
}
