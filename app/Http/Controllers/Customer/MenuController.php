<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    //
    public function index()
    {
        $categories = Category::pluck('name');
        $products = Product::with('reviews')->get()->groupBy('category.name');

        return view('customer.menu', compact('categories', 'products'));
    }
}
