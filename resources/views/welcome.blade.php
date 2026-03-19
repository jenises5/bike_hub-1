<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BikeHub — Find Your Perfect Ride</title>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --bg: #0d0d0d; --surface: #161616; --card: #1c1c1c;
            --accent: #e8ff00; --accent2: #ff4d00;
            --text: #f0f0f0; --muted: #666; --border: #2a2a2a;
        }
        html { scroll-behavior: smooth; }
        body { background: var(--bg); color: var(--text); font-family: 'DM Sans', sans-serif; overflow-x: hidden; }
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.2rem 2.5rem;
            background: rgba(13,13,13,0.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
        }
        .logo { font-family: 'Bebas Neue', sans-serif; font-size: 1.8rem; letter-spacing: 0.05em; }
        .logo span { color: var(--accent); }
        .nav-links { display: flex; gap: 2rem; align-items: center; }
        .nav-links a { color: var(--muted); text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color 0.2s; }
        .nav-links a:hover { color: var(--text); }
        .nav-cta { background: var(--accent) !important; color: #000 !important; padding: 0.5rem 1.2rem; border-radius: 4px; font-weight: 600 !important; }
        .hero {
            min-height: 100vh; display: grid; grid-template-columns: 1fr 1fr;
            align-items: center; padding: 8rem 2.5rem 4rem; position: relative; overflow: hidden;
        }
        .hero::before {
            content: ''; position: absolute; inset: 0;
            background: radial-gradient(ellipse at 70% 50%, rgba(232,255,0,0.06) 0%, transparent 60%),
                        radial-gradient(ellipse at 20% 80%, rgba(255,77,0,0.05) 0%, transparent 50%);
            pointer-events: none;
        }
        .hero-text { max-width: 580px; animation: fadeUp 0.8s ease both; }
        .hero-tag {
            display: inline-block; background: rgba(232,255,0,0.1); color: var(--accent);
            font-size: 0.75rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase;
            padding: 0.4rem 0.9rem; border-radius: 2px; border: 1px solid rgba(232,255,0,0.2); margin-bottom: 1.5rem;
        }
        h1 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(3.5rem, 6vw, 6rem); line-height: 0.95; margin-bottom: 1.5rem; }
        h1 .line2 { color: var(--accent); display: block; }
        .hero-sub { font-size: 1.05rem; color: #999; line-height: 1.7; max-width: 420px; margin-bottom: 2.5rem; font-weight: 300; }
        .hero-actions { display: flex; gap: 1rem; flex-wrap: wrap; }
        .btn-primary {
            background: var(--accent); color: #000; padding: 0.85rem 2rem; border-radius: 4px;
            font-weight: 600; font-size: 0.95rem; text-decoration: none; transition: all 0.2s; border: 2px solid var(--accent);
        }
        .btn-primary:hover { background: transparent; color: var(--accent); }
        .btn-secondary {
            background: transparent; color: var(--text); padding: 0.85rem 2rem; border-radius: 4px;
            font-weight: 500; font-size: 0.95rem; text-decoration: none; transition: all 0.2s; border: 2px solid var(--border);
        }
        .btn-secondary:hover { border-color: var(--text); }
        .hero-visual { display: flex; justify-content: center; align-items: center; position: relative; animation: fadeUp 0.8s 0.2s ease both; }
        .bike-circle {
            width: 420px; height: 420px; border-radius: 50%; background: var(--surface);
            border: 1px solid var(--border); display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden;
        }
        .float-badge {
            position: absolute; background: var(--card); border: 1px solid var(--border);
            border-radius: 8px; padding: 0.75rem 1rem; font-size: 0.8rem;
        }
        .float-badge.top-right { top: 20px; right: -20px; }
        .float-badge.bottom-left { bottom: 30px; left: -10px; }
        .badge-num { font-family: 'Bebas Neue', sans-serif; font-size: 1.4rem; color: var(--accent); display: block; }
        .badge-label { color: var(--muted); font-size: 0.75rem; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1px; background: var(--border); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border); }
        .stat-item { background: var(--bg); padding: 2rem 2.5rem; text-align: center; }
        .stat-num { font-family: 'Bebas Neue', sans-serif; font-size: 3rem; color: var(--accent); display: block; }
        .stat-label { color: var(--muted); font-size: 0.85rem; margin-top: 0.25rem; }
        .section { padding: 6rem 2.5rem; }
        .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase; color: var(--accent); margin-bottom: 1rem; }
        .section-title { font-family: 'Bebas Neue', sans-serif; font-size: clamp(2.5rem, 4vw, 3.5rem); line-height: 1; margin-bottom: 1rem; }
        .section-sub { color: var(--muted); max-width: 480px; line-height: 1.7; font-weight: 300; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1px; background: var(--border); margin-top: 4rem; border: 1px solid var(--border); }
        .feature-card { background: var(--bg); padding: 2.5rem 2rem; transition: background 0.3s; position: relative; overflow: hidden; }
        .feature-card:hover { background: var(--surface); }
        .feature-card::after { content: ''; position: absolute; bottom: 0; left: 0; right: 0; height: 2px; background: var(--accent); transform: scaleX(0); transition: transform 0.3s; transform-origin: left; }
        .feature-card:hover::after { transform: scaleX(1); }
        .feature-icon { width: 44px; height: 44px; background: rgba(232,255,0,0.08); border: 1px solid rgba(232,255,0,0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; font-size: 1.2rem; }
        .feature-title { font-weight: 600; font-size: 1rem; margin-bottom: 0.75rem; }
        .feature-desc { color: var(--muted); font-size: 0.9rem; line-height: 1.65; font-weight: 300; }
        .how-section { padding: 6rem 2.5rem; background: var(--surface); }
        .steps { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 4rem; }
        .step { position: relative; padding-left: 1.5rem; }
        .step-num { font-family: 'Bebas Neue', sans-serif; font-size: 4rem; color: var(--border); line-height: 1; margin-bottom: 1rem; transition: color 0.3s; }
        .step:hover .step-num { color: rgba(232,255,0,0.2); }
        .step-title { font-weight: 600; margin-bottom: 0.5rem; }
        .step-desc { color: var(--muted); font-size: 0.88rem; line-height: 1.6; font-weight: 300; }
        .step-line { position: absolute; top: 2rem; left: 0; width: 3px; height: 40px; background: var(--accent); border-radius: 2px; }
        .cta-section { padding: 8rem 2.5rem; text-align: center; background: var(--bg); position: relative; overflow: hidden; }
        .cta-section::before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); width: 600px; height: 600px; background: radial-gradient(circle, rgba(232,255,0,0.05) 0%, transparent 70%); pointer-events: none; }
        .cta-section h2 { font-family: 'Bebas Neue', sans-serif; font-size: clamp(3rem, 5vw, 5rem); line-height: 0.95; margin-bottom: 1.5rem; }
        .cta-section h2 span { color: var(--accent); }
        .cta-section p { color: var(--muted); margin-bottom: 2.5rem; font-weight: 300; }
        .cta-btns { display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; }
        footer { padding: 2rem 2.5rem; border-top: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
        footer p { color: var(--muted); font-size: 0.85rem; }
        .footer-links { display: flex; gap: 1.5rem; }
        .footer-links a { color: var(--muted); text-decoration: none; font-size: 0.85rem; transition: color 0.2s; }
        .footer-links a:hover { color: var(--text); }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .hero { grid-template-columns: 1fr; padding: 7rem 1.2rem 3rem; text-align: center; }
            .hero-actions { justify-content: center; }
            .hero-visual { display: none; }
            .stats { grid-template-columns: 1fr; }
            .section, .how-section, .cta-section { padding: 4rem 1.2rem; }
            footer { flex-direction: column; text-align: center; }
        }
    </style>
