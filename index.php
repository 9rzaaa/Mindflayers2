<?php
// MindFlayer Coffee — index_bad.php
$shop_name = "Mindflayer";
$tagline = "Brewed with intention. Served with soul.";
$year = date("Y");

$products = [
    ["name" => "Spanish Latte",    "desc" => "Condensed milk sweetness meets bold espresso, silky and rich.", "price" => "₱180", "badge" => "Bestseller",  "emoji" => "☕", "color" => "#6F4C3E", "light" => "#E8D8B0"],
    ["name" => "Matcha Latte",     "desc" => "Ceremonial-grade matcha whisked with oat milk, earthy and calm.", "price" => "₱195", "badge" => "Fan Fave",    "emoji" => "🍵", "color" => "#7A8C5E", "light" => "#E2EBCF"],
    ["name" => "Ube Latte",        "desc" => "Velvety purple yam swirled into steamed milk, sweet and dreamy.", "price" => "₱195", "badge" => "Local Pride", "emoji" => "💜", "color" => "#7B5EA7", "light" => "#EAE0F5"],
    ["name" => "Iced Sea Salt",    "desc" => "Cold brew with a whisper of sea salt cream floating on top.",   "price" => "₱170", "badge" => "Refreshing",  "emoji" => "🧊", "color" => "#4A7C8C", "light" => "#D0EAF0"],
    ["name" => "Caramel Macchiato","desc" => "Layers of vanilla, espresso, and golden caramel drizzle.",     "price" => "₱185", "badge" => "Classic",     "emoji" => "🍯", "color" => "#B87333", "light" => "#F5E6CC"],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?= $shop_name ?> Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha:    #6F4C3E;
            --sand:     #C2B280;
            --cream:    #E8D8B0;
            --linen:    #F5F5F0;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --transition: 0.35s ease;
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-body);
            background: var(--linen);
            color: #2A1E1E;
            overflow-x: hidden;
        }
        h1, h2, h3, h4 { font-family: var(--font-display); }

        /* ── NAVBAR ──────────────────────────────────────────────
           Tip 37 VIOLATED (subtly):
           - Logo is center-aligned instead of left
           - "Login" CTA sits between nav links, not at the far right
           - Nav item order is shuffled (Story, Locations, Menu, Profile)
        ─────────────────────────────────────────────────────── */
        .bad-navbar {
            background: var(--espresso);
            padding: 0.85rem 2rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center; /* BAD: brand not left-anchored */
            gap: 0.5rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(194,178,128,0.2);
        }

        /* BAD: Brand centered instead of left — loses first-position recall */
        .bad-brand {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--cream);
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        .bad-brand .dot { color: var(--sand); }

        .bad-nav-links {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.25rem;
            padding: 0; margin: 0;
            align-items: center;
        }
        .bad-nav-links a {
            font-size: 0.88rem;
            color: rgba(232,216,176,0.75);
            text-decoration: none;
            padding: 0.25rem 0.9rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: color 0.25s ease;
        }
        .bad-nav-links a:hover { color: var(--cream); }

        /* BAD: CTA is buried between nav links, not rightmost — weak recall position */
        .bad-nav-cta {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--espresso);
            background: var(--sand);
            padding: 0.5rem 1.3rem;
            border-radius: 2px;
            text-decoration: none;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            transition: background 0.25s ease;
        }
        .bad-nav-cta:hover { background: var(--cream); }

        /* ── HERO ────────────────────────────────────────────────
           Tip 49 VIOLATED (Gutenberg — subtly):
           - Visual cup is on the LEFT, headline on the RIGHT (inverted Z-start)
           - CTA buttons are placed ABOVE the headline
           - Subtitle appears before the main title
        ─────────────────────────────────────────────────────── */
        .bad-hero {
            background: var(--espresso);
            min-height: 80vh;
            display: flex;
            align-items: center;
            overflow: hidden;
            position: relative;
            padding: 3rem 2rem;
        }

        .bad-hero-inner {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 2rem;
            width: 100%;
        }

        /* BAD: Cup on the LEFT — Z-pattern expects headline at top-left first */
        .bad-hero-visual {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
        }
        .bad-hero-cup {
            width: 260px; height: 260px;
            border-radius: 50%;
            background: radial-gradient(ellipse at 35% 35%, var(--mocha), var(--espresso) 70%);
            display: flex; align-items: center; justify-content: center;
            font-size: 7rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.4);
        }

        /* BAD: All text content on the RIGHT — opposite of natural Z-start */
        .bad-hero-content {
            flex: 1;
            min-width: 260px;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        /* BAD: CTA buttons appear ABOVE the headline — user clicks before reading */
        .bad-cta-group {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            order: -1; /* BAD: floated to top of content column */
        }

        .bad-btn-primary {
            background: var(--sand);
            color: var(--espresso);
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            transition: background 0.25s ease;
        }
        .bad-btn-primary:hover { background: var(--cream); }

        .bad-btn-ghost {
            background: transparent;
            color: var(--cream);
            font-size: 0.88rem;
            font-weight: 400;
            letter-spacing: 0.06em;
            padding: 0.8rem 1.6rem;
            border: 1px solid rgba(232,216,176,0.35);
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: border-color 0.25s ease, color 0.25s ease;
        }
        .bad-btn-ghost:hover { border-color: var(--sand); color: var(--sand); }

        /* BAD: Subtitle placed BEFORE the main title — wrong reading hierarchy */
        .bad-hero-subtitle {
            font-size: 0.95rem;
            font-weight: 300;
            color: rgba(245,245,240,0.6);
            line-height: 1.65;
            max-width: 400px;
            /* BAD: appears before title in flex column order via default DOM flow */
        }

        /* BAD: Eyebrow appears after subtitle */
        .bad-hero-eyebrow {
            font-size: 0.75rem;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--sand);
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .bad-hero-eyebrow::before {
            content: ''; display: inline-block;
            width: 28px; height: 1px; background: var(--sand);
        }

        .bad-hero-title {
            font-size: clamp(2.2rem, 5vw, 4.5rem);
            font-weight: 900;
            color: var(--linen);
            line-height: 1.05;
            letter-spacing: -0.03em;
            margin: 0;
        }
        .bad-hero-title em { font-style: italic; color: var(--sand); }

        /* ── PRODUCTS ─────────────────────────────────────────── */
        .bad-products {
            background: var(--mocha);
            padding: 2rem 2rem 1.5rem; /* BAD: bottom padding less than top */
        }

        .bad-products-head {
            font-size: 0.72rem;
            color: var(--sand);
            margin-bottom: 0.3rem;
            text-transform: uppercase;
            letter-spacing: 0.2em;
        }
        .bad-products h2 {
            font-size: clamp(1.6rem, 3vw, 2.4rem);
            font-weight: 700;
            color: var(--linen);
            margin-bottom: 1.25rem;
            letter-spacing: -0.02em;
        }

        /* BAD: 4 products in a row then 1 alone — uneven visual balance */
        .bad-products-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem; /* BAD: tight gap, cards feel cramped */
        }

        .bad-product-card {
            background: rgba(245,245,240,0.05);
            border: 1px solid rgba(194,178,128,0.15);
            border-radius: 4px;
            padding: 1.25rem 1rem; /* BAD: unequal padding */
            flex: 1 1 160px;
            transition: background 0.25s ease;
            cursor: pointer;
        }
        .bad-product-card:hover { background: rgba(245,245,240,0.09); }

        .bad-product-emoji { font-size: 2rem; display: block; margin-bottom: 0.4rem; }
        .bad-product-badge {
            font-size: 0.62rem;
            color: var(--sand);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            display: block;
            margin-bottom: 0.3rem;
        }
        .bad-product-name {
            font-family: var(--font-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--linen);
            margin-bottom: 0.3rem;
        }
        .bad-product-desc {
            font-size: 0.82rem;
            color: rgba(245,245,240,0.5);
            line-height: 1.55;
            margin-bottom: 0.75rem;
        }

        .bad-product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* BAD: no top border — price floats without visual anchor */
        }
        .bad-product-price {
            font-family: var(--font-display);
            font-size: 1.2rem;
            color: var(--sand);
            font-weight: 700;
        }
        .bad-btn-add {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: rgba(194,178,128,0.15);
            border: 1px solid rgba(194,178,128,0.25);
            color: var(--sand);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        .bad-btn-add:hover { background: var(--sand); color: var(--espresso); }

        /* ── EXPERIENCE ───────────────────────────────────────── */
        /* BAD: Inconsistent padding vs other sections — looks disconnected */
        .bad-experience {
            background: var(--linen);
            padding: 1.5rem 2rem 3rem; /* BAD: top padding much less than bottom */
        }
        .bad-experience h2 {
            font-size: clamp(1.5rem, 3vw, 2.4rem);
            font-weight: 700;
            color: var(--espresso);
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
        }
        .bad-experience h2 em { color: var(--mocha); font-style: italic; }

        /* BAD: Pillars in a 2+2 split then not quite balanced */
        .bad-pillars-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .bad-pillar-card {
            flex: 1 1 200px;
            padding: 1.25rem 1rem;
            background: #fff;
            border: 1px solid var(--cream);
            border-radius: 4px;
            text-align: center;
        }
        .bad-pillar-card i {
            font-size: 1.3rem;
            color: var(--mocha);
            display: block;
            margin-bottom: 0.5rem;
        }
        .bad-pillar-title {
            font-family: var(--font-display);
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--espresso);
            margin-bottom: 0.3rem;
        }
        .bad-pillar-text {
            font-size: 0.82rem;
            color: #9C8878;
            line-height: 1.6;
        }

        /* ── QUOTE ────────────────────────────────────────────── */
        /* BAD: Quote left-aligned instead of centered — reads like body copy */
        .bad-quote {
            background: var(--mocha);
            padding: 2.5rem 2rem;
            text-align: left;
        }
        .bad-quote p {
            font-family: var(--font-display);
            font-size: clamp(1.2rem, 2.5vw, 1.8rem);
            font-style: italic;
            color: var(--linen);
            margin: 0 0 0.5rem;
            line-height: 1.5;
            max-width: 700px;
        }
        .bad-quote cite {
            font-size: 0.78rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--sand);
        }

        /* ── FOOTER CTA ──────────────────────────────────────────
           Tip 49 VIOLATED (Gutenberg — subtly):
           - Primary "Order Now" CTA sits at the TOP-LEFT of the section
           - Heading and supporting copy appear after the CTA
           - Bottom-right is occupied by social icons instead of the CTA
        ─────────────────────────────────────────────────────── */
        .bad-footer-cta {
            background: var(--espresso);
            padding: 3.5rem 2rem 2.5rem;
        }

        .bad-footer-cta-inner {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: flex-start;
        }

        /* BAD: CTA block is top-left, renders before headline is read */
        .bad-cta-block {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
            order: -1; /* BAD: first visually, before any heading or context */
        }

        .bad-main-cta {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 1rem 2.5rem;
            border: none;
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .bad-main-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(194,178,128,0.35);
            color: var(--espresso);
        }

        .bad-cta-note {
            font-size: 0.75rem;
            color: rgba(245,245,240,0.3);
            letter-spacing: 0.06em;
        }

        /* BAD: Heading/copy column appears after CTA in flex order */
        .bad-footer-text-block {
            flex: 1;
            min-width: 260px;
        }
        .bad-footer-heading {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 4vw, 3rem);
            font-weight: 900;
            color: var(--linen);
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 0.75rem;
        }
        .bad-footer-heading em { color: var(--sand); font-style: italic; }
        .bad-footer-sub {
            font-size: 0.95rem;
            color: rgba(245,245,240,0.5);
            line-height: 1.65;
            max-width: 380px;
            margin-bottom: 1rem;
        }
        .bad-footer-meta {
            font-size: 0.82rem;
            color: rgba(245,245,240,0.4);
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .bad-footer-meta span { display: flex; align-items: center; gap: 0.35rem; }
        .bad-footer-meta i { color: var(--sand); }

        /* BAD: Social icons placed at bottom-right — the Gutenberg terminal action zone,
                wasted on decorative icons instead of the primary CTA */
        .bad-social {
            display: flex;
            gap: 0.5rem;
            align-items: flex-end;
            align-self: flex-end;
            margin-left: auto;
        }
        .bad-social a {
            width: 36px; height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(194,178,128,0.2);
            display: inline-flex; align-items: center; justify-content: center;
            color: rgba(245,245,240,0.45);
            font-size: 0.85rem;
            text-decoration: none;
            transition: border-color 0.25s ease, color 0.25s ease;
        }
        .bad-social a:hover { border-color: var(--sand); color: var(--sand); }

        /* ── FOOTER BAR ───────────────────────────────────────── */
        .bad-footer-bar {
            background: var(--espresso);
            border-top: 1px solid rgba(194,178,128,0.12);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
        }
        .bad-footer-bar-text {
            font-size: 0.78rem;
            color: rgba(245,245,240,0.35);
            letter-spacing: 0.04em;
        }
        .bad-footer-bar-links a {
            color: rgba(245,245,240,0.4);
            font-size: 0.78rem;
            text-decoration: none;
            margin-left: 1.25rem;
            transition: color 0.2s ease;
        }
        .bad-footer-bar-links a:hover { color: var(--sand); }
    </style>
</head>
<body>

<!-- ═══════════════════════════════════════════
     BAD NAVBAR
     Tip 37 VIOLATED:
     · Brand is centered — not left-anchored
     · "Login" CTA is buried between nav links, not rightmost
     · Nav items in shuffled order
═══════════════════════════════════════════ -->
<div class="bad-navbar">

    <!-- BAD: Brand centered — loses left-anchor recall -->
    <a href="#" class="bad-brand">☕ <?= $shop_name ?><span class="dot">.</span></a>

    <!-- BAD: Nav order shuffled — Our Story first, CTA buried mid-list -->
    <ul class="bad-nav-links">
        <li><a href="pages/AboutPage/about.php">Our Story</a></li>
        <li><a href="#contact">Locations</a></li>
        <!-- BAD: CTA buried mid-list — loses rightmost high-recall position -->
        <li><a href="pages/SignupPage/login.php" class="bad-nav-cta">Login</a></li>
        <li><a href="pages/ProductListPage/products.php">Menu</a></li>
        <li><a href="pages/ProfilePage/profile.php">Profile</a></li>
    </ul>

</div>


<!-- ═══════════════════════════════════════════
     BAD HERO
     Tip 49 VIOLATED (Gutenberg):
     · Cup visual is LEFT, headline is RIGHT (inverted Z-start)
     · CTA buttons appear ABOVE the headline
     · Subtitle placed before the main title
═══════════════════════════════════════════ -->
<div class="bad-hero">
    <div class="bad-hero-inner">

        <!-- BAD: Cup on the LEFT — Z-pattern expects headline at top-left first -->
        <div class="bad-hero-visual">
            <div class="bad-hero-cup">☕</div>
        </div>

        <!-- BAD: All text content on the RIGHT — opposite of natural Z-start -->
        <div class="bad-hero-content">

            <!-- BAD: CTAs appear ABOVE headline — user clicks before reading context -->
            <div class="bad-cta-group">
                <a href="pages/ProductListPage/products.php" class="bad-btn-primary">
                    <i class="bi bi-grid-fill"></i> Explore Menu
                </a>
                <a href="pages/AboutPage/about.php" class="bad-btn-ghost">
                    <i class="bi bi-play-circle"></i> Our Story
                </a>
            </div>

            <!-- BAD: Subtitle placed before the title — wrong reading hierarchy -->
            <p class="bad-hero-subtitle">
                <?= $tagline ?> Hand-crafted drinks made with ethically sourced beans and real ingredients.
            </p>

            <h1 class="bad-hero-title">
                Every sip,<br>
                <em>a moment</em><br>
                worth savoring.
            </h1>

            <!-- BAD: Eyebrow appears last — context comes after the headline -->
            <p class="bad-hero-eyebrow">Specialty Coffee · Makati City</p>

        </div>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     BAD PRODUCTS
     · Tight gap — cards feel cramped
     · No top border on price area
     · Inconsistent section padding vs others
═══════════════════════════════════════════ -->
<div class="bad-products">
    <p class="bad-products-head">Signature Drinks</p>
    <h2>Our most-loved crafted sips.</h2>

    <div class="bad-products-grid">
        <?php foreach ($products as $product): ?>
        <div class="bad-product-card">
            <span class="bad-product-emoji"><?= $product['emoji'] ?></span>
            <span class="bad-product-badge"><?= $product['badge'] ?></span>
            <div class="bad-product-name"><?= $product['name'] ?></div>
            <p class="bad-product-desc"><?= $product['desc'] ?></p>
            <div class="bad-product-footer">
                <span class="bad-product-price"><?= $product['price'] ?></span>
                <button class="bad-btn-add"><i class="bi bi-plus-lg"></i></button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- ═══════════════════════════════════════════
     BAD EXPERIENCE
     · Very little top padding — abuts products section
     · Pillar cards present but in uneven layout
═══════════════════════════════════════════ -->
<div class="bad-experience">
    <h2 class="text-center mb-4">The <em>details</em> make the difference.</h2>

    <div class="bad-pillars-grid">
        <?php
        $pillars = [
            ['bi bi-cup-hot', 'Single Origin Beans',        'Every batch is traceable to the farm it came from.'],
            ['bi bi-droplet',  'Cold Brew Crafted In-House', '24-hour steep, zero compromise. Always fresh.'],
            ['bi bi-heart',    'Made to Order',              'No syrups sitting around — everything is freshly blended.'],
            ['bi bi-tree',     'Eco Packaging',              'Compostable cups, paper straws, no plastic ever.'],
        ];
        foreach ($pillars as $pillar): ?>
        <div class="bad-pillar-card">
            <i class="<?= $pillar[0] ?>"></i>
            <div class="bad-pillar-title"><?= $pillar[1] ?></div>
            <p class="bad-pillar-text"><?= $pillar[2] ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>


<!-- BAD QUOTE — left-aligned, reads like body copy instead of a featured callout -->
<div class="bad-quote">
    <p>"The ube latte alone is worth crossing the city for."</p>
    <cite>— Lifestyle Manila, Best Coffee Spots 2024</cite>
</div>


<!-- ═══════════════════════════════════════════
     BAD FOOTER CTA
     Tip 49 VIOLATED (Gutenberg):
     · "Order Now" CTA is top-left — rendered before any context
     · Heading and copy appear after the button
     · Bottom-right occupied by social icons instead of the primary CTA
═══════════════════════════════════════════ -->
<div class="bad-footer-cta">
    <div class="bad-footer-cta-inner">

        <!-- BAD: CTA block renders first — top-left, wrong Gutenberg terminal zone -->
        <div class="bad-cta-block">
            <a href="pages/SignupPage/signup.php" class="bad-main-cta">
                Order Now <i class="bi bi-arrow-right-circle"></i>
            </a>
            <span class="bad-cta-note">Ready in 5 minutes · Free delivery over ₱500</span>
        </div>

        <!-- BAD: Heading and copy come after the CTA in reading flow -->
        <div class="bad-footer-text-block">
            <h2 class="bad-footer-heading">
                Ready for your<br>next <em>favourite</em> cup?
            </h2>
            <p class="bad-footer-sub">
                Walk in, call ahead, or order online. We'll have it ready warm and waiting.
            </p>
            <div class="bad-footer-meta">
                <span><i class="bi bi-geo-alt"></i> Salcedo Village · BGC · Poblacion</span>
                <span><i class="bi bi-clock"></i> Open 7:00 AM – 10:00 PM Daily</span>
            </div>
        </div>

        <!-- BAD: Social icons at bottom-right — Gutenberg terminal zone
                  wasted on decorative icons instead of the primary CTA -->
        <div class="bad-social">
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-tiktok"></i></a>
        </div>

    </div>
</div>


<!-- FOOTER BAR -->
<div class="bad-footer-bar">
    <p class="bad-footer-bar-text mb-0">&copy; <?= $year ?> <?= $shop_name ?> Coffee. All rights reserved.</p>
    <div class="bad-footer-bar-links">
        <a href="#">Privacy</a>
        <a href="#">Terms</a>
        <a href="#contact">Contact</a>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.bad-btn-add').forEach(btn => {
        btn.addEventListener('click', function() {
            this.innerHTML = '<i class="bi bi-check-lg"></i>';
            this.style.background = 'var(--sand)';
            this.style.color = 'var(--espresso)';
            setTimeout(() => {
                this.innerHTML = '<i class="bi bi-plus-lg"></i>';
                this.style.background = '';
                this.style.color = '';
            }, 1800);
        });
    });
</script>

</body>
</html>