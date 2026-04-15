<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem;transition:color .2s}.nav-links a:hover{color:var(--text)}
        .page-header{padding:2.5rem 2rem 1.5rem}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.5rem}
        .content{display:grid;grid-template-columns:1fr 360px;gap:2rem;padding:0 2rem 4rem;max-width:1100px;margin:0 auto}
        .cart-items{display:flex;flex-direction:column;gap:1rem}
        .cart-item{display:grid;grid-template-columns:80px 1fr auto;gap:1rem;align-items:center;background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.2rem}
        .item-img{width:80px;height:80px;background:var(--surface);border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:2rem;border:1px solid var(--border)}
        .item-name{font-weight:600;margin-bottom:.2rem}
        .item-shop{font-size:.8rem;color:var(--muted);margin-bottom:.5rem}
        .item-price{color:var(--accent);font-family:'Bebas Neue',sans-serif;font-size:1.2rem}
        .item-actions{display:flex;flex-direction:column;align-items:flex-end;gap:.5rem}
        .item-total{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;color:var(--accent)}
        .qty-form{display:flex;align-items:center;gap:.5rem}
        .qty-input{width:50px;background:var(--bg);border:1px solid var(--border);color:var(--text);padding:.3rem;border-radius:4px;text-align:center;font-size:.85rem}
        .btn-qty{background:var(--surface);color:var(--text);border:1px solid var(--border);padding:.3rem .6rem;border-radius:4px;cursor:pointer;font-size:.8rem}
        .btn-remove{background:transparent;color:var(--muted);border:none;font-size:.8rem;cursor:pointer;text-decoration:underline}
        .btn-remove:hover{color:#ef4444}
        .summary{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:1.5rem;height:fit-content;position:sticky;top:80px}
        .summary h2{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;margin-bottom:1.5rem}
        .summary-row{display:flex;justify-content:space-between;margin-bottom:.75rem;font-size:.9rem}
        .summary-row.total{font-weight:700;font-size:1.1rem;padding-top:.75rem;border-top:1px solid var(--border);margin-top:.75rem}
        .summary-row.total span:last-child{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--accent)}
        .form-group{margin-bottom:1rem}
        .form-group label{display:block;font-size:.8rem;color:var(--muted);margin-bottom:.4rem}
        .form-group input,.form-group select{width:100%;background:var(--bg);border:1px solid var(--border);color:var(--text);padding:.6rem .8rem;border-radius:6px;font-size:.85rem;outline:none}
        .form-group input:focus,.form-group select:focus{border-color:var(--accent)}
        .form-group select option{background:var(--card)}
        .btn-order{width:100%;background:var(--accent);color:#000;border:none;padding:1rem;border-radius:8px;font-weight:700;font-size:1rem;cursor:pointer;margin-top:.5rem}
        .btn-order:hover{opacity:.85}
        .empty-state{text-align:center;padding:5rem 2rem;color:var(--muted);grid-column:1/-1}
        .empty-state .icon{font-size:3rem;margin-bottom:1rem}
        .empty-state h3{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--text);margin-bottom:.5rem}
        .btn-browse{display:inline-block;background:var(--accent);color:#000;padding:.75rem 1.5rem;border-radius:6px;text-decoration:none;font-weight:600;margin-top:1rem}
        .alert{padding:.8rem 1rem;border-radius:6px;margin-bottom:1rem;font-size:.9rem}
        .alert-success{background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.3);color:#4ade80}
        @media(max-width:768px){.content{grid-template-columns:1fr}.cart-item{grid-template-columns:60px 1fr}.item-actions{flex-direction:row}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('shops.index') }}">Shops</a>
        <a href="{{ route('orders.index') }}">My Orders</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
    </div>
</nav>
<div class="page-header"><h1>🛒 Your Cart</h1></div>
<div class="content">
    @if(session('success'))
        <div class="alert alert-success" style="grid-column:1/-1">{{ session('success') }}</div>
    @endif
    @if(count($cart) > 0)
        <div class="cart-items">
            @foreach($cart as $id => $item)
            <div class="cart-item">
                <div class="item-img">🚲</div>
                <div>
                    <div class="item-name">{{ $item['name'] }}</div>
                    <div class="item-shop">🏪 {{ $item['shop'] }}</div>
                    <div class="item-price">₱{{ number_format($item['price'], 0) }} each</div>
                </div>
                <div class="item-actions">
                    <div class="item-total">₱{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                    <form action="{{ route('cart.update', $id) }}" method="POST" class="qty-form">
                        @csrf @method('PATCH')
                        <input class="qty-input" type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                        <button class="btn-qty" type="submit">Update</button>
                    </form>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn-remove" type="submit">Remove</button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        <div class="summary">
            <h2>Order Summary</h2>
            <div class="summary-row"><span>Items ({{ count($cart) }})</span><span>₱{{ number_format($total, 0) }}</span></div>
            <div class="summary-row"><span>Delivery</span><span>Free</span></div>
            <div class="summary-row total"><span>Total</span><span>₱{{ number_format($total, 0) }}</span></div>
            <form action="{{ route('orders.store') }}" method="POST" style="margin-top:1.5rem">
                @csrf
                <div class="form-group">
                    <label>Delivery Address</label>
                    <input type="text" name="delivery_address" placeholder="Enter your full address" required>
                </div>
                <div class="form-group">
                    <label>Payment Method</label>
                    <select name="payment_method" required>
                        <option value="cash">Cash on Delivery</option>
                        <option value="gcash">GCash</option>
                        <option value="card">Credit/Debit Card</option>
                    </select>
                </div>
                <button type="submit" class="btn-order">✅ Place Order</button>
            </form>
        </div>
    @else
        <div class="empty-state">
            <div class="icon">🛒</div>
            <h3>Your Cart is Empty</h3>
            <p>Add some bikes to get started!</p>
            <a href="{{ route('products.index') }}" class="btn-browse">Browse Bikes</a>
        </div>
    @endif
</div>
</body>
</html>
