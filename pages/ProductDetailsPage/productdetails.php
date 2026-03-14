<?php
// pages/ProductDetailsPage/productdetails.php

session_start();

require_once __DIR__ . '/../ProductListPage/products-data.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$selectedProduct = null;
foreach ($products as $product) {
    if ($product['id'] === $productId) {
        $selectedProduct = $product;
        break;
    }
}

if (!$selectedProduct) {
    header('Location: ../ProductListPage/products.php');
    exit;
}

function html($text)
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html($selectedProduct['name']) ?> · Mindflayer Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --text-dark: #2A1E1E;
            --text-mid: #6F4C3E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', system-ui, sans-serif;
            --transition: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        h1,
        h2,
        h3,
        h4,
        h5 {
            font-family: var(--font-display);
        }

        a {
            text-decoration: none;
        }

        /* ── INTENTIONALLY BAD NAVBAR ── */
        .navbar {
            background-color: var(--espresso);
            padding: 4px 8px;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
        }

        .navbar-brand {
            font-family: var(--font-display);
            font-size: 0.65rem;            /* tiny */
            font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
        }

        .navbar-brand span.dot {
            color: var(--sand);
        }

        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }

        .navbar-nav .nav-link {
            color: rgba(232, 216, 176, 0.75) !important;
            font-size: 0.5rem;             /* very small */
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 1rem !important;
            text-align: right;
            transition: color var(--transition);
        }

        .navbar-nav .nav-link:hover {
            color: var(--cream) !important;
        }

        .btn-nav-cta {
            background-color: var(--sand);
            color: var(--sand) !important; /* same as background = invisible text */
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.5rem 1.4rem !important;
            border-radius: 2px;
            transition: background var(--transition), transform var(--transition);
        }

        .btn-nav-cta:hover {
            background-color: var(--cream);
            color: var(--cream) !important; /* still invisible on hover */
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.9rem 1.5rem;
            }
        }

        .breadcrumb-bar { padding: 4px 8px; background: var(--white); border: none; }
        .breadcrumb-bar .breadcrumb { padding: 0; margin: 0; background: transparent; }
        .breadcrumb-bar .breadcrumb-item { display: inline; font-size: 0.85rem; }
        .breadcrumb-bar .breadcrumb-item + .breadcrumb-item::before { content: " / "; }
        .breadcrumb-item a { color: var(--text-light); }
        .breadcrumb-item.active { color: var(--text-mid); }
        .btn-back-arrow { width: 20px; height: 20px; font-size: 0.75rem; padding: 0; display: inline-flex; }

        .dense-wrapper { max-width: 100%; margin: 0; padding: 4px 8px; line-height: 1.2; }
        .dense-block p { margin: 0 0 2px 0; }
        .product-image-wrap {
            width: 48px; height: 48px; display: inline-block; vertical-align: middle;
            overflow: hidden; border-radius: 0; margin-right: 4px;
        }
        .product-image-wrap img { width: 100%; height: 100%; object-fit: cover; }
        .product-image-fallback { font-size: 1.5rem; }
        .product-badge-pill, .product-title, .product-tagline, .rating-row, .price-display, .price-label { display: inline; margin: 0; padding: 0 4px 0 0; }
        .product-title { font-size: 0.95rem; }
        .product-tagline { font-size: 0.9rem; }
        .rating-stars, .rating-num, .rating-count { display: inline; margin: 0 4px 0 0; font-size: 0.85rem; }
        .price-display { font-size: 0.95rem; }
        .price-label { font-size: 0.78rem; }
        .quick-stats { display: inline; margin: 0; padding: 0; border: none; }
        .quick-stat { display: inline; padding: 0 4px 0 0; border: none; }
        .quick-stat-val, .quick-stat-lbl { display: inline; font-size: 0.85rem; }
        .quick-stat::after { content: " · "; }
        .quick-stat:last-child::after { content: ""; }

        .btn-add-cart {
            padding: 2px 8px; font-size: 0.85rem; min-width: auto;
            display: inline-flex; margin: 0 0 0 4px;
        }
        .btn-add-cart.added { padding: 2px 8px; }
        .btn-add-cart .ripple { display: none; }

        .detail-tabs { padding: 4px 0; border: none; background: transparent; }
        .nav-tabs-mf { display: none; }
        .tab-panel { padding: 4px 0; }
        .tab-pane { display: block !important; }
        .spec-grid { display: inline; }
        .spec-card-mf { display: inline; padding: 0 4px 0 0; margin: 0; border: none; background: transparent; }
        .spec-card-icon { display: none; }
        .spec-card-label, .spec-card-value { display: inline; font-size: 0.85rem; }
        .spec-card-label::after { content: ": "; }
        .spec-card-mf:not(:last-child)::after { content: " · "; }
        .taste-pill { display: inline; padding: 0; margin: 0 4px 0 0; border: none; background: transparent; font-size: 0.85rem; }
        .taste-pill::after { content: " · "; }
    </style>
