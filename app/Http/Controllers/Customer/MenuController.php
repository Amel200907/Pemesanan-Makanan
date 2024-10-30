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
        $favoriteMenus = Menu::where('is_favorite', true)
            ->take(3)
            ->get();

        $newMenus = Menu::latest()
            ->take(3)
            ->get();

        $categories = Menu::select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->get();

        return view('menu.index', compact('favoriteMenus', 'newMenus', 'categories'));
    }
}
