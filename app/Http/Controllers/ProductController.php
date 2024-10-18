<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function rate(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product->rating = (($product->rating * $product->rating_count) + $request->rating) / ($product->rating_count + 1);
        $product->rating_count++;
        $product->save();

        return redirect()->back()->with('success', 'Rating submitted successfully!');
    }

    public function like(Product $product)
    {
        $product->increment('likes');
        return redirect()->back()->with('success', 'Product liked successfully!');
    }
}
