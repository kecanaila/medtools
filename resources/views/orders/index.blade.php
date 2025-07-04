@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">My Orders</h1>
            <p class="mt-2 text-sm text-gray-600">
                Track your orders and view order history
            </p>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <!-- Order Header -->
                        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        Order #{{ $order->order_number }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}
                                    </p>
                                </div>
                                <div class="mt-2 sm:mt-0">
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

                        <!-- Order Items -->
                        <div class="px-6 py-4">
                            <div class="space-y-4">
                                @foreach($order->items as $item)
                                    <div class="flex items-center">
                                        <!-- Product Image -->
                                        <div class="flex-shrink-0 w-16 h-16">
                                            @if($item->product->linkImage)
                                                <img src="{{ $item->product->linkImage }}" alt="{{ $item->product->name }}" 
                                                     class="w-full h-full object-cover rounded-md">
                                            @else
                                                <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="ml-4 flex-1">
                                            <div class="flex justify-between">
                                                <div>
                                                    <h4 class="text-sm font-medium text-gray-900">
                                                        <a href="{{ route('products.show', $item->product) }}" class="hover:text-blue-600">
                                                            {{ $item->product->name }}
                                                        </a>
                                                    </h4>
                                                    <p class="text-sm text-gray-600">
                                                        Qty: {{ $item->quantity }}
                                                    </p>
                                                    @if($item->product->vendor)
                                                        <p class="text-xs text-gray-500">
                                                            Sold by: {{ $item->product->vendor->store_name }}
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-medium text-gray-900">
                                                        Rp.{{ number_format($item->price * $item->quantity, 2) }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">
                                                        Rp.{{ number_format($item->price, 2) }} each
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Order Summary -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                <div class="space-y-2">
                                    @if($order->shipping_address)
                                        <div class="text-sm text-gray-600">
                                            <strong>Shipping Address:</strong><br>
                                            {{ $order->shipping_address }}
                                        </div>
                                    @endif
                                    
                                    @if($order->notes)
                                        <div class="text-sm text-gray-600">
                                            <strong>Notes:</strong> {{ $order->notes }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="mt-4 sm:mt-0 text-right">
                                    <div class="text-sm text-gray-600">
                                        <span class="font-medium">Total:</span> Rp.{{ number_format($order->total_amount, 2) }}
                                    </div>
                                    
                                    @if($order->payment_status)
                                        <div class="text-sm text-gray-600">
                                            <span class="font-medium">Payment:</span> 
                                            <span class="text-green-600">{{ ucfirst($order->payment_status) }}</span>
                                        </div>
                                    @endif
                                    
                                    <div class="mt-2">
                                        <a href="{{ route('orders.show', $order) }}" 
                                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No orders yet</h3>
                <p class="mt-1 text-sm text-gray-500">Start shopping to see your orders here.</p>
                <div class="mt-6">
                    <a href="{{ route('products.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection 