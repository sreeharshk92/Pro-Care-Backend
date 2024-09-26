<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $cart = new Cart();
        $cart->user_id = $validatedData['user_id'];
        $cart->service_id = $validatedData['service_id'];
        $cart->save();

        return response()->json(['message' => 'Service added to cart successfully'], 201);
    }

    public function cartList(Request $req)
    {
        $carts = Cart::with('service')->get();
        return response()->json($carts);
    }


    public function deleteCart($id)
    {
        $result = Cart::where('id',$id)->delete();
        if($result)
        {
            return ['result' => 'Cart has been deleted'];
        }else{
            return ['result' => 'Cart already deleted'];
        }
    }
}
