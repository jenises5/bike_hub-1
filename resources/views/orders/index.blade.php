<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem}.nav-links a:hover{color:var(--text)}
        .page-header{padding:2.5rem 2rem 1.5rem}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.5rem}
        .content{max-width:800px;margin:0 auto;padding:0 2rem 4rem}
        .order-row{display:grid;grid-template-columns:1fr auto;align-items:center;background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.2rem 1.5rem;margin-bottom:1rem;text-decoration:none;color:var(--text);transition:border-color .2s}
        .order-row:hover{border-color:var(--accent)}
        .order-id{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;margin-bottom:.2rem}
        .order-meta{font-size:.8rem;color:var(--muted)}
        .order-right{text-align:right}
        .order-total{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;color:var(--accent);margin-bottom:.3rem}
        .status-badge{display:inline-block;padding:.2rem .6rem;border-radius:3px;font-size:.75rem;font-weight:600;text-transform:uppercase}
        .status-pending{background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.3)}
        .status-delivered{background:rgba(74,222,128,.1);color:#4ade80;border:1px solid rgba(74,222,128,.3)}
        .empty-state{text-align:center;padding:5rem 2rem;color:var(--muted)}
        .empty-state .icon{font-size:3rem;margin-bottom:1rem}
        .empty-state h3{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--text);margin-bottom:.5rem}
        .btn-browse{display:inline-block;background:var(--accent);color:#000;padding:.75rem 1.5rem;border-radius:6px;text-decoration:none;font-weight:600;margin-top:1rem}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('cart.index') }}">Cart</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </div>
</nav>
<div class="page-header"><h1>My Orders</h1></div>
<div class="content">
    @if($orders->count() > 0)
        @foreach($orders as $order)
        <a href="{{ route('orders.show', $order) }}" class="order-row">
            <div>
                <div class="order-id">Order #{{ $order->id }}</div>
                <div class="order-meta">{{ $order->shop->name }} · {{ $order->created_at->format('M d, Y') }}</div>
            </div>
            <div class="order-right">
                <div class="order-total">₱{{ number_format($order->total_amount, 0) }}</div>
                <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
            </div>
        </a>
        @endforeach
    @else
        <div class="empty-state">
            <div class="icon">📦</div>
            <h3>No Orders Yet</h3>
            <p>Start shopping and your orders will appear here.</p>
            <a href="{{ route('products.index') }}" class="btn-browse">Browse Bikes</a>
        </div>
    @endif
</div>
</body>
</html>
