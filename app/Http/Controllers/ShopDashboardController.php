cat > ~/bike_hub/app/Http/Controllers/ShopDashboardController.php << 'EOF'
<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopDashboardController extends Controller
{
    public function index()
    {
        $shop = Shop::where('user_id', auth()->id())->firstOrFail();

        $orders = Order::where('shop_id', $shop->id)
            ->with('items.product', 'user')
            ->latest()
            ->get();

        $products = Product::where('shop_id', $shop->id)->latest()->get();

        $totalRevenue = $orders->where('status', 'delivered')->sum('total_amount');
        $totalOrders = $orders->count();
        $pendingOrders = $orders->where('status', 'pending')->count();
        $lowStock = $products->where('stock', '<=', 3)->count();

        return view('shop.dashboard', compact(
            'shop', 'orders', 'products',
            'totalRevenue', 'totalOrders', 'pendingOrders', 'lowStock'
        ));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'Order status updated!');
    }
}
EOF