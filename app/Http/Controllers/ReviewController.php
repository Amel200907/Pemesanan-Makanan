<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    //
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = new Review([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        $review->save();
        // Update product rating
        $avgRating = $product->reviews()->avg('rating');
        $product->update(['rating' => $avgRating, 'rating_count' => $product->reviews()->count()]);

        return back()->with('success', 'Ulasan Anda telah ditambahkan.');
    }
}
