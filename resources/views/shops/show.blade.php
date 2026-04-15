<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $shop->name }} — BikeHub</title>
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
        .shop-hero{background:linear-gradient(135deg,#161616,#1c1c1c);border-bottom:1px solid var(--border);padding:3rem 2rem}
        .shop-hero-inner{max-width:900px;margin:0 auto;display:flex;gap:2rem;align-items:center}
        .shop-avatar{width:90px;height:90px;background:var(--card);border:2px solid var(--border);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:2.5rem;flex-shrink:0}
        .shop-info h1{font-family:'Bebas Neue',sans-serif;font-size:2.2rem;margin-bottom:.3rem}
        .shop-info .city{color:var(--muted);font-size:.9rem;margin-bottom:1rem}
        .shop-stats{display:flex;gap:2rem}
        .shop-stat{text-align:center}
        .shop-stat .num{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--accent);display:block}
        .shop-stat .label{font-size:.75rem;color:var(--muted)}
        .shop-details{display:flex;gap:1.5rem;margin-top:1rem;flex-wrap:wrap}
        .detail-item{font-size:.85rem;color:var(--muted)}
        .detail-item span{color:var(--text)}
        .content{max-width:1100px;margin:0 auto;padding:2rem}
        .section-title{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border)}
        .products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.5rem}
        .product-card{background:var(--card);border:1px solid var(--border);border-radius:8px;overflow:hidden;transition:all .3s;text-decoration:none;color:var(--text);display:block}
        .product-card:hover{border-color:var(--accent);transform:translateY(-2px)}
        .product-img{width:100%;height:150px;background:var(--surface);display:flex;align-items:center;justify-content:center;font-size:2.5rem;border-bottom:1px solid var(--border)}
        .product-body{padding:1rem}
        .product-category{font-size:.7rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--accent);margin-bottom:.3rem}
        .product-name{font-weight:600;font-size:.95rem;margin-bottom:.2rem}
        .product-brand{font-size:.8rem;color:var(--muted);margin-bottom:.75rem}
        .product-footer{display:flex;justify-content:space-between;align-items:center}
        .product-price{font-family:'Bebas Neue',sans-serif;font-size:1.3rem;color:var(--accent)}
        .stock-badge{font-size:.7rem;padding:.2rem .5rem;border-radius:3px;background:rgba(232,255,0,.1);color:var(--accent);border:1px solid rgba(232,255,0,.2)}
        .empty-state{text-align:center;padding:4rem;color:var(--muted)}
        footer{padding:2rem;border-top:1px solid var(--border);text-align:center;color:var(--muted);font-size:.85rem;margin-top:2rem}
        @media(max-width:768px){.shop-hero-inner{flex-direction:column;text-align:center}.shop-stats{justify-content:center}.products-grid{grid-template-columns:repeat(2,1fr)}.content{padding:1rem}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('shops.index') }}">Shops</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
        @endauth
    </div>
</nav>

<div class="shop-hero">
    <div class="shop-hero-inner">
        <div class="shop-avatar">🏪</div>
        <div class="shop-info">
            <h1>{{ $shop->name }}</h1>
            <div class="city">📍 {{ $shop->city }}</div>
            <div class="shop-stats">
                <div class="shop-stat">
                    <span class="num">{{ $shop->products_count }}</span>
                    <span class="label">Products</span>
                </div>
                <div class="shop-stat">
                    <span class="num">{{ $products->total() }}</span>
                    <span class="label">Available</span>
                </div>
            </div>
            <div class="shop-details">
                <div class="detail-item">📍 <span>{{ $shop->address }}</span></div>
                @if($shop->phone)
                <div class="detail-item">📞 <span>{{ $shop->phone }}</span></div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="section-title">Products from {{ $shop->name }}</div>
    @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
            <a href="#" class="product-card">
                <div class="product-img">🚲</div>
                <div class="product-body">
                    <div class="product-category">{{ $product->category ?? 'Bike' }}</div>
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-brand">{{ $product->brand ?? 'Unknown' }}</div>
                    <div class="product-footer">
                        <span class="product-price">₱{{ number_format($product->price, 0) }}</span>
                        <span class="stock-badge">{{ $product->stock }} in stock</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div style="margin-top:2rem">{{ $products->links() }}</div>
    @else
        <div class="empty-state">
            <div style="font-size:3rem;margin-bottom:1rem">🚲</div>
            <h3 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--text);margin-bottom:.5rem">No Products Yet</h3>
            <p>This shop hasn't added any products yet.</p>
        </div>
    @endif
</div>
<footer>© 2025 BikeHub. Built for riders, by riders.</footer>
</body>
</html>
