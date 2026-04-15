<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with('shop')
            ->latest()
            ->get();
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $firstItem = collect($cart)->first();
        $product = Product::find($firstItem['id']);

        $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

        $order = Order::create([
            'user_id' => auth()->id(),
            'shop_id' => $product->shop_id,
            'status' => 'pending',
            'total_amount' => $total,
            'delivery_address' => $request->delivery_address,
            'payment_method' => $request->payment_method,
            'payment_status' => 'unpaid',
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
            // Reduce stock
            Product::find($item['id'])->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');
        return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'shop');
        return view('orders.show', compact('order'));
    }
}