<?php
// pages/productpage/products.php

$products = [
    [
        "id"       => 1,
        "name"     => "Spanish Latte",
        "tagline"  => "Sweet, bold, and impossibly silky.",
        "price"    => 180,
        "category" => "Espresso",
        "badge"    => "Bestseller",
        "image"    => "assets/images/spanish-latte.jpg",
        "desc"     => "A rich double shot of espresso balanced with sweetened condensed milk and whole milk, creating a caramel-sweet, velvety cup that keeps you coming back.",
        "specs" => [
            ["icon" => "bi-thermometer-half", "label" => "Temperature", "value" => "Hot / Iced"],
            ["icon" => "bi-cup-straw",         "label" => "Base",        "value" => "Espresso"],
            ["icon" => "bi-droplet-half",      "label" => "Milk",        "value" => "Condensed + Whole"],
            ["icon" => "bi-lightning-charge",  "label" => "Caffeine",    "value" => "Medium–High"],
        ],
        "tags"     => ["Sweet", "Creamy", "Bold"],
        "calories" => "~240 kcal",
        "volume"   => "12 oz",
        "rating"   => 4.9,
        "reviews"  => 312,
        "emoji"    => "☕",
    ],
    [
        "id"       => 2,
        "name"     => "Matcha Latte",
        "tagline"  => "Earthy, calm, and beautifully green.",
        "price"    => 195,
        "category" => "Non-Espresso",
        "badge"    => "Fan Fave",
        "image"    => "assets/images/matcha-latte.jpg",
        "desc"     => "Ceremonial-grade Japanese matcha whisked smooth and layered over steamed oat milk. Subtle sweetness, grassy depth, and a calm clean finish.",
        "specs" => [
            ["icon" => "bi-thermometer-half", "label" => "Temperature", "value" => "Hot / Iced"],
            ["icon" => "bi-cup-straw",         "label" => "Base",        "value" => "Ceremonial Matcha"],
            ["icon" => "bi-droplet-half",      "label" => "Milk",        "value" => "Oat Milk"],
            ["icon" => "bi-lightning-charge",  "label" => "Caffeine",    "value" => "Low–Medium"],
        ],
        "tags"     => ["Earthy", "Smooth", "Calming"],
        "calories" => "~190 kcal",
        "volume"   => "12 oz",
        "rating"   => 4.8,
        "reviews"  => 204,
        "emoji"    => "🍵",
    ],
    [
        "id"       => 3,
        "name"     => "Ube Latte",
        "tagline"  => "Dreamy purple magic in a cup.",
        "price"    => 195,
        "category" => "Non-Espresso",
        "badge"    => "Local Pride",
        "image"    => "assets/images/ube-latte.jpg",
        "desc"     => "Real ube halaya blended into steamed milk creates this gorgeous violet drink — gently sweet, subtly nutty, and unmistakably Filipino.",
        "specs" => [
            ["icon" => "bi-thermometer-half", "label" => "Temperature", "value" => "Hot / Iced"],
            ["icon" => "bi-cup-straw",         "label" => "Base",        "value" => "Ube Halaya"],
            ["icon" => "bi-droplet-half",      "label" => "Milk",        "value" => "Whole / Oat"],
            ["icon" => "bi-lightning-charge",  "label" => "Caffeine",    "value" => "Caffeine-Free"],
        ],
        "tags"     => ["Sweet", "Nutty", "Unique"],
        "calories" => "~210 kcal",
        "volume"   => "12 oz",
        "rating"   => 4.9,
        "reviews"  => 278,
        "emoji"    => "💜",
    ],
    [
        "id"       => 4,
        "name"     => "Iced Sea Salt",
        "tagline"  => "Cold, bold, and perfectly balanced.",
        "price"    => 170,
        "category" => "Cold Brew",
        "badge"    => "Refreshing",
        "image"    => "assets/images/iced-seasalt.jpg",
        "desc"     => "Our house cold brew — steeped 24 hours — topped with a whisper of lightly salted cream that slowly folds into the coffee as you sip.",
        "specs" => [
            ["icon" => "bi-thermometer-half", "label" => "Temperature", "value" => "Iced Only"],
            ["icon" => "bi-cup-straw",         "label" => "Base",        "value" => "24hr Cold Brew"],
            ["icon" => "bi-droplet-half",      "label" => "Topping",     "value" => "Sea Salt Cream"],
            ["icon" => "bi-lightning-charge",  "label" => "Caffeine",    "value" => "High"],
        ],
        "tags"     => ["Bold", "Salty-Sweet", "Refreshing"],
        "calories" => "~160 kcal",
        "volume"   => "16 oz",
        "rating"   => 4.7,
        "reviews"  => 189,
        "emoji"    => "🧊",
    ],
    [
        "id"       => 5,
        "name"     => "Caramel Macchiato",
        "tagline"  => "Layers of warmth in every sip.",
        "price"    => 185,
        "category" => "Espresso",
        "badge"    => "Classic",
        "image"    => "assets/images/caramel-macchiato.jpg",
        "desc"     => "Vanilla-infused milk, a bold espresso mark, and a generous drizzle of house caramel. Layered to look as good as it tastes.",
        "specs" => [
            ["icon" => "bi-thermometer-half", "label" => "Temperature", "value" => "Hot / Iced"],
            ["icon" => "bi-cup-straw",         "label" => "Base",        "value" => "Espresso"],
            ["icon" => "bi-droplet-half",      "label" => "Milk",        "value" => "Vanilla Whole Milk"],
            ["icon" => "bi-lightning-charge",  "label" => "Caffeine",    "value" => "Medium–High"],
        ],
        "tags"     => ["Sweet", "Layered", "Warm"],
        "calories" => "~250 kcal",
        "volume"   => "12 oz",
        "rating"   => 4.8,
        "reviews"  => 241,
        "emoji"    => "🍯",
    ],
];

