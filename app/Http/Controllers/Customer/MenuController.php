<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Mengambil menu favorit
        $favoriteMenus = Menu::where('is_favorite', true)
            ->take(3)
            ->get();

        // Mengambil menu terbaru
        $newMenus = Menu::latest()
            ->take(3)
            ->get();

        // Menghitung kategori
        $categories = Menu::select('category')
            ->selectRaw('count(*) as count')
            ->groupBy('category')
            ->get();

        return view('customer.menu', compact('favoriteMenus', 'newMenus', 'categories'));
    }
}
