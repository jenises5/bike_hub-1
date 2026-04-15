<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order #{{ $order->id }} — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem}.nav-links a:hover{color:var(--text)}
        .content{max-width:800px;margin:0 auto;padding:2rem}
        .success-banner{background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.3);border-radius:8px;padding:1.5rem;text-align:center;margin-bottom:2rem}
        .success-banner .icon{font-size:2.5rem;margin-bottom:.5rem}
        .success-banner h2{font-family:'Bebas Neue',sans-serif;font-size:1.8rem;color:#4ade80;margin-bottom:.3rem}
        .success-banner p{color:var(--muted);font-size:.9rem}
        .order-card{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem;margin-bottom:1.5rem}
        .order-card h3{font-family:'Bebas Neue',sans-serif;font-size:1.2rem;margin-bottom:1rem;padding-bottom:.75rem;border-bottom:1px solid var(--border)}
        .info-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:1rem}
        .info-item .label{font-size:.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.2rem}
        .info-item .value{font-weight:600}
        .status-badge{display:inline-block;padding:.3rem .8rem;border-radius:4px;font-size:.8rem;font-weight:600;text-transform:uppercase;letter-spacing:.05em}
        .status-pending{background:rgba(251,191,36,.1);color:#fbbf24;border:1px solid rgba(251,191,36,.3)}
        .order-item{display:flex;justify-content:space-between;align-items:center;padding:.75rem 0;border-bottom:1px solid var(--border)}
        .order-item:last-child{border-bottom:none}
        .item-name{font-weight:600;font-size:.9rem}
        .item-qty{font-size:.8rem;color:var(--muted)}
        .item-price{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--accent)}
        .total-row{display:flex;justify-content:space-between;padding-top:1rem;font-weight:700}
        .total-row span:last-child{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--accent)}
        .btn-browse{display:inline-block;background:var(--accent);color:#000;padding:.75rem 1.5rem;border-radius:6px;text-decoration:none;font-weight:600;margin-top:1rem}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('orders.index') }}">My Orders</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </div>
</nav>
<div class="content">
    @if(session('success'))
    <div class="success-banner">
        <div class="icon">🎉</div>
        <h2>Order Placed!</h2>
        <p>{{ session('success') }}</p>
    </div>
    @endif
    <div class="order-card">
        <h3>Order #{{ $order->id }}</h3>
        <div class="info-grid">
            <div class="info-item"><div class="label">Status</div><div class="value"><span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span></div></div>
            <div class="info-item"><div class="label">Shop</div><div class="value">{{ $order->shop->name }}</div></div>
            <div class="info-item"><div class="label">Payment</div><div class="value">{{ ucfirst($order->payment_method) }}</div></div>
            <div class="info-item"><div class="label">Date</div><div class="value">{{ $order->created_at->format('M d, Y') }}</div></div>
            <div class="info-item" style="grid-column:1/-1"><div class="label">Delivery Address</div><div class="value">{{ $order->delivery_address }}</div></div>
        </div>
    </div>
    <div class="order-card">
        <h3>Items Ordered</h3>
        @foreach($order->items as $item)
        <div class="order-item">
            <div>
                <div class="item-name">{{ $item->product->name ?? 'Product' }}</div>
                <div class="item-qty">Qty: {{ $item->quantity }}</div>
            </div>
            <div class="item-price">₱{{ number_format($item->price * $item->quantity, 0) }}</div>
        </div>
        @endforeach
        <div class="total-row">
            <span>Total</span>
            <span>₱{{ number_format($order->total_amount, 0) }}</span>
        </div>
    </div>
    <a href="{{ route('products.index') }}" class="btn-browse">Continue Shopping</a>
</div>
</body>
</html>
