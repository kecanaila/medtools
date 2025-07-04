@extends('layouts.app')

@section('content')
<div class="bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">Order #{{ $order->id }}</h1>
            <p class="mt-2 text-sm text-gray-600">Customer: {{ $order->user->name ?? '-' }}</p>
            <p class="mt-1 text-sm text-gray-600">Status: <span class="font-semibold">{{ ucfirst($order->status) }}</span></p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg overflow-x-auto mb-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Qty</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($vendorItems as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp.{{ number_format($item->price, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp.{{ number_format($item->price * $item->quantity, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No products found for this order.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-900 mb-2">Shipping Address</h2>
            <p class="text-sm text-gray-700">{{ $order->shipping_address ?? '-' }}</p>
        </div>
        <a href="{{ route('vendor.orders.index') }}" class="text-blue-600 hover:text-blue-900">← Back to Orders</a>
    </div>
</div>
@endsection 