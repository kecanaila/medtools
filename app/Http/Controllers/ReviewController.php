<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        // Pastikan user sudah pernah membeli produk ini (opsional, tapi disarankan)
        // $hasPurchased = Auth::user()->orders()->whereHas('items', function($query) use ($product) {
        //     $query->where('product_id', $product->id);
        // })->exists();

        // if (!$hasPurchased) {
        //     return back()->with('error', 'Anda hanya bisa memberikan ulasan untuk produk yang telah Anda beli.');
        // }

        // Cek apakah user sudah pernah memberikan review untuk produk ini
        $existingReview = $product->reviews()->where('user_id', Auth::id())->first();

        if ($existingReview) {
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            return back()->with('success', 'Ulasan Anda berhasil diperbarui!');
        }

        $product->reviews()->create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }
}
