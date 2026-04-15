<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shops — BikeHub</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *{margin:0;padding:0;box-sizing:border-box}
        :root{--bg:#0d0d0d;--surface:#161616;--card:#1c1c1c;--accent:#e8ff00;--text:#f0f0f0;--muted:#666;--border:#2a2a2a}
        body{background:var(--bg);color:var(--text);font-family:'DM Sans',sans-serif}
        nav{position:sticky;top:0;z-index:100;display:flex;align-items:center;justify-content:space-between;padding:1rem 2rem;background:rgba(13,13,13,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border)}
        .logo{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;text-decoration:none;color:var(--text)}.logo span{color:var(--accent)}
        .nav-links{display:flex;gap:1.5rem;align-items:center}
        .nav-links a{color:var(--muted);text-decoration:none;font-size:.9rem;transition:color .2s}.nav-links a:hover{color:var(--text)}
        .nav-cta{background:var(--accent)!important;color:#000!important;padding:.4rem 1rem;border-radius:4px;font-weight:600!important}
        .page-header{padding:3rem 2rem 2rem}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.5rem;margin-bottom:.25rem}
        .page-header p{color:var(--muted);font-size:.9rem}
        .content{padding:0 2rem 4rem}
        .shops-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:1.5rem}
        .shop-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;text-decoration:none;color:var(--text);display:block;transition:all .3s}
        .shop-card:hover{border-color:var(--accent);transform:translateY(-3px)}
        .shop-banner{height:120px;background:linear-gradient(135deg,#1a1a1a,#2a2a2a);display:flex;align-items:center;justify-content:center;font-size:2.5rem;border-bottom:1px solid var(--border)}
        .shop-body{padding:1.5rem}
        .shop-name{font-weight:700;font-size:1.1rem;margin-bottom:.3rem}
        .shop-city{font-size:.85rem;color:var(--muted);margin-bottom:1rem}
        .shop-meta{display:flex;gap:1rem}
        .shop-stat{font-size:.8rem;color:var(--muted)}
        .shop-stat span{color:var(--accent);font-weight:600}
        .shop-address{font-size:.8rem;color:var(--muted);margin-top:.75rem;padding-top:.75rem;border-top:1px solid var(--border)}
        footer{padding:2rem;border-top:1px solid var(--border);text-align:center;color:var(--muted);font-size:.85rem}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('shops.index') }}" style="color:var(--text)">Shops</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
        @endauth
    </div>
</nav>
<div class="page-header">
    <h1>Bike Shops</h1>
    <p>{{ $shops->count() }} shops available on BikeHub</p>
</div>
<div class="content">
    <div class="shops-grid">
        @foreach($shops as $shop)
        <a href="{{ route('shops.show', $shop->slug) }}" class="shop-card">
            <div class="shop-banner">🏪</div>
            <div class="shop-body">
                <div class="shop-name">{{ $shop->name }}</div>
                <div class="shop-city">📍 {{ $shop->city }}</div>
                <div class="shop-meta">
                    <div class="shop-stat"><span>{{ $shop->products_count }}</span> Products</div>
                    @if($shop->phone)
                    <div class="shop-stat"><span>📞</span> {{ $shop->phone }}</div>
                    @endif
                </div>
                <div class="shop-address">{{ $shop->address }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
<footer>© 2025 BikeHub. Built for riders, by riders.</footer>
</body>
</html>