$categories   = ["All", "Espresso", "Non-Espresso", "Cold Brew"];
$active_cat   = isset($_GET['cat']) ? $_GET['cat'] : 'All';
$filtered     = $active_cat === 'All'
    ? $products
    : array_values(array_filter($products, fn($p) => $p['category'] === $active_cat));

$cat_counts = [];
foreach ($products as $p) {
    $cat_counts[$p['category']] = ($cat_counts[$p['category']] ?? 0) + 1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Our Menu — Mindflayer Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

    <style>
        /* ═══════════════════════════════
           VARIABLES
        ═══════════════════════════════ */
        :root {
            --espresso:   #3B2A2A;
            --mocha:      #6F4C3E;
            --sand:       #C2B280;
            --cream:      #E8D8B0;
            --linen:      #F5F5F0;
            --text-dark:  #2A1E1E;
            --text-mid:   #6F4C3E;
            --text-muted: #9C8878;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans:  'DM Sans', sans-serif;
            --ease:       cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            font-family: var(--font-sans);
            background: var(--linen);
            color: var(--text-dark);
            overflow-x: hidden;
        }
        h1,h2,h3,h4 { font-family: var(--font-serif); }

        /* Noise texture */
        body::before {
            content: ''; position: fixed; inset: 0; pointer-events: none; z-index: 9999; opacity: 0.4;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }

        /* ═══════════════════════════════
           NAVBAR
        ═══════════════════════════════ */
        .navbar {
            background: var(--espresso);
            padding: 1rem 2.5rem;
            border-bottom: 1px solid rgba(194,178,128,0.15);
            position: sticky; top: 0; z-index: 1000;
        }
        .navbar-brand {
            font-family: var(--font-serif); font-size: 1.4rem; font-weight: 900;
            color: var(--cream) !important; display: flex; align-items: center; gap: 0.4rem;
        }
        .navbar-brand .dot { color: var(--sand); }
        .nav-back {
            font-size: 0.78rem; letter-spacing: 0.1em; text-transform: uppercase;
            color: rgba(232,216,176,0.6) !important; display: flex; align-items: center; gap: 0.4rem;
            text-decoration: none; transition: color 0.25s ease;
        }
        .nav-back:hover { color: var(--sand) !important; }
        .btn-nav-order {
            background: var(--sand); color: var(--espresso) !important;
            font-size: 0.78rem; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;
            padding: 0.45rem 1.3rem !important; border-radius: 2px; text-decoration: none;
            transition: background 0.25s ease, transform 0.25s ease;
        }
        .btn-nav-order:hover { background: var(--cream); transform: translateY(-1px); }

        /* ═══════════════════════════════
           PAGE HEADER
        ═══════════════════════════════ */
        .page-header {
            background: var(--espresso);
            padding: 4.5rem 2.5rem 3.5rem;
            position: relative; overflow: hidden;
        }
        .page-header::after {
            content: 'MENU';
            position: absolute; right: -20px; top: 50%; transform: translateY(-50%);
            font-family: var(--font-serif); font-size: 14rem; font-weight: 900;
            color: rgba(194,178,128,0.05); letter-spacing: -0.05em;
            pointer-events: none; white-space: nowrap;
        }
        .page-eyebrow {
            font-size: 0.72rem; letter-spacing: 0.25em; text-transform: uppercase;
            color: var(--sand); margin-bottom: 0.8rem;
            display: flex; align-items: center; gap: 0.75rem;
        }
        .page-eyebrow::before {
            content: ''; display: inline-block; width: 28px; height: 1px; background: var(--sand);
        }
        .page-title {
            font-size: clamp(2.4rem, 5vw, 4rem); font-weight: 900;
            color: var(--linen); line-height: 1.05; letter-spacing: -0.03em; margin-bottom: 1rem;
        }
        .page-title em { font-style: italic; color: var(--sand); }
        .page-desc {
            font-size: 1rem; font-weight: 300;
            color: rgba(245,245,240,0.55); max-width: 480px; line-height: 1.7;
        }

        /* ═══════════════════════════════
           FILTER BAR
        ═══════════════════════════════ */
        .filter-bar {
            background: #fff;
            border-bottom: 1px solid var(--cream);
            padding: 0 2.5rem;
            position: sticky; top: 66px; z-index: 900;
        }
        .filter-tabs { display: flex; gap: 0; overflow-x: auto; scrollbar-width: none; }
        .filter-tabs::-webkit-scrollbar { display: none; }
        .filter-tab {
            padding: 1rem 1.5rem;
            font-size: 0.8rem; letter-spacing: 0.1em; text-transform: uppercase;
            font-weight: 500; white-space: nowrap; color: var(--text-muted);
            text-decoration: none; border-bottom: 2px solid transparent;
            transition: color 0.25s ease, border-color 0.25s ease;
            display: flex; align-items: center; gap: 0.45rem;
        }
        .filter-tab:hover { color: var(--mocha); }
        .filter-tab.active { color: var(--espresso); border-bottom-color: var(--mocha); }
        .count-pill {
            background: var(--cream); color: var(--mocha);
            font-size: 0.67rem; font-weight: 600;
            padding: 0.1rem 0.5rem; border-radius: 20px;
        }
        .filter-tab.active .count-pill { background: var(--mocha); color: var(--linen); }

        /* ═══════════════════════════════
           PRODUCTS AREA
        ═══════════════════════════════ */
        .products-section { padding: 2.5rem; }

        .results-bar {
            display: flex; justify-content: space-between; align-items: center;
            padding-bottom: 1.5rem;
        }
        .results-count {
            font-size: 0.78rem; letter-spacing: 0.06em; text-transform: uppercase;
            color: var(--text-muted);
        }
        .results-count strong { color: var(--mocha); font-weight: 600; }

        /* ═══════════════════════════════
           PRODUCT CARD
           Tip 22: Generous padding throughout
        ═══════════════════════════════ */
        .product-card {
            background: #fff;
            border: 1px solid rgba(194,178,128,0.22);
            border-radius: 6px; overflow: hidden;
            height: 100%; display: flex; flex-direction: column;
            transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease), border-color 0.35s var(--ease);
        }
        .product-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 24px 64px rgba(59,42,42,0.13);
            border-color: rgba(194,178,128,0.55);
        }

        /* Image */
        .card-img-wrap {
            position: relative; width: 100%; padding-top: 66%;
            background: var(--cream); overflow: hidden;
        }
        .card-img-wrap img {
            position: absolute; inset: 0; width: 100%; height: 100%;
            object-fit: cover; transition: transform 0.5s var(--ease);
        }
        .product-card:hover .card-img-wrap img { transform: scale(1.06); }

        /* Placeholder — shown until real image added */
        .img-ph {
            position: absolute; inset: 0;
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 0.6rem;
            background: linear-gradient(145deg, var(--cream) 0%, #d6c59a 100%);
        }
        .img-ph-emoji { font-size: 5rem; line-height: 1; }
        .img-ph-label {
            font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--mocha); opacity: 0.5;
        }
        .img-ph-filename {
            font-size: 0.6rem; font-family: monospace;
            color: var(--mocha); opacity: 0.4; margin-top: -0.3rem;
        }

        /* Overlaid badges */
        .card-badge {
            position: absolute; top: 14px; left: 14px;
            font-size: 0.63rem; font-weight: 600; letter-spacing: 0.12em; text-transform: uppercase;
            padding: 0.3rem 0.8rem; border-radius: 20px;
            background: var(--espresso); color: var(--cream); z-index: 2;
        }
        .card-cat-pill {
            position: absolute; top: 14px; right: 14px;
            font-size: 0.6rem; letter-spacing: 0.1em; text-transform: uppercase;
            padding: 0.25rem 0.7rem; border-radius: 20px;
            background: rgba(245,245,240,0.9); color: var(--mocha); z-index: 2;
            backdrop-filter: blur(4px);
        }

        /* ── Section: Name + tagline + desc (Tip 22: padding) ── */
        .c-body {
            padding: 1.75rem 1.75rem 0;
            flex: 1;
        }
        .c-name {
            font-size: 1.3rem; font-weight: 700;
            color: var(--espresso); line-height: 1.2; margin-bottom: 0.3rem;
        }
        .c-tagline {
            font-size: 0.84rem; font-style: italic;
            color: var(--text-muted); line-height: 1.5; margin-bottom: 1rem;
        }
        .c-desc {
            font-size: 0.87rem; font-weight: 300;
            color: #7A6355; line-height: 1.75;
        }

        /* ── Section: Tags ── */
        .c-tags { padding: 1rem 1.75rem 0; display: flex; flex-wrap: wrap; gap: 0.4rem; }
        .tag {
            font-size: 0.67rem; letter-spacing: 0.08em; text-transform: uppercase;
            padding: 0.25rem 0.75rem; border-radius: 20px;
            background: var(--linen); color: var(--text-mid);
            border: 1px solid var(--cream);
        }

        /* ── Section: Specs (Tip 6: icons + labeled grid) ── */
        .c-specs { padding: 1.25rem 1.75rem 0; }
        .specs-head {
            font-size: 0.63rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: var(--text-muted); margin-bottom: 0.75rem;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .specs-head::after { content: ''; flex: 1; height: 1px; background: var(--cream); }
        .specs-grid {
            display: grid; grid-template-columns: 1fr 1fr; gap: 0.55rem;
        }
        .spec-item {
            display: flex; align-items: flex-start; gap: 0.55rem;
            padding: 0.6rem 0.7rem; background: var(--linen);
            border-radius: 4px; border: 1px solid transparent;
            transition: border-color 0.2s ease;
        }
        .product-card:hover .spec-item { border-color: var(--cream); }
        .s-icon { font-size: 0.9rem; color: var(--mocha); flex-shrink: 0; margin-top: 1px; }
        .s-label {
            font-size: 0.61rem; letter-spacing: 0.08em; text-transform: uppercase;
            color: var(--text-muted); line-height: 1; margin-bottom: 0.2rem;
        }
        .s-value { font-size: 0.79rem; font-weight: 500; color: var(--espresso); }

        /* ── Section: Meta (rating, calories, volume) ── */
        .c-meta {
            padding: 1rem 1.75rem 0;
            display: flex; align-items: center; gap: 1.2rem; flex-wrap: wrap;
        }
        .meta-i { display: flex; align-items: center; gap: 0.35rem; font-size: 0.77rem; color: var(--text-muted); }
        .meta-i i { font-size: 0.8rem; color: var(--sand); }
        .stars { color: #D4A017; font-size: 0.72rem; }

        /* ── Section: Footer ── */
        .c-footer {
            padding: 1.4rem 1.75rem;
            margin-top: 1.25rem;
            border-top: 1px solid var(--cream);
            display: flex; justify-content: space-between; align-items: center;
            background: #fff;
        }
        .price-lbl { font-size: 0.6rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.1rem; }
        .price-val { font-family: var(--font-serif); font-size: 1.65rem; font-weight: 900; color: var(--espresso); line-height: 1; }
        .price-sub { font-size: 0.68rem; color: var(--text-muted); margin-top: 0.1rem; }

        .btn-add {
            background: var(--espresso); color: var(--cream);
            font-size: 0.76rem; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase;
            padding: 0.7rem 1.35rem; border-radius: 2px; border: none;
            display: flex; align-items: center; gap: 0.45rem; cursor: pointer; text-decoration: none;
            transition: background 0.25s ease, transform 0.25s ease, box-shadow 0.25s ease;
        }
        .btn-add:hover {
            background: var(--mocha); color: var(--cream);
            transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59,42,42,0.25);
        }

        /* ═══════════════════════════════
           FOOTER
        ═══════════════════════════════ */
        .page-footer {
            background: var(--espresso);
            border-top: 1px solid rgba(194,178,128,0.12);
            padding: 1.5rem 2.5rem;
        }
        .footer-brand { font-family: var(--font-serif); font-size: 0.9rem; font-weight: 700; color: rgba(245,245,240,0.5); }
        .footer-brand span { color: var(--sand); }
        .footer-txt { font-size: 0.75rem; color: rgba(245,245,240,0.3); }

        /* ═══════════════════════════════
           SCROLL REVEAL
        ═══════════════════════════════ */
        .reveal {
            opacity: 0; transform: translateY(22px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 767px) {
            .products-section { padding: 1.5rem; }
            .page-header { padding: 3rem 1.5rem 2.5rem; }
            .filter-bar { padding: 0 1rem; }
            .c-body, .c-specs, .c-tags, .c-meta, .c-footer { padding-left: 1.25rem; padding-right: 1.25rem; }
        }
    </style>
</head>
<body>

<!-- ══════════════════════════════════════
     NAVBAR
══════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../../index.php">☕ Mindflayer<span class="dot">.</span></a>
        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="../../index.php" class="nav-back">
                <i class="bi bi-arrow-left"></i> Back to Home
            </a>
            <a href="#" class="btn-nav-order">Order Now</a>
        </div>
    </div>
</nav>


<!-- ══════════════════════════════════════
     PAGE HEADER
══════════════════════════════════════ -->
<header class="page-header">
    <div class="container">
        <p class="page-eyebrow">Handcrafted Drinks</p>
        <h1 class="page-title">Our <em>Signature</em> Menu.</h1>
        <p class="page-desc">Every drink is made to order with real ingredients, ethically sourced beans, and a little extra care.</p>
    </div>
</header>


<!-- ══════════════════════════════════════
     FILTER BAR — Tip 6: clear section labels
══════════════════════════════════════ -->
<div class="filter-bar">
    <div class="container">
        <div class="filter-tabs">
            <?php
            $tab_icons = [
                'All'          => 'bi-grid-fill',
                'Espresso'     => 'bi-cup-hot',
                'Non-Espresso' => 'bi-cup-straw',
                'Cold Brew'    => 'bi-snow',
            ];
            foreach ($categories as $cat):
                $is_active = $active_cat === $cat;
                $cnt = $cat === 'All' ? count($products) : ($cat_counts[$cat] ?? 0);
            ?>
            <a href="?cat=<?= urlencode($cat) ?>"
               class="filter-tab <?= $is_active ? 'active' : '' ?>">
                <i class="<?= $tab_icons[$cat] ?? 'bi-dot' ?>"></i>
                <?= htmlspecialchars($cat) ?>
                <span class="count-pill"><?= $cnt ?></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<!-- ══════════════════════════════════════
     PRODUCTS
══════════════════════════════════════ -->
<main>
    <section class="products-section">
        <div class="container">

            <div class="results-bar">
                <p class="results-count mb-0">
                    Showing <strong><?= count($filtered) ?></strong>
                    drink<?= count($filtered) !== 1 ? 's' : '' ?>
                    <?= $active_cat !== 'All' ? '&nbsp;· <strong>' . htmlspecialchars($active_cat) . '</strong>' : '' ?>
                </p>
            </div>

            <div class="row g-4">
                <?php foreach ($filtered as $i => $p): ?>
                <div class="col-md-6 col-xl-4 reveal" style="transition-delay:<?= $i * 0.08 ?>s">
                    <div class="product-card">

                        <!-- ── IMAGE — placeholder until real image added ── -->
                        <div class="card-img-wrap">
                            <?php if (file_exists(__DIR__ . '/' . $p['image'])): ?>
                                <img src="<?= htmlspecialchars($p['image']) ?>"
                                     alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy"/>
                            <?php else: ?>
                                <div class="img-ph">
                                    <span class="img-ph-emoji"><?= $p['emoji'] ?></span>
                                    <span class="img-ph-label">Add image to:</span>
                                    <span class="img-ph-filename"><?= htmlspecialchars($p['image']) ?></span>
                                </div>
                            <?php endif; ?>
                            <span class="card-badge"><?= htmlspecialchars($p['badge']) ?></span>
                            <span class="card-cat-pill"><?= htmlspecialchars($p['category']) ?></span>
                        </div>

                        <!-- ── SECTION 1: Name + Description (Tip 22: padded) ── -->
                        <div class="c-body">
                            <h2 class="c-name"><?= htmlspecialchars($p['name']) ?></h2>
                            <p class="c-tagline"><?= htmlspecialchars($p['tagline']) ?></p>
                            <p class="c-desc"><?= htmlspecialchars($p['desc']) ?></p>
                        </div>

                        <!-- ── SECTION 2: Flavor Tags ── -->
                        <div class="c-tags">
                            <?php foreach ($p['tags'] as $tag): ?>
                            <span class="tag"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </div>

                        <!-- ── SECTION 3: Specs (Tip 6: icons + labels) ── -->
                        <div class="c-specs">
                            <p class="specs-head"><i class="bi bi-info-circle me-1"></i>Drink Details</p>
                            <div class="specs-grid">
                                <?php foreach ($p['specs'] as $spec): ?>
                                <div class="spec-item">
                                    <i class="bi <?= $spec['icon'] ?> s-icon"></i>
                                    <div>
                                        <div class="s-label"><?= $spec['label'] ?></div>
                                        <div class="s-value"><?= $spec['value'] ?></div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- ── SECTION 4: Rating + Meta ── -->
                        <div class="c-meta">
                            <div class="meta-i">
                                <span class="stars">
                                    <?php
                                    $full  = (int)floor($p['rating']);
                                    $half  = ($p['rating'] - $full) >= 0.5 ? 1 : 0;
                                    $empty = 5 - $full - $half;
                                    echo str_repeat('★', $full);
                                    if ($half) echo '½';
                                    echo str_repeat('☆', $empty);
                                    ?>
                                </span>
                                <?= $p['rating'] ?> (<?= $p['reviews'] ?>)
                            </div>
                            <div class="meta-i"><i class="bi bi-fire"></i><?= $p['calories'] ?></div>
                            <div class="meta-i"><i class="bi bi-cup"></i><?= $p['volume'] ?></div>
                        </div>

                        <!-- ── SECTION 5: Price + CTA ── -->
                        <div class="c-footer">
                            <div>
                                <div class="price-lbl">Starting at</div>
                                <div class="price-val">₱<?= number_format($p['price']) ?></div>
                                <div class="price-sub"><?= $p['volume'] ?> · <?= $p['category'] ?></div>
                            </div>
                            <a href="#" class="btn-add">
                                Add to Order <i class="bi bi-plus-circle"></i>
                            </a>
                        </div>

                    </div><!-- /.product-card -->
                </div>
                <?php endforeach; ?>
            </div><!-- /.row -->

        </div>
    </section>
</main>


<!-- ══════════════════════════════════════
     FOOTER
══════════════════════════════════════ -->
<footer class="page-footer">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="footer-brand">Mindflayer<span>.</span></span>
        <span class="footer-txt">All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery</span>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Scroll reveal
    const revealEls = document.querySelectorAll('.reveal');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('visible'), i * 80);
                obs.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    revealEls.forEach(el => obs.observe(el));

    // Add to order feedback
    document.querySelectorAll('.btn-add').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const orig = this.innerHTML;
            this.innerHTML = '<i class="bi bi-check-circle-fill"></i> Added!';
            this.style.background = '#5C7A4A';
            setTimeout(() => { this.innerHTML = orig; this.style.background = ''; }, 1800);
        });
    });
</script>

</body>
</html>