</head>
<body>
<nav>
    <div class="logo">Bike<span>Hub</span></div>
    <div class="nav-links">
        <a href="#">Browse</a>
        <a href="#">Shops</a>
        <a href="#">Deals</a>
        <a href="#">About</a>
        <a href="{{ route('login') }}">Log in</a>
        <a href="{{ route('register') }}" class="nav-cta">Get Started</a>
    </div>
</nav>
<section class="hero">
    <div class="hero-text">
        <span class="hero-tag">🚲 The Bicycle Marketplace</span>
        <h1>Find Your<span class="line2">Perfect Ride.</span></h1>
        <p class="hero-sub">Browse hundreds of bikes from local shops, get AI-powered recommendations, and order with confidence — all in one place.</p>
        <div class="hero-actions">
            <a href="{{ route('register') }}" class="btn-primary">Browse Bikes</a>
            <a href="#how" class="btn-secondary">How It Works</a>
        </div>
    </div>
    <div class="hero-visual">
        <div class="bike-circle">
            <svg width="280" height="200" viewBox="0 0 280 200" fill="none">
                <circle cx="70" cy="140" r="45" stroke="#e8ff00" stroke-width="3" fill="none" opacity="0.8"/>
                <circle cx="70" cy="140" r="8" fill="#e8ff00" opacity="0.6"/>
                <circle cx="210" cy="140" r="45" stroke="#e8ff00" stroke-width="3" fill="none" opacity="0.8"/>
                <circle cx="210" cy="140" r="8" fill="#e8ff00" opacity="0.6"/>
                <line x1="70" y1="95" x2="70" y2="185" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="25" y1="140" x2="115" y2="140" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="38" y1="108" x2="102" y2="172" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="38" y1="172" x2="102" y2="108" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="210" y1="95" x2="210" y2="185" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="165" y1="140" x2="255" y2="140" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="178" y1="108" x2="242" y2="172" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="178" y1="172" x2="242" y2="108" stroke="#e8ff00" stroke-width="1" opacity="0.3"/>
                <line x1="70" y1="140" x2="140" y2="75" stroke="#f0f0f0" stroke-width="3" stroke-linecap="round"/>
                <line x1="140" y1="75" x2="210" y2="140" stroke="#f0f0f0" stroke-width="3" stroke-linecap="round"/>
                <line x1="140" y1="75" x2="160" y2="140" stroke="#f0f0f0" stroke-width="3" stroke-linecap="round"/>
                <line x1="70" y1="140" x2="160" y2="140" stroke="#f0f0f0" stroke-width="2" stroke-linecap="round"/>
                <line x1="140" y1="75" x2="135" y2="55" stroke="#f0f0f0" stroke-width="3" stroke-linecap="round"/>
                <line x1="125" y1="53" x2="148" y2="53" stroke="#e8ff00" stroke-width="4" stroke-linecap="round"/>
                <line x1="210" y1="140" x2="215" y2="80" stroke="#f0f0f0" stroke-width="3" stroke-linecap="round"/>
                <line x1="208" y1="78" x2="228" y2="72" stroke="#e8ff00" stroke-width="4" stroke-linecap="round"/>
                <circle cx="160" cy="140" r="6" stroke="#ff4d00" stroke-width="2" fill="none"/>
                <line x1="148" y1="140" x2="172" y2="140" stroke="#ff4d00" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </div>
        <div class="float-badge top-right"><span class="badge-num">500+</span><span class="badge-label">Bikes Listed</span></div>
        <div class="float-badge bottom-left"><span class="badge-num">50+</span><span class="badge-label">Local Shops</span></div>
    </div>
