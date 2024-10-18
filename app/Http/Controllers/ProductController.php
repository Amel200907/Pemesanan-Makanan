<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function show(Product $product)
{
    return view('products.show', compact('product'));
}
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
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
                       ->orWhere('description', 'like', "%$query%")
                       ->paginate(12);
        return view('products.index', compact('products', 'query'));
    }
    public function index(Request $request)
{
    $query = Product::query();

    // Filter
    if ($request->has('category')) {
        $query->where('category', $request->category);
    }

    // Sort
    if ($request->has('sort')) {
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
        }
    }

    $products = $query->paginate(12);

    return view('products.index', compact('products'));
    }
}
