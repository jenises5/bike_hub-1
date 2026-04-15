<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — BikeHub</title>
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
        .breadcrumb{padding:1rem 2rem;font-size:.8rem;color:var(--muted)}
        .breadcrumb a{color:var(--muted);text-decoration:none}.breadcrumb a:hover{color:var(--accent)}
        .breadcrumb span{margin:0 .4rem}
        .product-section{display:grid;grid-template-columns:1fr 1fr;gap:3rem;padding:2rem;max-width:1100px;margin:0 auto}
        .product-image{background:var(--surface);border:1px solid var(--border);border-radius:12px;aspect-ratio:1;display:flex;align-items:center;justify-content:center;font-size:8rem}
        .product-info{display:flex;flex-direction:column;gap:1rem}
        .product-category{font-size:.75rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:var(--accent)}
        .product-name{font-family:'Bebas Neue',sans-serif;font-size:2.8rem;line-height:1}
        .product-brand{color:var(--muted);font-size:.9rem}
        .product-price{font-family:'Bebas Neue',sans-serif;font-size:3rem;color:var(--accent);line-height:1}
        .stock-info{display:flex;align-items:center;gap:.5rem;font-size:.85rem}
        .stock-dot{width:8px;height:8px;border-radius:50%;background:#4ade80}
        .stock-dot.low{background:#f59e0b}.stock-dot.out{background:#ef4444}
        .divider{height:1px;background:var(--border)}
        .shop-link{display:flex;align-items:center;gap:.75rem;padding:1rem;background:var(--card);border:1px solid var(--border);border-radius:8px;text-decoration:none;color:var(--text);transition:border-color .2s}
        .shop-link:hover{border-color:var(--accent)}
        .shop-icon{width:40px;height:40px;background:var(--surface);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:1.2rem}
        .shop-details .name{font-weight:600;font-size:.9rem}
        .shop-details .location{font-size:.8rem;color:var(--muted)}
        .qty-section{display:flex;align-items:center;gap:1rem}
        .qty-label{font-size:.85rem;color:var(--muted)}
        .qty-control{display:flex;align-items:center;border:1px solid var(--border);border-radius:6px;overflow:hidden}
        .qty-btn{background:var(--card);color:var(--text);border:none;width:36px;height:36px;font-size:1.1rem;cursor:pointer}
        .qty-btn:hover{background:var(--surface)}
        .qty-input{width:48px;height:36px;background:var(--bg);border:none;border-left:1px solid var(--border);border-right:1px solid var(--border);color:var(--text);text-align:center;font-size:.9rem;outline:none}
        .action-row{display:flex;gap:.75rem}
        .btn-add-cart{flex:1;background:var(--accent);color:#000;border:none;padding:1rem;border-radius:8px;font-weight:700;font-size:1rem;cursor:pointer}
        .btn-add-cart:hover{opacity:.85}
        .btn-wishlist{background:var(--card);color:var(--text);border:1px solid var(--border);padding:1rem 1.2rem;border-radius:8px;font-size:1.1rem;cursor:pointer}
        .btn-wishlist:hover{border-color:var(--accent)}
        .specs-section{padding:2rem;max-width:1100px;margin:0 auto;border-top:1px solid var(--border)}
        .specs-title{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;margin-bottom:1.5rem}
        .specs-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1px;background:var(--border);border:1px solid var(--border);border-radius:8px;overflow:hidden}
        .spec-item{background:var(--bg);padding:1rem 1.2rem}
        .spec-label{font-size:.75rem;color:var(--muted);margin-bottom:.3rem;text-transform:uppercase;letter-spacing:.05em}
        .spec-value{font-weight:600;font-size:.95rem}
        .related-section{padding:2rem;max-width:1100px;margin:0 auto;border-top:1px solid var(--border)}
        .related-title{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;margin-bottom:1.5rem}
        .related-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem}
        .related-card{background:var(--card);border:1px solid var(--border);border-radius:8px;overflow:hidden;text-decoration:none;color:var(--text);display:block;transition:all .3s}
        .related-card:hover{border-color:var(--accent)}
        .related-img{height:120px;background:var(--surface);display:flex;align-items:center;justify-content:center;font-size:2rem;border-bottom:1px solid var(--border)}
        .related-body{padding:.75rem}
        .related-name{font-weight:600;font-size:.85rem;margin-bottom:.3rem}
        .related-price{font-family:'Bebas Neue',sans-serif;font-size:1.1rem;color:var(--accent)}
        footer{padding:2rem;border-top:1px solid var(--border);text-align:center;color:var(--muted);font-size:.85rem;margin-top:2rem}
        @media(max-width:768px){.product-section{grid-template-columns:1fr;padding:1rem}.related-grid{grid-template-columns:repeat(2,1fr)}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('shops.index') }}">Shops</a>
        @auth
            <a href="{{ route('cart.index') }}">🛒 Cart</a>
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
        @endauth
    </div>
