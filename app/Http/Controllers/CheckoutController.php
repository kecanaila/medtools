<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (!$user->isCustomer()) {
            return redirect()->route('home')->with('error', 'Only customers can checkout.');
        }

        $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        $cartItems = $cart->items;

        return view('checkout.index', compact('cart', 'cartItems'));
    }

    public function processCheckout(Request $request)
    {
        $user = Auth::user();

        if (!$user->isCustomer()) {
            return redirect()->route('home')->with('error', 'Only customers can checkout.');
        }

        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'payment_method' => 'required|in:midtrans,Dana,BNI,Utang',
        ]);

        $cart = Cart::where('user_id', $user->id)->with('items.product.vendor')->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => $user->id,
                'total_amount' => $cart->getTotalAmount(),
                'shipping_address' => $request->shipping_address,
                'phone' => $request->phone,
                'payment_method' => $request->payment_method,
                'notes' => $request->notes,
                'status' => 'paid',
            ]);

            foreach ($cart->items as $item) {
                $product = $item->product;
                if ($product->stock < $item->quantity) {
                    DB::rollBack();
                    return back()->with('error', 'Stock for product ' . $product->name . ' is insufficient.');
                }

                $product->decrement('stock', $item->quantity);

                //array untuk menampilkan produk yang dibeli
                $order->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $item->quantity,
                    'price' => $product->price,
                ]);
            }

            $cart->items()->delete();
            $cart->delete();

            DB::commit();

            // Send email notifications
            $this->sendOrderNotifications($order);

            return redirect()->route('orders.show', $order)->with('success', 'Order created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
    }

    private function processMidtransPayment($order)
    {
        // Initialize Midtrans configuration
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . $order->id,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => $order->phone,
            ],
            'item_details' => $order->items->map(function ($item) {
                return [
                    'id' => $item->product_id,
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'name' => $item->product->name,
                ];
            })->toArray(),
        ];


    }



    public function paymentCallback(Request $request)
    {
        $orderId = $request->order_id;
        $order = Order::where('id', str_replace('ORDER-', '', $orderId))->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $status = $request->transaction_status;
        $fraudStatus = $request->fraud_status;

        if ($status == 'capture') {
            if ($fraudStatus == 'challenge') {
                $order->update(['status' => 'challenge']);
            } else if ($fraudStatus == 'accept') {
                $order->update(['status' => 'paid']);
                $this->sendOrderNotifications($order);
            }
        } else if ($status == 'settlement') {
            $order->update(['status' => 'paid']);
            $this->sendOrderNotifications($order);
        } else if ($status == 'cancel' || $status == 'deny' || $status == 'expire') {
            $order->update(['status' => 'cancelled']);
        } else if ($status == 'pending') {
            $order->update(['status' => 'pending']);
        }

        return response()->json(['success' => true]);
    }

    private function sendOrderNotifications($order)
    {
        Log::info('Mulai kirim email order');
        $pdf = PDF::loadView('emails.invoice', ['order' => $order]);
        Log::info('PDF berhasil dibuat');
        Mail::to($order->user->email)->send(new \App\Mail\OrderConfirmation($order, $pdf->output()));
        Log::info('Email order terkirim');
    }
}
