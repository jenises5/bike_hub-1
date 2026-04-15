cat > ~/bike_hub/resources/views/dashboard.blade.php << 'BLADE'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem;transition:color .2s}.nav-links a:hover{color:var(--text)}
        .nav-user{display:flex;align-items:center;gap:.75rem}
        .user-avatar{width:34px;height:34px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.85rem;color:#000}
        .user-name{font-size:.9rem;font-weight:500}
        .user-role{font-size:.7rem;color:var(--accent);text-transform:uppercase;letter-spacing:.08em}
        .btn-logout{background:transparent;color:var(--muted);border:1px solid var(--border);padding:.4rem .9rem;border-radius:4px;font-size:.8rem;cursor:pointer;text-decoration:none;transition:all .2s}
        .btn-logout:hover{border-color:var(--text);color:var(--text)}
        .page-header{padding:2.5rem 2rem 0}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2rem;margin-bottom:.25rem}
        .page-header p{color:var(--muted);font-size:.9rem}
        .content{padding:2rem;max-width:1100px;margin:0 auto}
        .stats-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin-bottom:2rem}
        .stat-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem;position:relative;overflow:hidden}
        .stat-card::before{content:'';position:absolute;top:0;left:0;right:0;height:2px;background:var(--accent)}
        .stat-icon{font-size:1.5rem;margin-bottom:.75rem}
        .stat-num{font-family:'Bebas Neue',sans-serif;font-size:2.5rem;color:var(--accent);line-height:1;margin-bottom:.25rem}
        .stat-label{font-size:.8rem;color:var(--muted)}
        .grid-2{display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem}
        .section-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem}
        .section-card h2{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;margin-bottom:1.2rem;padding-bottom:.75rem;border-bottom:1px solid var(--border)}
        .order-item{display:flex;justify-content:space-between;align-items:center;padding:.75rem 0;border-bottom:1px solid var(--border)}
        .order-item:last-child{border-bottom:none}
        .order-id{font-weight:600;font-size:.9rem;margin-bottom:.2rem}
        .order-meta{font-size:.75rem;color:var(--muted)}
        .order-total{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--accent)}
        .status-badge{display:inline-block;padding:.2rem .6rem;border-radius:3px;font-size:.7rem;font-weight:600;text-transform:uppercase;margin-left:.5rem}
        .status-pending{background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.3)}
        .status-delivered{background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.3)}
        .status-processing{background:rgba(99,102,241,.1);color:#818cf8;border:1px solid rgba(99,102,241,.3)}
        .quick-link{display:flex;align-items:center;gap:.75rem;padding:.75rem;border-radius:6px;text-decoration:none;color:var(--text);transition:background .2s;border:1px solid transparent}
        .quick-link:hover{background:var(--surface);border-color:var(--border)}
        .quick-link-icon{width:36px;height:36px;background:rgba(232,255,0,.08);border:1px solid rgba(232,255,0,.15);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:1rem}
        .quick-link-text .title{font-weight:600;font-size:.9rem;margin-bottom:.1rem}
        .quick-link-text .desc{font-size:.75rem;color:var(--muted)}
        .profile-info{display:flex;flex-direction:column;gap:.75rem}
        .profile-row{display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid var(--border)}
        .profile-row:last-child{border-bottom:none}
        .profile-label{font-size:.8rem;color:var(--muted)}
        .profile-value{font-size:.9rem;font-weight:500}
        .role-tag{background:rgba(232,255,0,.1);color:var(--accent);border:1px solid rgba(232,255,0,.2);padding:.2rem .6rem;border-radius:3px;font-size:.75rem;font-weight:600;text-transform:uppercase}
        .empty-text{color:var(--muted);font-size:.85rem;text-align:center;padding:1.5rem 0}
        .btn-primary{display:inline-block;background:var(--accent);color:#000;padding:.6rem 1.2rem;border-radius:6px;text-decoration:none;font-weight:600;font-size:.85rem;margin-top:.75rem}
        @media(max-width:768px){.grid-2{grid-template-columns:1fr}.stats-grid{grid-template-columns:repeat(2,1fr)}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('shops.index') }}">Shops</a>
        <a href="{{ route('cart.index') }}">🛒 Cart</a>
        <a href="{{ route('orders.index') }}">Orders</a>
    </div>
    <div class="nav-user">
        <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
        <div>
            <div class="user-name">{{ auth()->user()->name }}</div>
            <div class="user-role">{{ auth()->user()->role }}</div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="page-header">
    <h1>Welcome back, {{ explode(' ', auth()->user()->name)[0] }}! 👋</h1>
    <p>Here's what's happening with your BikeHub account.</p>
</div>

<div class="content">
    @php
        $orders = \App\Models\Order::where('user_id', auth()->id())->with('shop')->latest()->get();
        $totalSpent = $orders->sum('total_amount');
        $pendingOrders = $orders->where('status', 'pending')->count();
    @endphp

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">📦</div>
            <div class="stat-num">{{ $orders->count() }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">⏳</div>
            <div class="stat-num">{{ $pendingOrders }}</div>
            <div class="stat-label">Pending Orders</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💰</div>
            <div class="stat-num">₱{{ number_format($totalSpent, 0) }}</div>
            <div class="stat-label">Total Spent</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🚲</div>
            <div class="stat-num">{{ \App\Models\Product::count() }}</div>
            <div class="stat-label">Bikes Available</div>
        </div>
    </div>

    <div class="grid-2">
        <!-- Recent Orders -->
        <div class="section-card">
            <h2>Recent Orders</h2>
            @if($orders->count() > 0)
                @foreach($orders->take(5) as $order)
                <div class="order-item">
                    <div>
                        <div class="order-id">
                            Order #{{ $order->id }}
                            <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                        </div>
                        <div class="order-meta">{{ $order->shop->name }} · {{ $order->created_at->format('M d, Y') }}</div>
                    </div>
                    <div class="order-total">₱{{ number_format($order->total_amount, 0) }}</div>
                </div>
                @endforeach
                <a href="{{ route('orders.index') }}" class="btn-primary" style="display:block;text-align:center;margin-top:1rem">View All Orders</a>
            @else
                <div class="empty-text">No orders yet</div>
                <a href="{{ route('products.index') }}" class="btn-primary" style="display:block;text-align:center">Browse Bikes</a>
            @endif
        </div>

        <!-- Quick Links & Profile -->
        <div style="display:flex;flex-direction:column;gap:1.5rem">
            <div class="section-card">
                <h2>Quick Actions</h2>
                <a href="{{ route('products.index') }}" class="quick-link">
                    <div class="quick-link-icon">🚲</div>
                    <div class="quick-link-text"><div class="title">Browse Bikes</div><div class="desc">Find your perfect ride</div></div>
                </a>
                <a href="{{ route('cart.index') }}" class="quick-link">
                    <div class="quick-link-icon">🛒</div>
                    <div class="quick-link-text"><div class="title">View Cart</div><div class="desc">Check your cart items</div></div>
                </a>
                <a href="{{ route('orders.index') }}" class="quick-link">
                    <div class="quick-link-icon">📦</div>
                    <div class="quick-link-text"><div class="title">My Orders</div><div class="desc">Track your orders</div></div>
                </a>
                <a href="{{ route('shops.index') }}" class="quick-link">
                    <div class="quick-link-icon">🏪</div>
                    <div class="quick-link-text"><div class="title">Browse Shops</div><div class="desc">Explore local bike shops</div></div>
                </a>
            </div>
            <div class="section-card">
                <h2>My Profile</h2>
                <div class="profile-info">
                    <div class="profile-row"><span class="profile-label">Name</span><span class="profile-value">{{ auth()->user()->name }}</span></div>
                    <div class="profile-row"><span class="profile-label">Email</span><span class="profile-value">{{ auth()->user()->email }}</span></div>
                    <div class="profile-row"><span class="profile-label">Role</span><span class="role-tag">{{ auth()->user()->role }}</span></div>
                    <div class="profile-row"><span class="profile-label">Member Since</span><span class="profile-value">{{ auth()->user()->created_at->format('M d, Y') }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
BLADE