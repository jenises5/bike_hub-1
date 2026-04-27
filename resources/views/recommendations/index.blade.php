<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Recommendations — BikeHub</title>
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
        .hero{padding:4rem 2rem 2rem;text-align:center;position:relative;overflow:hidden}
        .hero::before{content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:600px;height:300px;background:radial-gradient(ellipse,rgba(232,255,0,0.06),transparent 70%);pointer-events:none}
        .hero-tag{display:inline-block;background:rgba(232,255,0,.1);color:var(--accent);font-size:.75rem;font-weight:600;letter-spacing:.12em;text-transform:uppercase;padding:.4rem .9rem;border-radius:2px;border:1px solid rgba(232,255,0,.2);margin-bottom:1rem}
        .hero h1{font-family:'Bebas Neue',sans-serif;font-size:clamp(2.5rem,5vw,4rem);line-height:.95;margin-bottom:1rem}
        .hero h1 span{color:var(--accent)}
        .hero p{color:var(--muted);max-width:500px;margin:0 auto 2rem;font-weight:300;line-height:1.7}
        .form-section{max-width:700px;margin:0 auto;padding:0 2rem 4rem}
        .form-card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:2rem}
        .form-title{font-family:'Bebas Neue',sans-serif;font-size:1.5rem;margin-bottom:1.5rem;display:flex;align-items:center;gap:.5rem}
        .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.5rem}
        .form-group{display:flex;flex-direction:column;gap:.4rem}
        .form-group.full{grid-column:1/-1}
        .form-group label{font-size:.8rem;color:var(--muted);font-weight:500;text-transform:uppercase;letter-spacing:.06em}
        .form-group input,.form-group select{background:var(--surface);border:1px solid var(--border);color:var(--text);padding:.75rem 1rem;border-radius:8px;font-size:.9rem;outline:none;transition:border-color .2s}
        .form-group input:focus,.form-group select:focus{border-color:var(--accent)}
        .form-group select option{background:var(--card)}
        .use-case-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:.75rem;grid-column:1/-1}
        .use-case-btn{background:var(--surface);border:1px solid var(--border);color:var(--muted);padding:.75rem;border-radius:8px;cursor:pointer;text-align:center;transition:all .2s;font-size:.85rem}
        .use-case-btn:hover,.use-case-btn.selected{border-color:var(--accent);color:var(--accent);background:rgba(232,255,0,.05)}
        .use-case-btn .icon{font-size:1.3rem;display:block;margin-bottom:.3rem}
        .btn-recommend{width:100%;background:var(--accent);color:#000;border:none;padding:1rem;border-radius:8px;font-weight:700;font-size:1rem;cursor:pointer;transition:opacity .2s;margin-top:.5rem}
        .btn-recommend:hover{opacity:.85}
        .results-section{max-width:1100px;margin:0 auto;padding:0 2rem 4rem}
        .results-header{text-align:center;margin-bottom:2rem}
        .results-header h2{font-family:'Bebas Neue',sans-serif;font-size:2rem;margin-bottom:.5rem}
        .results-header p{color:var(--muted);font-size:.9rem}
        .results-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem}
        .result-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;transition:all .3s;position:relative}
        .result-card:hover{border-color:var(--accent);transform:translateY(-3px)}
        .result-card.top-pick{border-color:var(--accent)}
        .top-pick-badge{position:absolute;top:1rem;right:1rem;background:var(--accent);color:#000;padding:.25rem .6rem;border-radius:3px;font-size:.7rem;font-weight:700;text-transform:uppercase}
        .score-bar{height:3px;background:var(--border)}
        .score-fill{height:3px;background:var(--accent);transition:width .5s ease}
        .card-img{height:160px;background:var(--surface);display:flex;align-items:center;justify-content:center;font-size:3rem;border-bottom:1px solid var(--border)}
        .card-body{padding:1.2rem}
        .card-category{font-size:.7rem;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:var(--accent);margin-bottom:.3rem}
        .card-name{font-weight:700;font-size:1rem;margin-bottom:.2rem}
        .card-brand{font-size:.8rem;color:var(--muted);margin-bottom:.75rem}
        .card-footer{display:flex;justify-content:space-between;align-items:center;margin-bottom:.75rem}
        .card-price{font-family:'Bebas Neue',sans-serif;font-size:1.4rem;color:var(--accent)}
        .match-score{font-size:.75rem;color:var(--muted)}
        .match-score span{color:var(--text);font-weight:600}
        .card-shop{font-size:.75rem;color:var(--muted);margin-bottom:.75rem}
        .btn-view{display:block;background:rgba(232,255,0,.1);color:var(--accent);border:1px solid rgba(232,255,0,.2);padding:.6rem;border-radius:6px;text-align:center;text-decoration:none;font-size:.85rem;font-weight:600;transition:all .2s}
        .btn-view:hover{background:var(--accent);color:#000}
        .no-results{text-align:center;padding:3rem;color:var(--muted)}
        .no-results .icon{font-size:3rem;margin-bottom:1rem}
        @media(max-width:768px){.form-grid{grid-template-columns:1fr}.use-case-grid{grid-template-columns:repeat(2,1fr)}.results-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
<nav>
    <a href="{{ url('/') }}" class="logo">Bike<span>Hub</span></a>
    <div class="nav-links">
        <a href="{{ route('products.index') }}">Browse</a>
        <a href="{{ route('recommendations.index') }}" style="color:var(--text)">AI Picks</a>
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

<div class="hero">
    <span class="hero-tag">🤖 Powered by AI</span>
    <h1>Find Your<br><span>Perfect Bike.</span></h1>
    <p>Tell us your budget, riding style, and preferences — our AI will match you with the best bikes available.</p>
</div>

<div class="form-section">
    <div class="form-card">
        <div class="form-title">🎯 Get Your Recommendations</div>
        <form method="POST" action="{{ route('recommendations.get') }}" id="recForm">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label>Your Budget (₱)</label>
                    <input type="number" name="budget" placeholder="e.g. 15000" min="1000"
                        value="{{ old('budget', request('budget')) }}" required>
                </div>
                <div class="form-group">
                    <label>Bike Type</label>
                    <select name="category">
                        <option value="any">Any Type</option>
                        <option value="mountain">Mountain Bike</option>
                        <option value="road">Road Bike</option>
                        <option value="electric">Electric Bike</option>
                        <option value="folding">Folding Bike</option>
                        <option value="bmx">BMX</option>
                        <option value="kids">Kids Bike</option>
                    </select>
                </div>
                <div class="form-group full">
                    <label>How will you use it?</label>
                    <div class="use-case-grid">
                        @foreach([
                            ['value'=>'commuting','icon'=>'🏙️','label'=>'Commuting'],
                            ['value'=>'trail riding','icon'=>'🏔️','label'=>'Trail Riding'],
                            ['value'=>'leisure','icon'=>'🌳','label'=>'Leisure'],
                            ['value'=>'racing','icon'=>'🏁','label'=>'Racing'],
                            ['value'=>'off-road','icon'=>'🪨','label'=>'Off-Road'],
                            ['value'=>'city','icon'=>'🛣️','label'=>'City Rides'],
                        ] as $uc)
                        <div class="use-case-btn {{ old('use_case') == $uc['value'] ? 'selected' : '' }}"
                             onclick="selectUseCase('{{ $uc['value'] }}', this)">
                            <span class="icon">{{ $uc['icon'] }}</span>
                            {{ $uc['label'] }}
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="use_case" id="use_case" value="{{ old('use_case') }}" required>
                </div>
            </div>
            <button type="submit" class="btn-recommend">🤖 Get AI Recommendations</button>
        </form>
    </div>
</div>

@isset($recommendations)
<div class="results-section">
    <div class="results-header">
        <h2>🎯 Your Recommendations</h2>
        <p>Found {{ $recommendations->count() }} bikes matching your preferences</p>
    </div>

    @if($recommendations->count() > 0)
    <div class="results-grid">
        @foreach($recommendations as $i => $product)
        <div class="result-card {{ $i === 0 ? 'top-pick' : '' }}">
            @if($i === 0)<div class="top-pick-badge">⭐ Top Pick</div>@endif
            <div class="score-bar">
                <div class="score-fill" style="width:{{ min(100, $product->ai_score) }}%"></div>
            </div>
            <div class="card-img">🚲</div>
            <div class="card-body">
                <div class="card-category">{{ ucfirst($product->category ?? 'Bike') }}</div>
                <div class="card-name">{{ $product->name }}</div>
                <div class="card-brand">by {{ $product->brand ?? 'Unknown' }}</div>
                <div class="card-footer">
                    <span class="card-price">₱{{ number_format($product->price, 0) }}</span>
                    <span class="match-score">Match: <span>{{ $product->ai_score }}%</span></span>
                </div>
                <div class="card-shop">🏪 {{ $product->shop->name }}</div>
                <a href="{{ route('products.show', $product->slug) }}" class="btn-view">View Bike →</a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="no-results">
        <div class="icon">🔍</div>
        <h3 style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;color:var(--text);margin-bottom:.5rem">No Matches Found</h3>
        <p>Try increasing your budget or selecting a different bike type.</p>
    </div>
    @endif
</div>
@endisset

<script>
function selectUseCase(value, el) {
    document.querySelectorAll('.use-case-btn').forEach(b => b.classList.remove('selected'));
    el.classList.add('selected');
    document.getElementById('use_case').value = value;
}
</script>
</body>
</html>
