<?php
// pages/ProductListPage/products.php

require_once __DIR__ . '/products-data.php';

$active_cat = isset($_GET['cat']) ? $_GET['cat'] : 'All';
$filtered = $active_cat === 'All'
    ? $products
    : array_values(array_filter($products, fn($p) => $p['category'] === $active_cat));

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($search !== '') {
    $filtered = array_values(array_filter($filtered, function($p) use ($search) {
        return stripos($p['name'], $search) !== false;
    }));
}

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
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1.5rem;
            padding-bottom: 1.75rem;
        }
        .results-count {
            font-size: 0.78rem; letter-spacing: 0.06em; text-transform: uppercase;
            color: var(--text-muted);
        }
        .results-count strong { color: var(--mocha); font-weight: 600; }

        .search-form {
            flex: 1;
            max-width: 420px;
        }
        .search-input {
            border-radius: 999px;
            border: 1px solid var(--cream);
            padding: 0.65rem 1.1rem;
            font-size: 0.9rem;
            background-color: #fff;
        }
        .search-input::placeholder {
            color: var(--text-muted);
            font-size: 0.85rem;
        }

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
            cursor: pointer;
        }
        .product-card:hover { box-shadow: 0 20px 44px rgba(0,0,0,0.08); }
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
        .add-cart-btn {
            background: #8b5e3c !important;
            color: #fff !important;
        }
        .add-cart-btn:hover,
        #modal-add-cart {
            background: #8b5e3c !important;
            color: #fff !important;
        }
        #modal-add-cart:hover {
            background: #79523a !important;
            color: #fff !important;
        }
        .btn-add:hover {
            background: var(--mocha); color: var(--cream);
            transform: translateY(-2px); box-shadow: 0 6px 20px rgba(59,42,42,0.25);
        }

        .section-heading {
            font-family: var(--font-serif);
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: #5b3f2f;
            letter-spacing: 0.04em;
        }

        .modal-content {
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 22px 50px rgba(59, 42, 42, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid rgba(194,178,128,0.35);
            background: linear-gradient(110deg, #f8f1e8 0%, #fff7ef 100%);
        }

        .modal-body {
            background: radial-gradient(circle at top left, #fffaf3 0%, #fef9f5 55%, #f6efe4 100%);
        }

        /* Modal: left landscape image gallery */
        .modal-gallery-left {
            flex: 0 0 42%;
            max-width: 42%;
        }
        .modal-gallery-main {
            aspect-ratio: 16 / 10;
            border-radius: 0.65rem;
            overflow: hidden;
            background: var(--cream);
            border: 1px solid #e6dac8;
        }
        .modal-gallery-main img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @media (max-width: 767px) {
            .modal-gallery-left { flex: 0 0 100%; max-width: 100%; order: -1; }
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
            .results-bar { flex-direction: column; align-items: flex-start; }
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
                <form method="get" class="search-form">
                    <?php if ($active_cat !== 'All'): ?>
                        <input type="hidden" name="cat" value="<?= htmlspecialchars($active_cat) ?>">
                    <?php endif; ?>
                    <input
                        type="search"
                        name="q"
                        value="<?= htmlspecialchars($search) ?>"
                        class="form-control search-input"
                        placeholder="Search for coffee, lattes, and more"
                        aria-label="Search drinks"
                    >
                </form>
                <p class="results-count mb-0">
                    Showing <strong><?= count($filtered) ?></strong>
                    drink<?= count($filtered) !== 1 ? 's' : '' ?>
                    <?= $active_cat !== 'All' ? '&nbsp;· <strong>' . htmlspecialchars($active_cat) . '</strong>' : '' ?>
                </p>
            </div>

            <div class="row g-4">
                <?php foreach ($filtered as $i => $p): ?>
                <div class="col-md-6 col-xl-4 reveal" style="transition-delay:<?= $i * 0.08 ?>s">
                    <div class="product-card" data-product-id="<?= $p['id'] ?>">

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

                        <!-- ── SECTION 1: Name only (details moved to popup) ── -->
                        <div class="c-body">
                            <h2 class="c-name"><?= htmlspecialchars($p['name']) ?></h2>
                        </div>

                        <!-- ── SECTION 5: Price + CTA ── -->
                        <div class="c-footer">
                            <div>
                                <div class="price-lbl">Starting at</div>
                                <div class="price-val">₱<?= number_format($p['price']) ?></div>
                                <div class="price-sub"><?= $p['volume'] ?> · <?= $p['category'] ?></div>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="#" class="btn-add add-cart-btn" data-product-id="<?= $p['id'] ?>">
                                    Add to Cart <i class="bi bi-plus-circle"></i>
                                </a>
                            </div>
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

<!-- Quick view product modal -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="productDetailModalLabel">Product</h5>
                    <p id="modal-tagline" class="mb-0 text-muted" style="font-size:0.9rem;"></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row g-4 align-items-start flex-lg-nowrap">
                    <!-- Left: single photo -->
                    <div class="modal-gallery-left col-12 col-lg-5">
                        <div class="modal-gallery-main">
                            <img id="modal-image" src="" alt="" class="img-fluid">
                        </div>
                    </div>
                    <!-- Right: product details -->
                    <div class="col-12 col-lg-7">
                        <h4 id="modal-name"></h4>
                        <p id="modal-desc" class="mb-3"></p>
                        <div class="mb-2"><strong>Price:</strong> <span id="modal-price"></span></div>
                        <div class="mb-2"><strong>Volume:</strong> <span id="modal-volume"></span></div>
                        <div class="mb-2"><strong>Category:</strong> <span id="modal-cat"></span></div>
                        <div class="mb-2"><strong>Calories:</strong> <span id="modal-cals"></span></div>
                        <a href="#" id="modal-add-cart" class="btn btn-sm btn-primary mt-2"><i class="bi bi-cart-fill"></i> Add to Cart</a>
                    </div>
                </div>

                <hr>

                <div class="p-3 rounded-3">
                    <h4 class="section-heading" style="font-size:1.3rem; font-weight:600; font-family:var(--font-serif);"><i class="bi bi-list-check"></i> Specifications</h4>
                    <div id="modal-specs" class="row gy-3"></div>
                </div>

            </div>  
        </div>
    </div>
</div>

<!-- Hidden form to post cart additions -->
<form id="add-to-cart-form" method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="d-none">
    <input type="hidden" name="product_id" id="add-to-cart-product-id" value="">
</form>

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

    // Product data for quick view modal
    const productsData = <?= json_encode($products, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;
    const productModal = new bootstrap.Modal(document.getElementById('productDetailModal'));

    function getSpecIcon(label) {
        switch (label.toLowerCase()) {
            case 'temperature': return 'bi-thermometer-half';
            case 'base': return 'bi-cup-straw';
            case 'milk': return 'bi-droplet-half';
            case 'caffeine': return 'bi-lightning-charge';
            default: return 'bi-list';
        }
    }

    function formatSpecs(specs) {
        if (!Array.isArray(specs)) return '';
        return specs.map(spec => {
            const icon = getSpecIcon(spec.label || '');
            return `
            <div class="col-12 col-sm-6">
                <div class="bg-light rounded p-3 d-flex align-items-start gap-2" style="border-left: 3px solid #8b5e3c;">
                    <i class="bi ${icon}" style="font-size:1.25rem; color:#8b5e3c; margin-top: 3px;"></i>
                    <div>
                        <div class="fw-bold" style="font-size:1.03rem; letter-spacing:0.02em;">${spec.label}</div>
                        <div class="text-secondary" style="font-size:0.92rem;">${spec.value}</div>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    function showProductModal(product) {
        if (!product) return;

        const placeholder = 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800&q=80';
        const imageUrl = (product.image && product.image.trim()) ? product.image : placeholder;

        document.getElementById('productDetailModalLabel').textContent = product.name;
        document.getElementById('modal-tagline').textContent = product.tagline;
        document.getElementById('modal-name').textContent = product.name;
        document.getElementById('modal-desc').textContent = product.desc;
        document.getElementById('modal-image').src = imageUrl;
        document.getElementById('modal-image').alt = product.name;
        document.getElementById('modal-price').textContent = '₱' + Number(product.price).toLocaleString();
        document.getElementById('modal-volume').textContent = product.volume;
        document.getElementById('modal-cat').textContent = product.category;
        document.getElementById('modal-cals').textContent = product.calories;
        document.getElementById('modal-specs').innerHTML = formatSpecs(product.specs);

        document.getElementById('modal-add-cart').dataset.productId = product.id;
        productModal.show();
    }

    document.querySelectorAll('.product-card').forEach(card => {
        card.addEventListener('click', function(e) {
            if (e.target.closest('.add-cart-btn')) {
                return;
            }
            const id = Number(this.dataset.productId);
            const prod = productsData.find(item => item.id === id);
            showProductModal(prod);
        });
    });

    // Add to cart: submit to shopping cart (session-backed)
    const cartForm = document.getElementById('add-to-cart-form');
    const cartInput = document.getElementById('add-to-cart-product-id');

    function submitAddToCart(productId) {
        cartInput.value = String(productId || '');
        cartForm.submit();
    }

    document.querySelectorAll('.add-cart-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            submitAddToCart(this.dataset.productId);
        });
    });

    document.getElementById('modal-add-cart').addEventListener('click', function(e) {
        e.preventDefault();
        submitAddToCart(this.dataset.productId);
    });
</script>

</body>
</html>