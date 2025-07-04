<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Pastikan user yang login adalah pemilik order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        // Admin: can see all (optional, add if needed)

        $order->load('items.product');
        return view('orders.show', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        // Pastikan user yang login adalah pemilik order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dibatalkan jika statusnya pending
        if ($order->status === 'pending') {
            $order->update(['status' => 'cancelled']);

            // Kembalikan stok produk
            foreach ($order->items as $item) {
                $item->product->increment('stock', $item->quantity);
            }
            return back()->with('success', 'Pesanan berhasil dibatalkan dan stok dikembalikan.');
        }

        return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
    }

    public function vendorOrders()
    {
        $user = Auth::user();
        $orders = \App\Models\Order::whereHas('items.product', function ($query) use ($user) {
            $query->where('vendor_id', $user->id);
        })->with('user', 'items.product')->get();

        return view('vendor.orders.index', compact('orders'));
    }

    public function vendorUpdateStatus(Request $request, Order $order)
    {
        $user = Auth::user();

        // Only allow vendors to update orders containing their products
        if (
            !$user->isVendor() || !$order->items()->whereHas('product', function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->exists()
        ) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'status' => 'required|in:pending,processing,shipped,completed,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated.');
    }

    public function vendorShowOrder(Order $order)
    {
        $user = Auth::user();
        if (
            !$user->isVendor() || !$order->items()->whereHas('product', function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })->exists()
        ) {
            abort(403, 'Unauthorized action.');
        }
        // Ambil hanya item produk milik vendor ini
        $vendorItems = $order->items()->whereHas('product', function ($q) use ($user) {
            $q->where('vendor_id', $user->id);
        })->with('product')->get();
        $order->load('user');
        return view('vendor.orders.show', [
            'order' => $order,
            'vendorItems' => $vendorItems,
        ]);
    }
}

