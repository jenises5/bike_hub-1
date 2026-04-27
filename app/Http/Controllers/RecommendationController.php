<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('recommendations.index');
    }

    public function recommend(Request $request)
    {
        $request->validate([
            'budget' => 'required|numeric|min:1000',
            'use_case' => 'required|string',
        ]);

        $products = Product::with('shop')
            ->where('is_available', true)
            ->where('stock', '>', 0)
            ->where('price', '<=', $request->budget)
            ->when($request->category && $request->category !== 'any', fn($q) =>
                $q->where('category', $request->category)
            )
            ->get();

        $scored = $products->map(function ($product) use ($request) {
            $score = 0;
            $budgetRatio = $product->price / $request->budget;
            if ($budgetRatio >= 0.7) $score += 40;
            elseif ($budgetRatio >= 0.5) $score += 25;
            else $score += 10;

            $useCase = strtolower($request->use_case);
            $category = strtolower($product->category ?? '');
            $matches = [
                'commuting' => ['road', 'folding', 'electric'],
                'trail'     => ['mountain'],
                'racing'    => ['road'],
                'leisure'   => ['mountain', 'road', 'kids', 'folding'],
                'off-road'  => ['mountain'],
                'city'      => ['road', 'folding', 'electric'],
            ];

            foreach ($matches as $use => $cats) {
                if (str_contains($useCase, $use) && in_array($category, $cats)) {
                    $score += 35;
                    break;
                }
            }

            if ($product->stock >= 5) $score += 15;
            elseif ($product->stock >= 2) $score += 8;

            $premiumBrands = ['trek', 'giant', 'specialized', 'polygon', 'cube'];
            if (in_array(strtolower($product->brand ?? ''), $premiumBrands)) $score += 10;

            $product->ai_score = $score;
            return $product;
        });

        $recommendations = $scored->sortByDesc('ai_score')->take(6)->values();
        return view('recommendations.index', compact('recommendations', 'request'));
    }
}