<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function deleteCartItemApi(CartItem $cartItem)
    {
        $user = auth()->user();
        if ($user->isAdmin === 1) {
            return "You are an admin, you cannot add purchase any product";
        }

        $cartItem->delete();
        return response()->json(['message' => 'Cart item deleted successfully']);

    }
    public function getAllCartItemsApi()
    {
        $user = auth()->user();
        if ($user->isAdmin === 1) {
            return "You are an admin, you cannot add purchase any product";
        }

        $cart = Cart::where('user_id', $user->id)->first();

        if (!$cart) {
            return response()->json(['cart_items' => []]);
        }

        $cartItems = CartItem::with('product')
            ->where('cart_id', $cart->id)
            ->get();
        return response()->json([
            'cart_items' => $cartItems
        ]);
    }
    public function addToCartApi(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin === 1) {
            return "You are an admin, you cannot add purchase any product";
        }

        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "required|integer|min:1",
        ]);

        $cart = Cart::firstOrCreate(
            ["user_id" => $user->id]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return response()->json(['message' => 'Product added to cart successfully', 'cart_id' => $cart->id], 201);

    }
}
