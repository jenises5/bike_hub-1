<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Dashboard — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem;transition:color .2s}.nav-links a:hover{color:var(--text)}
        .nav-active{color:var(--text)!important}
        .nav-user{display:flex;align-items:center;gap:.75rem}
        .user-avatar{width:34px;height:34px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;color:#000}
        .user-role{font-size:.7rem;color:var(--accent);text-transform:uppercase;letter-spacing:.08em}
        .btn-logout{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.4rem .9rem;border-radius:4px;font-size:.8rem;cursor:pointer;text-decoration:none;transition:all .2s}
        .btn-logout:hover{border-color:var(--text);color:var(--text)}
        .page-header{padding:2.5rem 2rem 0;max-width:1200px;margin:0 auto}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2rem;margin-bottom:.25rem}
        .page-header p{color:var(--muted);font-size:.9rem}
        .content{padding:2rem;max-width:1200px;margin:0 auto}
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:2rem}
        .stat-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem;position:relative;overflow:hidden}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--accent)}
        .stat-card.danger::before{background:#ef4444}
        .stat-icon{font-size:1.5rem;margin-bottom:.75rem}
        .stat-num{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;color:var(--accent);line-height:1;margin-bottom:.25rem}
        .stat-card.danger .stat-num{color:#ef4444}
        .stat-label{font-size:.8rem;color:var(--muted)}
        .tabs{display:flex;gap:0;border-bottom:1px solid var(--border);margin-bottom:1.5rem}
        .tab{padding:.75rem 1.5rem;font-size:.9rem;font-weight:500;cursor:pointer;border-bottom:2px solid transparent;color:var(--muted);transition:all .2s;background:none;border-top:none;border-left:none;border-right:none}
        .tab.active{color:var(--accent);border-bottom-color:var(--accent)}
        .tab:hover{color:var(--text)}
        .tab-content{display:none}.tab-content.active{display:block}
        .section-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem;margin-bottom:1.5rem}
        .section-card h2{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;margin-bottom:1.2rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);display:flex;justify-content:space-between;align-items:center}
        .order-row{display:grid;grid-template-columns:60px 1fr auto auto;gap:1rem;align-items:center;padding:.85rem 0;border-bottom:1px solid var(--border)}
        .order-row:last-child{border-bottom:none}
        .order-id{font-weight:600;font-size:.9rem}
        .order-customer{font-size:.8rem;color:var(--muted)}
        .order-amount{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--accent)}
        .status-select{background:var(--surface);border:1px solid var(--border);color:var(--text);padding:.3rem .6rem;border-radius:4px;font-size:.8rem;cursor:pointer;outline:none}
        .status-select:focus{border-color:var(--accent)}
        .status-badge{display:inline-block;padding:.2rem .6rem;border-radius:3px;font-size:.7rem;font-weight:600;text-transform:uppercase}
        .status-pending{background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.3)}
        .status-processing{background:rgba(99,102,241,.1);color:#818cf8;border:1px solid rgba(99,102,241,.3)}
        .status-shipped{background:rgba(14,165,233,.1);color:#38bdf8;border:1px solid rgba(14,165,233,.3)}
        .status-delivered{background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.3)}
        .status-cancelled{background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.3)}
        .product-row{display:grid;grid-template-columns:1fr auto auto auto;gap:1rem;align-items:center;padding:.75rem 0;border-bottom:1px solid var(--border)}
        .product-row:last-child{border-bottom:none}
        .product-name{font-weight:600;font-size:.9rem;margin-bottom:.2rem}
        .product-brand{font-size:.75rem;color:var(--muted)}
        .product-price{font-family:'Bebas Neue',sans-serif;font-size:1rem;color:var(--accent)}
        .stock-num{font-weight:600;font-size:.9rem}
        .stock-low{color:#ef4444}
        .stock-ok{color:#4ade80}
        .btn-sm{padding:.35rem .75rem;border-radius:4px;font-size:.8rem;font-weight:600;cursor:pointer;text-decoration:none;border:none}
        .btn-edit{background:rgba(232,255,0,.1);color:var(--accent);border:1px solid rgba(232,255,0,.2)}
        .btn-edit:hover{background:rgba(232,255,0,.2)}
        .alert{padding:.8rem 1rem;border-radius:6px;margin-bottom:1rem;font-size:.9rem}
        .alert-success{background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.3);color:#4ade80}
        .empty-text{color:var(--muted);font-size:.85rem;text-align:center;padding:2rem 0}
        .btn-add{background:var(--accent);color:#000;padding:.5rem 1rem;border-radius:6px;text-decoration:none;font-weight:600;font-size:.85rem}
        @media(max-width:768px){.stats-grid{grid-template-columns:repeat(2,1fr)}.order-row{grid-template-columns:1fr auto}.product-row{grid-template-columns:1fr auto}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('shop.dashboard') }}" class="nav-active">Dashboard</a>
        <a href="{{ route('shops.show', $shop->slug) }}">My Shop</a>
        <a href="{{ route('products.index') }}">Browse</a>
    </div>
    <div class="nav-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div style="font-size:.9rem;font-weight:500">{{ auth()->user()->name }}</div>
            <div class="user-role">Shop Owner</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <h1>🏪 {{ $shop->name }}</h1>
    <p>Shop Owner Dashboard — {{ now()->format('F d, Y') }}</p>
</div>

<div class="content">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-num">₱{{ number_format($totalRevenue, 0) }}</div>
            <div class="stat-label">Total Revenue</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-num">{{ $totalOrders }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-num">{{ $pendingOrders }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
        <div class="stat-card {{ $lowStock > 0 ? 'danger' : '' }}">
            <div class="stat-icon">⚠️</div>
            <div class="stat-num">{{ $lowStock }}</div>
            <div class="stat-label">Low Stock Items</div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="tabs">
        <button class="tab active" onclick="switchTab('orders', this)">📦 Orders ({{ $totalOrders }})</button>
        <button class="tab" onclick="switchTab('products', this)">🚲 Products ({{ $products->count() }})</button>
        <button class="tab" onclick="switchTab('analytics', this)">📊 Analytics</button>
    </div>

    <!-- Orders Tab -->
    <div id="tab-orders" class="tab-content active">
        <div class="section-card">
            <h2>All Orders</h2>
            @if($orders->count() > 0)
                @foreach($orders as $order)
                <div class="order-row">
                    <div>
                        <div class="order-id">#{{ $order->id }}</div>
                        <div class="order-customer">{{ $order->created_at->format('M d') }}</div>
                    </div>
                    <div>
                        <div style="font-weight:600;font-size:.9rem">{{ $order->user->name ?? 'Customer' }}</div>
                        <div style="font-size:.75rem;color:var(--muted)">{{ $order->delivery_address }}</div>
                        <div style="font-size:.75rem;color:var(--muted);margin-top:.2rem">
                            {{ $order->items->count() }} item(s) · {{ ucfirst($order->payment_method) }}
                        </div>
                    </div>
                    <div class="order-amount">₱{{ number_format($order->total_amount, 0) }}</div>
                    <form action="{{ route('shop.orders.status', $order) }}" method="POST">
                        @csrf @method('PATCH')
                        <select name="status" class="status-select" onchange="this.form.submit()">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
                @endforeach
            @else
                <div class="empty-text">No orders yet. Share your shop to get started!</div>
            @endif
        </div>
    </div>

    <!-- Products Tab -->
    <div id="tab-products" class="tab-content">
        <div class="section-card">
            <h2>
                My Products
                <a href="#" class="btn-add">+ Add Product</a>
            </h2>
            @if($products->count() > 0)
                @foreach($products as $product)
                <div class="product-row">
                    <div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-brand">{{ $product->brand }} · {{ ucfirst($product->category) }}</div>
                    </div>
                    <div class="product-price">₱{{ number_format($product->price, 0) }}</div>
                    <div class="stock-num {{ $product->stock <= 3 ? 'stock-low' : 'stock-ok' }}">
                        {{ $product->stock }} left
                    </div>
                    <a href="#" class="btn-sm btn-edit">Edit</a>
                </div>
                @endforeach
            @else
                <div class="empty-text">No products yet.</div>
            @endif
        </div>
    </div>

    <!-- Analytics Tab -->
    <div id="tab-analytics" class="tab-content">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-num">{{ $orders->where('status','delivered')->count() }}</div>
                <div class="stat-label">Delivered Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🚚</div>
                <div class="stat-num">{{ $orders->where('status','shipped')->count() }}</div>
                <div class="stat-label">Shipped Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">❌</div>
                <div class="stat-num">{{ $orders->where('status','cancelled')->count() }}</div>
                <div class="stat-label">Cancelled Orders</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🚲</div>
                <div class="stat-num">{{ $products->where('is_available', true)->count() }}</div>
                <div class="stat-label">Active Products</div>
            </div>
        </div>
        <div class="section-card">
            <h2>Top Products by Stock</h2>
            @foreach($products->sortByDesc('stock')->take(5) as $product)
            <div class="product-row">
                <div>
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-brand">{{ ucfirst($product->category) }}</div>
                </div>
                <div class="product-price">₱{{ number_format($product->price, 0) }}</div>
                <div class="stock-num {{ $product->stock <= 3 ? 'stock-low' : 'stock-ok' }}">
                    {{ $product->stock }} in stock
                </div>
                <div></div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}
</script>
</body>
</html>
