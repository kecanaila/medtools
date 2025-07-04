@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Order #{{ $order->order_number }}</h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}
                    </p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('orders.index') }}" 
                       class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        ← Back to Orders
                    </a>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($order->status === 'shipped') bg-purple-100 text-purple-800
                        @elseif($order->status === 'delivered') bg-green-100 text-green-800
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Order Items</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($order->items as $item)
                            <div class="px-6 py-4">
                                <div class="flex items-center">
                                    <!-- Product Image -->
                                    <div class="flex-shrink-0 w-20 h-20">
                                        @if($item->product->linkImage)
                                            <img src="{{ $item->product->linkImage }}" alt="{{ $item->product->name }}" 
                                                 class="w-full h-full object-cover rounded-md">
                                        @else
                                            <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Product Details -->
                                    <div class="ml-4 flex-1">
                                        <div class="flex justify-between">
                                            <div>
                                                <h3 class="text-lg font-medium text-gray-900">
                                                    <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600">
                                                        {{ $item->product->name }}
                                                    </a>
                                                </h3>
                                                <p class="text-sm text-gray-600">
                                                    {{ Str::limit($item->product->description, 100) }}
                                                </p>
                                                @if($item->product->vendor)
                                                    <p class="text-sm text-gray-500 mt-1">
                                                        Sold by: {{ $item->product->vendor->store_name }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-medium text-gray-900">
                                                    Rp.{{ number_format($item->price * $item->quantity, 2) }}
                                                </p>
                                                <p class="text-sm text-gray-500">
                                                    Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="bg-white border border-gray-200 rounded-lg">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Shipping Information</h2>
                    </div>
                    
                    <div class="px-6 py-4">
                        @if($order->shipping_address)
                            <div class="space-y-2">
                                <p class="text-sm text-gray-600">
                                    <strong>Address:</strong><br>
                                    {{ $order->shipping_address }}
                                </p>
                            </div>
                        @else
                            <p class="text-sm text-gray-500">No shipping address provided.</p>
                        @endif
                    </div>
                </div>

                <!-- Order Notes -->
                @if($order->notes)
                    <div class="bg-white border border-gray-200 rounded-lg">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-medium text-gray-900">Order Notes</h2>
                        </div>
                        
                        <div class="px-6 py-4">
                            <p class="text-sm text-gray-600">{{ $order->notes }}</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-gray-200 rounded-lg p-6 sticky top-4">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Order Summary</h2>
                    
                    <!-- Order Status Timeline -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Order Status</h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">Order Placed</p>
                                    <p class="text-xs text-gray-500">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                            
                            @if($order->status !== 'pending')
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-3 h-3 bg-blue-400 rounded-full"></div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Processing</p>
                                        <p class="text-xs text-gray-500">Order confirmed</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if(in_array($order->status, ['shipped', 'delivered']))
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-3 h-3 bg-purple-400 rounded-full"></div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Shipped</p>
                                        <p class="text-xs text-gray-500">On its way</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($order->status === 'delivered')
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Delivered</p>
                                        <p class="text-xs text-gray-500">Order completed</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Payment Information -->
                    <div class="mb-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Payment Information</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Payment Method:</span>
                                <span class="text-gray-900">{{ ucfirst($order->payment_method ?? 'Not specified') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Payment Status:</span>
                                <span class="text-green-600 font-medium">{{ ucfirst($order->status ?? 'Pending') }}</span>
                            </div>
                            @if($order->transaction_id)
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Transaction ID:</span>
                                    <span class="text-gray-900 font-mono text-xs">{{ $order->transaction_id }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Price Breakdown -->
                    <div class="border-t border-gray-200 pt-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-3">Price Breakdown</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="text-gray-900">Rp.{{ number_format($order->total_amount / 1.11, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tax (11%)</span>
                                <span class="text-gray-900">Rp.{{ number_format($order->total_amount - ($order->total_amount / 1.11), 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Shipping</span>
                                <span class="text-gray-900">Free</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2">
                                <div class="flex justify-between text-lg font-medium">
                                    <span class="text-gray-900">Total</span>
                                    <span class="text-blue-600">Rp.{{ number_format($order->total_amount, 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 space-y-3">
                        @if($order->status === 'delivered')
                            <a href="{{ route('products.index') }}" 
                               class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 font-medium text-center block">
                                Shop Again
                            </a>
                        @endif
                        
                        @if($order->status === 'pending')
                            <form action="{{ route('orders.cancel', $order) }}" method="POST" class="inline w-full">
                                @csrf
                                <button type="submit" 
                                        class="w-full bg-red-600 text-white py-2 px-4 rounded-md hover:bg-red-700 font-medium"
                                        onclick="return confirm('Are you sure you want to cancel this order?')">
                                    Cancel Order
                                </button>
                            </form>
                        @endif
                        
                        @php
                            $user = Auth::user();
                        @endphp
                        
                        @if($user->isVendor())
                            @if($order->status === 'paid' || $order->status === 'processing')
                                <form action="{{ route('vendor.orders.update-status', $order) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="shipped" class="w-full bg-purple-600 text-white py-2 px-4 rounded-md hover:bg-purple-700 font-medium">
                                        Mark as Shipped
                                    </button>
                                </form>
                            @elseif($order->status === 'shipped')
                                <form action="{{ route('vendor.orders.update-status', $order) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="delivered" class="w-full bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 font-medium">
                                        Mark as Delivered
                                    </button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 