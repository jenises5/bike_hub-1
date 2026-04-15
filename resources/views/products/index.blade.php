<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Bikes — BikeHub</title>
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
        .page-header{padding:3rem 2rem 1.5rem;border-bottom:1px solid var(--border)}
        .page-header h1{font-family:'Bebas Neue',sans-serif;font-size:2.5rem;margin-bottom:.25rem}
        .page-header p{color:var(--muted);font-size:.9rem}
        .main{display:grid;grid-template-columns:260px 1fr;gap:0;min-height:calc(100vh - 180px)}
        .sidebar{padding:2rem;border-right:1px solid var(--border);position:sticky;top:65px;height:fit-content}
        .filter-title{font-size:.7rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--muted);margin-bottom:1rem}
        .filter-group{margin-bottom:2rem}
        .filter-group label{display:block;font-size:.85rem;color:var(--muted);margin-bottom:.4rem}
        .filter-group input,.filter-group select{width:100%;background:var(--card);border:1px solid var(--border);color:var(--text);padding:.6rem .8rem;border-radius:6px;font-size:.85rem;outline:none}
        .filter-group input:focus,.filter-group select:focus{border-color:var(--accent)}
        .filter-group select option{background:var(--card)}
        .btn-filter{width:100%;background:var(--accent);color:#000;border:none;padding:.7rem;border-radius:6px;font-weight:600;font-size:.9rem;cursor:pointer;transition:opacity .2s}
        .btn-filter:hover{opacity:.85}
        .btn-clear{width:100%;background:transparent;color:var(--muted);border:1px solid var(--border);padding:.6rem;border-radius:6px;font-size:.85rem;cursor:pointer;margin-top:.5rem;transition:all .2s}
        .btn-clear:hover{border-color:var(--text);color:var(--text)}
        .content{padding:2rem}
        .results-bar{display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem}
        .results-count{font-size:.85rem;color:var(--muted)}
        .products-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:1.5rem}
        .product-card{background:var(--card);border:1px solid var(--border);border-radius:8px;overflow:hidden;transition:all .3s;text-decoration:none;color:var(--text);display:block}
        .product-card:hover{border-color:var(--accent);transform:translateY(-2px)}
        .product-img{width:100%;height:180px;background:var(--surface);display:flex;align-items:center;justify-content:center;font-size:3rem;border-bottom:1px solid var(--border)}
        .product-body{padding:1.2rem}
        .product-category{font-size:.7rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--accent);margin-bottom:.4rem}
        .product-name{font-weight:600;font-size:.95rem;margin-bottom:.3rem;line-height:1.3}
        .product-brand{font-size:.8rem;color:var(--muted);margin-bottom:.8rem}
        .product-footer{display:flex;justify-content:space-between;align-items:center}
        .product-price{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--accent)}
        .product-shop{font-size:.75rem;color:var(--muted)}
        .stock-badge{font-size:.7rem;padding:.2rem .5rem;border-radius:3px;background:rgba(232,255,0,.1);color:var(--accent);border:1px solid rgba(232,255,0,.2)}
        .empty-state{text-align:center;padding:5rem 2rem;color:var(--muted)}
        .empty-state .icon{font-size:3rem;margin-bottom:1rem}
        .empty-state h3{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--text);margin-bottom:.5rem}
        .pagination{margin-top:2rem;display:flex;gap:.5rem;justify-content:center}
        .pagination a,.pagination span{padding:.5rem .8rem;border:1px solid var(--border);border-radius:4px;font-size:.85rem;text-decoration:none;color:var(--muted);transition:all .2s}
        .pagination a:hover{border-color:var(--accent);color:var(--accent)}
        .pagination .active{background:var(--accent);color:#000;border-color:var(--accent)}
        @media(max-width:768px){.main{grid-template-columns:1fr}.sidebar{display:none}.products-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr))}.content{padding:1rem}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}" style="color:var(--text)">Browse</a>
        <a href="#">Shops</a>
        @auth
            <a href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a href="{{ route('login') }}">Log in</a>
            <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
        @endauth
    </div>
</nav>

<div class="page-header">
    <h1>Browse Bikes</h1>
    <p>{{ $products->total() }} bikes available from local shops</p>
</div>

<div class="main">
    <!-- Sidebar Filters -->
    <aside class="sidebar">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="filter-title">Filter Bikes</div>

            <div class="filter-group">
                <label>Search</label>
                <input type="text" name="search" placeholder="Brand, name..." value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <label>Category</label>
                <select name="category">
                    <option value="">All Categories</option>
                    <option value="mountain" {{ request('category') == 'mountain' ? 'selected' : '' }}>Mountain Bike</option>
                    <option value="road" {{ request('category') == 'road' ? 'selected' : '' }}>Road Bike</option>
                    <option value="bmx" {{ request('category') == 'bmx' ? 'selected' : '' }}>BMX</option>
                    <option value="electric" {{ request('category') == 'electric' ? 'selected' : '' }}>Electric Bike</option>
                    <option value="folding" {{ request('category') == 'folding' ? 'selected' : '' }}>Folding Bike</option>
                    <option value="kids" {{ request('category') == 'kids' ? 'selected' : '' }}>Kids Bike</option>
                </select>
            </div>

            <div class="filter-group">
                <label>Max Price (₱)</label>
                <input type="number" name="max_price" placeholder="e.g. 10000" value="{{ request('max_price') }}">
            </div>

            <button type="submit" class="btn-filter">Apply Filters</button>
            <a href="{{ route('products.index') }}"><button type="button" class="btn-clear">Clear Filters</button></a>
        </form>
    </aside>

    <!-- Products Grid -->
    <div class="content">
        <div class="results-bar">
            <span class="results-count">Showing {{ $products->count() }} of {{ $products->total() }} bikes</span>
        </div>

        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                <a href="{{ route('products.show', $product->slug) }}" class="product-card">
                    <div class="product-img">🚲</div>
                    <div class="product-body">
                        <div class="product-category">{{ $product->category ?? 'Bike' }}</div>
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-brand">{{ $product->brand ?? 'Unknown Brand' }}</div>
                        <div class="product-footer">
                            <span class="product-price">₱{{ number_format($product->price, 0) }}</span>
                            <span class="stock-badge">{{ $product->stock }} in stock</span>
                        </div>
                        <div class="product-shop" style="margin-top:.5rem">🏪 {{ $product->shop->name ?? 'Unknown Shop' }}</div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="pagination">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <div class="empty-state">
                <div class="icon">🚲</div>
                <h3>No Bikes Found</h3>
                <p>Try adjusting your filters or check back later.</p>
            </div>
        @endif
    </div>
</div>
</body>
</html>
