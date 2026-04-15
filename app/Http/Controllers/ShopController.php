<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::withCount('products')->get();
        return view('shops.index', compact('shops'));
    }

    public function show($slug)
    {
        $shop = Shop::where('slug', $slug)
            ->withCount('products')
            ->firstOrFail();

        $products = $shop->products()
            ->where('is_available', true)
            ->latest()
            ->paginate(12);

        return view('shops.show', compact('shop', 'products'));
    }
}