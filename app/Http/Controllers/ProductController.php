<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('shop')
            ->where('is_available', true)
            ->when($request->search, fn($q) =>
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('brand', 'like', '%'.$request->search.'%')
            )
            ->when($request->category, fn($q) =>
                $q->where('category', $request->category)
            )
            ->when($request->max_price, fn($q) =>
                $q->where('price', '<=', $request->max_price)
            )
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products'));
    }

    public function show($slug)
{
    $product = Product::with('shop')->where('slug', $slug)->firstOrFail();
    $related = Product::with('shop')
        ->where('category', $product->category)
        ->where('id', '!=', $product->id)
        ->where('is_available', true)
        ->limit(4)->get();
    return view('products.show', compact('product', 'related'));
}
}