</head>

<body>

    <!-- ═══ NAVBAR ═══════════════════════════════════════════════ -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Mindflayers/index.php">
                ☕ Mindflayer<span class="dot">.</span>
            </a>
            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="text-warning bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="gap-1 mx-auto navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/ProductListPage/products.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/AboutPage/about.php">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/index.php#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/index.php#contact">Locations</a></li>
                    <li class="nav-item"><a class="nav-link" href="/Mindflayers/pages/ProfilePage/profile.php">Profile</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="/Mindflayers/pages/SignupPage/login.php" class="nav-link" style="font-size:0.85rem;">Login</a>
                    <a href="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="btn-nav-cta nav-link">
                        <i class="me-1 bi bi-bag"></i> Shopping Cart
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="breadcrumb-bar dense-wrapper">
        <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn-back-arrow" aria-label="Back to Menu"><i class="bi-arrow-left bi"></i></a>
        <nav aria-label="breadcrumb"><ol class="mb-0 breadcrumb"><li class="breadcrumb-item"><a href="/Mindflayers/index.php">Home</a></li><li class="breadcrumb-item"><a href="/Mindflayers/pages/ProductListPage/products.php">Menu</a></li><li class="breadcrumb-item active"><?= html($selectedProduct['name']) ?></li></ol></nav>
    </div>

    <main class="dense-wrapper dense-block">
        <p>
            <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn-back-arrow"><i class="bi-arrow-left bi"></i></a>
            <span class="product-image-wrap">
                <?php if (!empty($selectedProduct['image'])): ?>
                    <img src="/Mindflayers/pages/ProductListPage/<?= html($selectedProduct['image']) ?>" alt="">
                <?php else: ?>
                    <span class="product-image-fallback">☕</span>
                <?php endif; ?>
            </span>
            <span class="product-badge-pill"><?= html($selectedProduct['badge']) ?></span>
            <span class="product-title"><?= html($selectedProduct['name']) ?></span>
            <span class="product-tagline"><?= html($selectedProduct['tagline']) ?></span>
            <span class="rating-row">
                <span class="rating-stars"><?php for ($i = 0; $i < 5; $i++): ?><i class="bi bi-star<?= $i < floor($selectedProduct['rating']) ? '-fill' : ($i < $selectedProduct['rating'] ? '-half' : '') ?>"></i><?php endfor; ?></span>
                <span class="rating-num"><?= number_format($selectedProduct['rating'], 1) ?></span>
                <span class="rating-count">(<?= html($selectedProduct['reviews']) ?> reviews)</span>
            </span>
            <span class="quick-stats">
                <span class="quick-stat"><span class="quick-stat-val"><?= html($selectedProduct['volume']) ?></span><span class="quick-stat-lbl">Volume</span></span>
                <span class="quick-stat"><span class="quick-stat-val"><?= html($selectedProduct['calories']) ?></span><span class="quick-stat-lbl">Calories</span></span>
                <span class="quick-stat"><span class="quick-stat-val"><?= html($selectedProduct['category']) ?></span><span class="quick-stat-lbl">Category</span></span>
            </span>
            <span class="price-display">₱<?= number_format($selectedProduct['price']) ?></span>
            <span class="price-label">Philippine Peso · Inclusive of taxes</span>
            <form method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="d-inline m-0" id="cart-form">
                <input type="hidden" name="product_id" value="<?= (int)$selectedProduct['id'] ?>">
                <button type="submit" class="btn-add-cart" id="btn-add-cart">
                    <span class="btn-label-default"><i class="bi bi-cart-fill"></i> Add to Cart</span>
                    <span class="btn-label-added"><i class="bi bi-check-circle-fill"></i> Added</span>
                </button>
            </form>
        </p>
        <p><?= html($selectedProduct['desc']) ?> <span class="taste-pill">Cozy Flavor</span><span class="taste-pill">Energy Boost</span><span class="taste-pill">Feel Good</span><span class="taste-pill"><?= html($selectedProduct['badge']) ?></span> Origin: Ethically sourced beans · Prep Time: Made fresh to order · Packaging: Eco-friendly, compostable · Dine In: Free WiFi available</p>
        <p>
            <?php foreach ($selectedProduct['specs'] as $spec): ?>
                <span class="spec-card-mf"><span class="spec-card-label"><?= html($spec['label']) ?></span><span class="spec-card-value"><?= html($spec['value']) ?></span></span>
            <?php endforeach; ?>
        </p>
        <p>Sweetness 85% · Bitterness 30% · Creaminess 90% · Intensity 60% · Tasting Notes: Creamy · Smooth · Sweet · Floral · Warm · Rich · Best enjoyed mid-morning or as an afternoon pick-me-up. Pairs well with our pastry selection.</p>
        <p>Preparation Time: 5–10 minutes after order is placed. All drinks are made fresh to order — no pre-made batches. Delivery Estimate: 30–45 minutes for Metro Manila. Salcedo, BGC, and Poblacion branches offer 20-minute delivery windows. Packaging: All orders use eco-friendly, compostable cups and paper straws. No single-use plastics. Order Changes: Modifications accepted within 2 minutes of placing your order via the app or by calling the branch directly.</p>
    </main>

    <!-- ═══ FOOTER ════════════════════════════════════════════════ -->
    <footer style="background-color:var(--espresso);border-top:1px solid rgba(194,178,128,0.12);padding:4px 8px;">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 container-fluid">
            <p class="mb-0" style="font-family:var(--font-display);font-size:0.9rem;font-weight:700;color:rgba(245,245,240,0.5);">
                Mindflayer<span style="color:var(--sand);">.</span>
            </p>
            <span style="font-size:0.75rem;color:rgba(245,245,240,0.3);">All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery</span>
            <div class="d-flex align-items-center gap-3">
                <div style="display:flex;gap:1.5rem;">
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Privacy</a>
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Terms</a>
                    <a href="#" style="color:rgba(245,245,240,0.4);font-size:0.78rem;text-decoration:none;transition:color 0.3s ease;" onmouseover="this.style.color='var(--sand)'" onmouseout="this.style.color='rgba(245,245,240,0.4)'">Contact</a>
                </div>
                <div style="display:flex;gap:0.5rem;">
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-instagram"></i></a>
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-facebook"></i></a>
                    <a href="#" style="width:36px;height:36px;border-radius:50%;border:1px solid rgba(194,178,128,0.2);display:inline-flex;align-items:center;justify-content:center;color:rgba(245,245,240,0.5);font-size:0.85rem;text-decoration:none;transition:all 0.3s ease;" onmouseover="this.style.borderColor='var(--sand)';this.style.color='var(--sand)'" onmouseout="this.style.borderColor='rgba(194,178,128,0.2)';this.style.color='rgba(245,245,240,0.5)'"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/auth.js"></script>
    <script>
        /* ── Add to Cart Animation ── */
        const cartForm = document.getElementById('cart-form');
        const btn = document.getElementById('btn-add-cart');

        cartForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Check if user is logged in
            if (!isLoggedIn()) {
                alert('You must be logged in first to add items to cart. Please log in to continue.');
                window.location.href = '../SignupPage/login.php';
                return;
            }

            // Guard against double-clicks
            if (btn.classList.contains('added')) return;

            // Ripple
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            const size = Math.max(btn.offsetWidth, btn.offsetHeight);
            ripple.style.cssText = `width:${size}px;height:${size}px;left:${btn.offsetWidth/2 - size/2}px;top:${btn.offsetHeight/2 - size/2}px`;
            btn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());

            // Swap to "Added" state
            btn.classList.add('added');

            // Submit via fetch — stay on the page
            fetch(cartForm.action, {
                method: cartForm.method,
                body: new FormData(cartForm),
                credentials: 'same-origin'
            }).catch(() => {
                /* silent fallback */ });

            // Reset after 2s
            setTimeout(() => {
                btn.classList.remove('added');
            }, 2000);
        });
    </script>
</body>

</html>