</section>
<div class="stats">
    <div class="stat-item"><span class="stat-num">500+</span><span class="stat-label">Bikes Available</span></div>
    <div class="stat-item"><span class="stat-num">50+</span><span class="stat-label">Partner Shops</span></div>
    <div class="stat-item"><span class="stat-num">2K+</span><span class="stat-label">Happy Riders</span></div>
</div>
<section class="section">
    <p class="section-label">Why BikeHub</p>
    <h2 class="section-title">Everything You Need<br>To Ride.</h2>
    <p class="section-sub">From browsing to checkout — the smartest bike marketplace for riders and shop owners alike.</p>
    <div class="features-grid">
        <div class="feature-card"><div class="feature-icon">🤖</div><h3 class="feature-title">AI Recommendations</h3><p class="feature-desc">Get personalized bike suggestions based on your budget, body size, and riding style.</p></div>
        <div class="feature-card"><div class="feature-icon">🏪</div><h3 class="feature-title">Local Shop Marketplace</h3><p class="feature-desc">Browse and compare products from verified bicycle shops near you.</p></div>
        <div class="feature-card"><div class="feature-icon">📦</div><h3 class="feature-title">Order & Track</h3><p class="feature-desc">Place orders online with real-time status updates from Pending to Delivered.</p></div>
        <div class="feature-card"><div class="feature-icon">📊</div><h3 class="feature-title">Shop Analytics</h3><p class="feature-desc">Powerful dashboards for sales, inventory, and customer insights.</p></div>
        <div class="feature-card"><div class="feature-icon">🔔</div><h3 class="feature-title">Smart Notifications</h3><p class="feature-desc">Alerts for orders, low stock, restocking needs, and payment confirmations.</p></div>
        <div class="feature-card"><div class="feature-icon">💳</div><h3 class="feature-title">Secure Payments</h3><p class="feature-desc">Multiple payment options with automatic tax and fee calculation.</p></div>
    </div>
</section>
<section class="how-section" id="how">
    <p class="section-label">How It Works</p>
    <h2 class="section-title">Simple as<br>1, 2, 3.</h2>
    <div class="steps">
        <div class="step"><div class="step-line"></div><div class="step-num">01</div><h4 class="step-title">Browse Bikes</h4><p class="step-desc">Search through hundreds of bikes from local shops. Filter by brand, price, or type.</p></div>
        <div class="step"><div class="step-line"></div><div class="step-num">02</div><h4 class="step-title">Get Recommendations</h4><p class="step-desc">Let our AI suggest the perfect bike for your budget and riding needs.</p></div>
        <div class="step"><div class="step-line"></div><div class="step-num">03</div><h4 class="step-title">Order & Ride</h4><p class="step-desc">Place your order securely and track delivery right from your dashboard.</p></div>
        <div class="step"><div class="step-line"></div><div class="step-num">04</div><h4 class="step-title">Rate & Review</h4><p class="step-desc">Share your experience and help other riders find their perfect bike.</p></div>
    </div>
</section>
<section class="cta-section">
    <h2>Ready To Find<br><span>Your Bike?</span></h2>
    <p>Join thousands of riders already using BikeHub.</p>
    <div class="cta-btns">
        <a href="{{ route('register') }}" class="btn-primary">Create Free Account</a>
        <a href="{{ route('login') }}" class="btn-secondary">Sign In</a>
    </div>
</section>
<footer>
    <div class="logo" style="font-size:1.2rem">Bike<span style="color:var(--accent)">Hub</span></div>
    <p>© 2025 BikeHub. Built for riders, by riders.</p>
    <div class="footer-links"><a href="#">Privacy</a><a href="#">Terms</a><a href="#">Contact</a></div>
</footer>
</body>
</html>