<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getOrCreateCart(Request $request)
    {
        $cart = Cart::where('user_id', $request->user()->id)->first();
        if (!$cart) {
            $cart = Cart::create(['user_id' => $request->user()->id]);
        }
        return $cart;
    }

    public function addToCart(Request $request)
    {
        // Check if user is a customer
        if (!Auth::user()->isCustomer()) {
            return back()->with('error', 'Only customers can add items to cart.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        
        // Check if product is active
        if (!$product->is_active) {
            return back()->with('error', 'Product is not available.');
        }

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stock is insufficient.');
        }

        $cart = $this->getOrCreateCart($request);

        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function viewCart(Request $request)
    {
        // Check if user is a customer
        if (!Auth::user()->isCustomer()) {
            return redirect()->route('home')->with('error', 'Only customers can view cart.');
        }

        $cart = $this->getOrCreateCart($request);
        $cartItems = $cart->load('items.product')->items;
        return view('cart.view', compact('cartItems', 'cart'));
    }

    public function updateCartItem(Request $request, CartItem $item)
    {
        // Check if user owns this cart item
        if ($item->cart->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized access.');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($item->product->stock < $request->quantity) {
            return back()->with('error', 'Stock is insufficient.');
        }

        $item->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Quantity updated successfully!');
    }

    public function removeCartItem(CartItem $item)
    {
        // Check if user owns this cart item
        if ($item->cart->user_id !== Auth::id()) {
            return back()->with('error', 'Unauthorized access.');
        }

        $item->delete();
        return back()->with('success', 'Product removed from cart.');
    }

    public function clearCart(Request $request)
    {
        $cart = $this->getOrCreateCart($request);
        $cart->items()->delete();
        return back()->with('success', 'Cart cleared successfully.');
    }
}
