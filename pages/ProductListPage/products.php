<?php
// pages/ProductListPage/products_bad.php

require_once __DIR__ . '/products-data.php';

$active_cat = isset($_GET['cat']) ? $_GET['cat'] : 'All';
$filtered = $active_cat === 'All'
    ? $products
    : array_values(array_filter($products, fn($p) => $p['category'] === $active_cat));

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
if ($search !== '') {
    $filtered = array_values(array_filter($filtered, function ($p) use ($search) {
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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Menu</title>
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
            --text-dark: #2A1E1E;
            --text-mid: #6F4C3E;
            --text-muted: #9C8878;
            --font-serif: 'Playfair Display', Georgia, serif;
            --font-sans: 'DM Sans', sans-serif;
        }

        /* BAD: no box-sizing reset, inconsistent spacing throughout */
        body {
            font-family: var(--font-sans);
            background: var(--linen);
            color: var(--text-dark);
            margin: 0;
        }

        /* BAD: navbar crammed, no breathing room */
        .bad-nav {
            background: var(--espresso);
            padding: 3px 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2px;
        }

        .bad-nav-brand {
            font-family: var(--font-serif);
            font-size: 0.95rem;
            font-weight: 900;
            color: var(--cream);
            text-decoration: none;
        }

        /* BAD: nav links bunched together, barely readable */
        .bad-nav-links {
            display: flex;
            gap: 2px;
            flex-wrap: wrap;
            list-style: none;
            margin: 0; padding: 0;
        }
        .bad-nav-links a {
            color: var(--cream);
            font-size: 0.65rem;
            text-decoration: none;
            padding: 1px 3px;
        }

        .bad-nav-cta {
            background: var(--sand);
            color: var(--espresso);
            font-size: 0.65rem;
            padding: 2px 6px;
            text-decoration: none;
            font-weight: 600;
        }

        /* BAD: page header — small text, minimal spacing, no visual hierarchy */
        .bad-header {
            background: var(--espresso);
            padding: 6px 8px;
        }
        .bad-header p {
            color: var(--sand);
            font-size: 0.6rem;
            margin: 0;
            letter-spacing: 0.05em;
        }
        .bad-header h1 {
            font-family: var(--font-serif);
            font-size: 1rem;
            font-weight: 900;
            color: var(--linen);
            margin: 1px 0 2px;
            line-height: 1.1;
        }
        /* BAD: description buried in header, same visual weight as title */
        .bad-header .bad-desc {
            font-size: 0.65rem;
            color: rgba(245,245,240,0.55);
            margin: 0;
            line-height: 1.3;
        }

        /* BAD: filter bar and search crammed on one line, no separation from header */
        .bad-controls {
            background: #fff;
            border-bottom: 1px solid var(--cream);
            padding: 2px 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 3px;
            align-items: center;
        }

        /* BAD: filter tabs have no active indicator, look like plain text */
        .bad-filter-tab {
            font-size: 0.62rem;
            color: var(--text-muted);
            text-decoration: none;
            padding: 1px 4px;
            border: 1px solid transparent;
        }
        .bad-filter-tab.active {
            border-color: var(--mocha);
        }

        /* BAD: search with no placeholder guidance, squeezed size */
        .bad-search {
            font-size: 0.7rem;
            padding: 2px 5px;
            border: 1px solid #ccc;
            border-radius: 0;
            flex: 1;
            min-width: 80px;
            max-width: 160px;
        }

        /* BAD: result count squished right next to search */
        .bad-count {
            font-size: 0.6rem;
            color: var(--text-muted);
            white-space: nowrap;
        }

        /* BAD: products section — virtually no padding */
        .bad-products {
            padding: 4px 6px;
        }

        /* BAD: cards crammed together with tiny gap, no visual separation between categories */
        .bad-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
        }

        /* BAD: card is just a rectangle with no breathing room */
        .bad-card {
            background: #fff;
            border: 1px solid #ccc;
            width: calc(33.333% - 4px);
            min-width: 160px;
            flex: 1 1 160px;
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            cursor: pointer;
        }

        /* BAD: image area has no consistent aspect ratio, just a fixed height dump */
        .bad-img-wrap {
            width: 100%;
            height: 80px;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        .bad-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        /* BAD: placeholder is just the emoji, no context */
        .bad-img-ph {
            font-size: 2.5rem;
        }

        /* BAD: badge and category text both in the same corner, overlapping */
        .bad-badge {
            position: absolute;
            top: 2px; left: 2px;
            font-size: 0.5rem;
            background: var(--espresso);
            color: var(--cream);
            padding: 1px 4px;
        }
        .bad-cat {
            position: absolute;
            top: 2px; right: 2px;
            font-size: 0.5rem;
            background: rgba(245,245,240,0.85);
            color: var(--mocha);
            padding: 1px 4px;
        }

        /* BAD: card body — minimal padding, everything crammed */
        .bad-card-body {
            padding: 3px 5px;
            flex: 1;
        }

        /* BAD: name and tagline have almost no visual difference */
        .bad-card-name {
            font-size: 0.78rem;
            font-weight: 700;
            margin: 0 0 1px;
            color: var(--espresso);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .bad-card-tagline {
            font-size: 0.72rem;
            font-style: italic;
            color: var(--text-muted);
            margin: 0 0 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* BAD: dense paragraph dump of all info with no grouping or visual hierarchy */
        .bad-card-blob {
            font-size: 0.68rem;
            color: #555;
            margin: 0;
            line-height: 1.25;
        }

        /* BAD: footer — price and button crammed, no breathing room */
        .bad-card-footer {
            padding: 3px 5px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 3px;
        }

        /* BAD: price has no visual weight, same size as label */
        .bad-price-lbl {
            font-size: 0.55rem;
            color: var(--text-muted);
            display: block;
        }
        .bad-price-val {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--espresso);
        }
        .bad-price-sub {
            font-size: 0.55rem;
            color: var(--text-muted);
            display: block;
        }

        /* BAD: add to cart button — tiny, no affordance, unclear it's clickable */
        .bad-btn-cart {
            background: var(--espresso);
            color: var(--cream);
            font-size: 0.6rem;
            padding: 3px 7px;
            border: none;
            cursor: pointer;
            white-space: nowrap;
        }

        /* BAD: footer — all text crammed on one line, no padding, barely visible */
        .bad-footer {
            background: var(--espresso);
            padding: 3px 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .bad-footer-brand {
            font-family: var(--font-serif);
            font-size: 0.7rem;
            font-weight: 900;
            color: rgba(245,245,240,0.4);
        }
        .bad-footer-brand span { color: var(--sand); }
        .bad-footer-txt {
            font-size: 0.6rem;
            color: rgba(245,245,240,0.25);
        }
    </style>
</head>
<body>

<!-- BAD: Navbar — crammed, no spacing, hard to read -->
<div class="bad-nav">
    <a href="../../index.php" class="bad-nav-brand">☕ Mindflayer.</a>

    <ul class="bad-nav-links">
        <li><a href="./products.php">Menu</a></li>
        <li><a href="../AboutPage/about.php">Our Story</a></li>
        <li><a href="../../index.php#experience">Experience</a></li>
        <li><a href="../../index.php#contact">Locations</a></li>
        <li><a href="../ProfilePage/profile.php">Profile</a></li>
    </ul>

    <a href="../ShoppingCartPage/shoppingcart.php" class="bad-nav-cta">Cart <i class="bi bi-bag"></i></a>
</div>

<!-- BAD: Header — tiny text, no hierarchy, same visual weight throughout -->
<div class="bad-header">
    <p>Handcrafted Drinks</p>
    <h1>Our Signature Menu.</h1>
    <p class="bad-desc">Every drink is made to order with real ingredients, ethically sourced beans, and a little extra care. We offer espresso-based drinks, non-espresso alternatives, and cold brew options. Prices start at ₱170. All drinks available hot or iced unless otherwise stated.</p>
</div>

<!-- BAD: Controls — filter tabs and search crammed on same row, no breathing room -->
<div class="bad-controls">
    <?php
    $tab_icons = ['All'=>'bi-grid-fill','Espresso'=>'bi-cup-hot','Non-Espresso'=>'bi-cup-straw','Cold Brew'=>'bi-snow'];
    foreach ($categories as $cat):
        $is_active = $active_cat === $cat;
        $cnt = $cat === 'All' ? count($products) : ($cat_counts[$cat] ?? 0);
    ?>
    <a href="?cat=<?= urlencode($cat) ?>" class="bad-filter-tab <?= $is_active ? 'active' : '' ?>">
        <?= htmlspecialchars($cat) ?>(<?= $cnt ?>)
    </a>
    <?php endforeach; ?>

    <!-- BAD: Search with no helpful placeholder text -->
    <form method="get" style="display:flex;align-items:center;gap:2px;">
        <?php if ($active_cat !== 'All'): ?>
            <input type="hidden" name="cat" value="<?= htmlspecialchars($active_cat) ?>">
        <?php endif; ?>
        <input type="search" name="q"
               value="<?= htmlspecialchars($search) ?>"
               class="bad-search"
               placeholder="Search...">
        <button type="submit" style="font-size:0.6rem;padding:2px 5px;border:1px solid #ccc;background:#fff;cursor:pointer;">Go</button>
    </form>

    <!-- BAD: count label and filter crammed together with no separation -->
    <span class="bad-count">
        <?= count($filtered) ?> result<?= count($filtered) !== 1 ? 's' : '' ?>
        <?= $active_cat !== 'All' ? '- ' . htmlspecialchars($active_cat) : '' ?>
        <?= $search ? '("' . htmlspecialchars($search) . '")' : '' ?>
    </span>
</div>

<!-- BAD: Products — minimal padding, no section spacing, all crammed -->
<main>
    <div class="bad-products">

        <!-- BAD: no section labels, no category grouping, all products dumped in one blob -->
        <div class="bad-grid">
            <?php foreach ($filtered as $i => $p): ?>
            <div class="bad-card">
                <a href="../ProductDetailsPage/productdetails.php?id=<?= (int)$p['id'] ?>" class="bad-card-link" style="text-decoration:none;color:inherit;display:flex;flex-direction:column;flex:1;">
                <!-- Image — fixed tiny height, no consistent ratio -->
                <div class="bad-img-wrap">
                    <?php if (file_exists(__DIR__ . '/' . $p['image'])): ?>
                        <img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>" />
                    <?php else: ?>
                        <span class="bad-img-ph"><?= $p['emoji'] ?? '☕' ?></span>
                    <?php endif; ?>
                    <span class="bad-badge"><?= htmlspecialchars($p['badge']) ?></span>
                    <span class="bad-cat"><?= htmlspecialchars($p['category']) ?></span>
                </div>

                <!-- BAD: body — name, tagline, then ALL info dumped as a single dense paragraph -->
                <div class="bad-card-body">
                    <p class="bad-card-name"><?= htmlspecialchars($p['name']) ?></p>
                    <p class="bad-card-tagline"><?= htmlspecialchars($p['tagline'] ?? '') ?></p>

                    <!-- BAD: dense paragraph — specs, volume, rating all dumped as one unstructured blob -->
                    <p class="bad-card-blob">
                        <?= htmlspecialchars($p['volume'] ?? '') ?> · <?= htmlspecialchars($p['category']) ?> · Rating: <?= $p['rating'] ?? '' ?>/5 (<?= $p['reviews'] ?? '' ?> reviews) · <?= htmlspecialchars($p['calories'] ?? '') ?> · <?= htmlspecialchars($p['specs'][0]['value'] ?? '') ?>, <?= htmlspecialchars($p['specs'][1]['value'] ?? '') ?>, Milk: <?= htmlspecialchars($p['specs'][2]['value'] ?? '') ?>, Caffeine: <?= htmlspecialchars($p['specs'][3]['value'] ?? '') ?>
                    </p>
                </div>
                </a>

                <!-- BAD: footer crammed, price barely distinguishable, button tiny -->
                <div class="bad-card-footer">
                    <div>
                        <span class="bad-price-lbl">Starting at</span>
                        <span class="bad-price-val">₱<?= number_format($p['price']) ?></span>
                        <span class="bad-price-sub"><?= $p['volume'] ?? '' ?></span>
                    </div>
                    <form method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="m-0">
                        <input type="hidden" name="product_id" value="<?= (int)$p['id'] ?>">
                        <!-- BAD: button has no visual affordance, tiny text, no icon -->
                        <button type="submit" class="bad-btn-cart">Add to Cart</button>
                    </form>
                </div>

            </div>
            <?php endforeach; ?>
        </div>

    </div>
</main>

<!-- BAD: Footer — crammed, barely visible, no padding -->
<div class="bad-footer">
    <span class="bad-footer-brand">Mindflayer<span>.</span></span>
    <span class="bad-footer-txt">All prices in Philippine Peso (₱) · Dine In · Takeaway · Delivery</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/auth.js"></script>
<script>
    document.querySelectorAll('.bad-btn-cart').forEach(btn => {
        btn.closest('form').addEventListener('submit', function(e) {
            e.preventDefault(); e.stopPropagation();
            if (!isLoggedIn()) {
                alert('You must be logged in first to add items to cart. Please log in to continue.');
                window.location.href = '../SignupPage/login.php';
                return;
            }
            const formData = new FormData(this);
            fetch(this.action, { method: this.method, body: formData, credentials: 'same-origin' })
                .catch(() => {});
            btn.textContent = 'Added';
            setTimeout(() => { btn.textContent = 'Add to Cart'; }, 2000);
        });
    });
</script>

</body>
</html>