</nav>
<div class="breadcrumb">
    <a href="{{ url('/') }}">Home</a><span>›</span>
    <a href="{{ route('products.index') }}">Browse</a><span>›</span>
    {{ $product->name }}
</div>
<div class="product-section">
    <div class="product-image">🚲</div>
    <div class="product-info">
        <div class="product-category">{{ $product->category ?? 'Bike' }}</div>
        <div class="product-name">{{ $product->name }}</div>
        <div class="product-brand">by {{ $product->brand ?? 'Unknown Brand' }}</div>
        <div class="product-price">₱{{ number_format($product->price, 0) }}</div>
        <div class="stock-info">
            @if($product->stock > 5)
                <div class="stock-dot"></div> In Stock — {{ $product->stock }} units available
            @elseif($product->stock > 0)
                <div class="stock-dot low"></div> Low Stock — only {{ $product->stock }} left!
            @else
                <div class="stock-dot out"></div> Out of Stock
            @endif
        </div>
        <div class="divider"></div>
        <a href="{{ route('shops.show', $product->shop->slug) }}" class="shop-link">
            <div class="shop-icon">🏪</div>
            <div class="shop-details">
                <div class="name">{{ $product->shop->name }}</div>
                <div class="location">📍 {{ $product->shop->city }}</div>
            </div>
        </a>
        @if($product->stock > 0)
        <form action="{{ route('cart.add', $product) }}" method="POST">
            @csrf
            <div class="qty-section">
                <span class="qty-label">Quantity:</span>
                <div class="qty-control">
                    <button type="button" class="qty-btn" onclick="changeQty(-1)">−</button>
                    <input class="qty-input" type="number" id="qty" name="quantity" value="1" min="1" max="{{ $product->stock }}">
                    <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                </div>
            </div>
            <div class="action-row" style="margin-top:.5rem">
                <button type="submit" class="btn-add-cart">🛒 Add to Cart</button>
                <button type="button" class="btn-wishlist">♡</button>
            </div>
        </form>
        @else
        <button class="btn-add-cart" disabled style="opacity:.4;cursor:not-allowed">Out of Stock</button>
        @endif
    </div>
</div>
<div class="specs-section">
    <div class="specs-title">Product Details</div>
    <div class="specs-grid">
        <div class="spec-item"><div class="spec-label">Brand</div><div class="spec-value">{{ $product->brand ?? '—' }}</div></div>
        <div class="spec-item"><div class="spec-label">Category</div><div class="spec-value">{{ ucfirst($product->category ?? '—') }}</div></div>
        <div class="spec-item"><div class="spec-label">Stock</div><div class="spec-value">{{ $product->stock }} units</div></div>
        <div class="spec-item"><div class="spec-label">Shop</div><div class="spec-value">{{ $product->shop->name }}</div></div>
        <div class="spec-item"><div class="spec-label">Location</div><div class="spec-value">{{ $product->shop->city }}</div></div>
        <div class="spec-item"><div class="spec-label">Status</div><div class="spec-value" style="color:var(--accent)">{{ $product->is_available ? 'Available' : 'Unavailable' }}</div></div>
    </div>
</div>
@if($related->count() > 0)
<div class="related-section">
    <div class="related-title">More {{ ucfirst($product->category ?? 'Bikes') }}</div>
    <div class="related-grid">
        @foreach($related as $item)
        <a href="{{ route('products.show', $item->slug) }}" class="related-card">
            <div class="related-img">🚲</div>
            <div class="related-body">
                <div class="related-name">{{ $item->name }}</div>
                <div class="related-price">₱{{ number_format($item->price, 0) }}</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endif
<footer>© 2025 BikeHub. Built for riders, by riders.</footer>
<script>
function changeQty(delta){
    const input=document.getElementById('qty');
    const max=parseInt(input.max);
    input.value=Math.min(Math.max(1,parseInt(input.value)+delta),max);
}
</script>
</body>
</html>
