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
    header('Location: /Mindflayers/pages/ProductListPage/products.php');
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

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: var(--font-body); background-color: var(--linen); color: var(--text-dark); overflow-x: hidden; }
        h1, h2, h3, h4, h5 { font-family: var(--font-display); }
        a { text-decoration: none; }

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
            font-size: 0.65rem;
            font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
        }
        .navbar-brand span.dot { color: var(--sand); }
        .navbar-nav {
            margin-left: auto !important;
            margin-right: 0 !important;
        }
        .navbar-nav .nav-link {
            color: rgba(232, 216, 176, 0.75) !important;
            font-size: 0.5rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 1rem !important;
            text-align: right;
            transition: color var(--transition);
        }
        .navbar-nav .nav-link:hover { color: var(--cream) !important; }
        .btn-nav-cta {
            background-color: var(--sand);
            color: var(--sand) !important;
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
            color: var(--cream) !important;
            transform: translateY(-1px);
        }
        @media (max-width: 991.98px) { .navbar { padding: 0.9rem 1.5rem; } }

        /* ── BAD CONTENT STYLES ── */
        .page-wrap {
            padding: 1.5rem 1.25rem;
            max-width: 100%;
        }
        .page-wrap p {
            margin-bottom: 1rem;
            font-size: 0.92rem;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.45rem 1rem;
            border: none;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            min-width: 120px;
            justify-content: center;
            transition: all var(--transition);
            vertical-align: middle;
        }
        .btn-add-cart:hover { transform: translateY(-1px); box-shadow: 0 6px 16px rgba(194,178,128,0.4); color: var(--espresso); }
        .btn-add-cart.added { background: linear-gradient(135deg, #2d7a4f, #3a9e65) !important; color: #fff !important; pointer-events: none; }
        .btn-add-cart .ripple { position: absolute; border-radius: 50%; background: rgba(255,255,255,0.4); transform: scale(0); animation: ripple-anim 0.6s linear; pointer-events: none; }
        @keyframes ripple-anim { to { transform: scale(4); opacity: 0; } }
        .btn-add-cart .btn-label-default,
        .btn-add-cart .btn-label-added { display: inline-flex; align-items: center; gap: 0.4rem; transition: opacity 0.2s ease, transform 0.2s ease; }
        .btn-add-cart .btn-label-added { position: absolute; opacity: 0; transform: translateY(8px); }
        .btn-add-cart.added .btn-label-default { opacity: 0; transform: translateY(-8px); }
        .btn-add-cart.added .btn-label-added { opacity: 1; transform: translateY(0); }
    </style>
</head>

<body>

    <!-- ═══ NAVBAR ═══════════════════════════════════════════════ -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="/Mindflayers/index.php">☕ Mindflayer<span class="dot">.</span></a>
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

    <main class="page-wrap">

        <p><a href="/Mindflayers/pages/ProductListPage/products.php" style="color:var(--text-light);">← Back to Menu</a> / <a href="/Mindflayers/index.php" style="color:var(--text-light);">Home</a> / <?= html($selectedProduct['name']) ?></p>

        <p>
            <?php if (!empty($selectedProduct['image'])): ?>
                <img src="/Mindflayers/pages/ProductListPage/<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>" style="width:100%;max-width:480px;display:block;margin-bottom:0.75rem;border-radius:4px;object-fit:cover;aspect-ratio:4/3;">
            <?php else: ?>
                <span style="font-size:5rem;display:block;margin-bottom:0.75rem;">☕</span>
            <?php endif; ?>
        </p>

        <p><strong><?= html($selectedProduct['badge']) ?></strong> — <?= html($selectedProduct['name']) ?> · <?= html($selectedProduct['tagline']) ?> · Rating: <?= number_format($selectedProduct['rating'], 1) ?>/5 (<?= html($selectedProduct['reviews']) ?> reviews) · Volume: <?= html($selectedProduct['volume']) ?> · Calories: <?= html($selectedProduct['calories']) ?> · Category: <?= html($selectedProduct['category']) ?> · Price: ₱<?= number_format($selectedProduct['price']) ?> (Philippine Peso, inclusive of taxes)</p>

        <p>
            <form method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="d-inline m-0" id="cart-form">
                <input type="hidden" name="product_id" value="<?= (int)$selectedProduct['id'] ?>">
                <button type="submit" class="btn-add-cart" id="btn-add-cart">
                    <span class="btn-label-default"><i class="bi bi-cart-fill"></i> Add to Cart</span>
                    <span class="btn-label-added"><i class="bi bi-check-circle-fill"></i> Added</span>
                </button>
            </form>
        </p>

        <p><?= html($selectedProduct['desc']) ?> Flavor tags: Cozy Flavor · Energy Boost · Feel Good · <?= html($selectedProduct['badge']) ?>. Origin: Ethically sourced beans · Prep Time: Made fresh to order · Packaging: Eco-friendly, compostable · Dine In: Free WiFi available.</p>

        <p>Specifications — <?php $specs = []; foreach ($selectedProduct['specs'] as $spec) { $specs[] = html($spec['label']) . ': ' . html($spec['value']); } echo implode(' · ', $specs); ?></p>

        <p>Taste Profile — Sweetness: 85% · Bitterness: 30% · Creaminess: 90% · Intensity: 60% · Tasting Notes: Creamy · Smooth · Sweet · Floral · Warm · Rich. Best enjoyed mid-morning or as an afternoon pick-me-up. Pairs well with our pastry selection.</p>

        <p>Delivery Info — Preparation Time: 5–10 minutes after order is placed. All drinks are made fresh to order, no pre-made batches. Delivery Estimate: 30–45 minutes for Metro Manila. Salcedo, BGC, and Poblacion branches offer 20-minute delivery windows. Packaging: All orders use eco-friendly, compostable cups and paper straws. No single-use plastics. Order Changes: Modifications accepted within 2 minutes of placing your order via the app or by calling the branch directly.</p>

        <p>At a Glance — Origin: Ethically sourced beans · Prep Time: Made fresh to order · Packaging: Eco-friendly, compostable · Dine In: Free WiFi available · All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery</p>

    </main>

    <footer style="background-color:var(--espresso);padding:4px 8px;">
        <span style="font-size:0.75rem;color:rgba(245,245,240,0.4);">Mindflayer. · All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery · <a href="#" style="color:rgba(245,245,240,0.4);">Privacy</a> · <a href="#" style="color:rgba(245,245,240,0.4);">Terms</a> · <a href="#" style="color:rgba(245,245,240,0.4);">Contact</a></span>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/auth.js"></script>
    <script>
        const cartForm = document.getElementById('cart-form');
        const btn = document.getElementById('btn-add-cart');

        cartForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!isLoggedIn()) {
                alert('You must be logged in first to add items to cart. Please log in to continue.');
                window.location.href = '../SignupPage/login.php';
                return;
            }

            if (btn.classList.contains('added')) return;

            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            const size = Math.max(btn.offsetWidth, btn.offsetHeight);
            ripple.style.cssText = `width:${size}px;height:${size}px;left:${btn.offsetWidth/2 - size/2}px;top:${btn.offsetHeight/2 - size/2}px`;
            btn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());

            btn.classList.add('added');

            fetch(cartForm.action, {
                method: cartForm.method,
                body: new FormData(cartForm),
                credentials: 'same-origin'
            }).catch(() => {});

            setTimeout(() => { btn.classList.remove('added'); }, 2000);
        });
    </script>
</body>

</html>