<?php
// MindFlayer Coffee — Shopping Cart Page
session_start();

require_once __DIR__ . '/../ProductListPage/products-data.php';

function wants_json(): bool
{
    $accept = $_SERVER['HTTP_ACCEPT'] ?? '';
    $xrw = $_SERVER['HTTP_X_REQUESTED_WITH'] ?? '';
    return (stripos($accept, 'application/json') !== false) || (strtolower($xrw) === 'xmlhttprequest');
}

function json_response(array $data, int $statusCode = 200): void
{
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle cart mutations (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && wants_json()) {
    $action = (string) $_POST['action'];

    if ($action === 'remove') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $_SESSION['cart'] = array_values(array_filter($_SESSION['cart'], function ($item) use ($productId) {
            return (int)($item['id'] ?? 0) !== $productId;
        }));
        json_response(['ok' => true, 'cart' => array_values($_SESSION['cart'])]);
    }

    if ($action === 'set_qty') {
        $productId = (int) ($_POST['product_id'] ?? 0);
        $qty = (int) ($_POST['qty'] ?? 1);
        $qty = max(1, $qty);

        foreach ($_SESSION['cart'] as &$item) {
            if ((int) ($item['id'] ?? 0) === $productId) {
                $item['qty'] = $qty;
                break;
            }
        }
        unset($item);

        json_response(['ok' => true, 'cart' => array_values($_SESSION['cart'])]);
    }

    json_response(['ok' => false, 'error' => 'Unknown action'], 400);
}

// Handle "Add to cart" POST (form or AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id']) && !isset($_POST['action'])) {
    $productId = (int) $_POST['product_id'];

    foreach ($products as $product) {
        if ((int) $product['id'] === $productId) {
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ((int) ($item['id'] ?? 0) === $productId) {
                    $item['qty'] = (int) ($item['qty'] ?? 1) + 1;
                    $found = true;
                    break;
                }
            }
            unset($item);

            if (!$found) {
                $_SESSION['cart'][] = [
                    'id'     => (int) $product['id'],
                    'name'   => (string) $product['name'],
                    'emoji'  => (string) ($product['emoji'] ?? '☕'),
                    'badge'  => (string) ($product['badge'] ?? 'Drink'),
                    'size'   => (string) ($product['volume'] ?? '12 oz'),
                    'milk'   => 'Whole milk',
                    'temp'   => 'Hot',
                    'price'  => (float) $product['price'],
                    'qty'    => 1,
                ];
            }

            break;
        }
    }

    if (wants_json()) {
        json_response(['ok' => true, 'cart' => array_values($_SESSION['cart'])]);
    }

    // Redirect to avoid resubmission on refresh
    header('Location: /Mindflayers/pages/ShoppingCartPage/shoppingcart.php');
    exit;
}

$sessionCart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart — Mindflayer Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --danger: #C0392B;
            --muted: #A18A7A;
            --success: #27AE60;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            --transition: 0.28s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: radial-gradient(circle at top left, #f1e7d6 0, #f5f5f0 40%, #e8d8b0 100%);
            font-family: var(--font-body);
            color: var(--espresso);
            display: flex;
            flex-direction: column;
        }

        /* Navbar (matches homepage look) */
        .navbar {
            background-color: var(--espresso);
            padding: 1.1rem 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
        }

        .navbar-brand {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand span.dot {
            color: var(--sand);
        }

        .navbar-nav .nav-link {
            color: rgba(232, 216, 176, 0.75) !important;
            font-size: 0.88rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 1rem !important;
            transition: color var(--transition);
        }

        .navbar-nav .nav-link:hover {
            color: var(--cream) !important;
        }

        .navbar-nav .nav-link.active {
            color: var(--cream) !important;
        }

        .btn-nav-cta {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso) !important;
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.6rem 1.7rem !important;
            border-radius: 2px;
            border: none;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 26px rgba(194, 178, 128, 0.28);
            transition: transform var(--transition), box-shadow var(--transition), filter var(--transition);
        }

        .btn-nav-cta::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.16);
            transform: translateX(-110%);
            transition: transform 0.45s ease;
        }

        .btn-nav-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 34px rgba(194, 178, 128, 0.45);
            filter: saturate(1.05);
        }

        .btn-nav-cta:hover::after {
            transform: translateX(0);
        }

        .cart-shell {
            max-width: 1120px;
            margin: 2rem auto 3rem;
            padding: 1.5rem;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .cart-title {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 2.5vw, 2.3rem);
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-title span.badge-soft {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.14em;
            background: rgba(63, 42, 42, 0.06);
            padding: 0.25rem 0.7rem;
            border-radius: 999px;
            color: var(--muted);
        }

        .cart-header-meta {
            text-align: right;
            font-size: 0.9rem;
            color: var(--muted);
        }

        .btn-back-menu {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            border-radius: 999px;
            border: 1px solid rgba(111, 76, 62, 0.22);
            background: rgba(255, 255, 255, 0.86);
            color: var(--mocha);
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.55rem 1rem;
            text-decoration: none;
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
            margin-bottom: 0.55rem;
        }

        .btn-back-menu:hover {
            transform: translateY(-1px);
            background: #fff;
            box-shadow: 0 10px 18px rgba(42, 22, 8, 0.12);
        }

        /* Layout: list + summary */
        .cart-layout {
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(260px, 1.2fr);
            gap: 1.5rem;
        }

        @media (max-width: 900px) {
            .cart-shell {
                padding-inline: 1rem;
            }

            .cart-layout {
                grid-template-columns: minmax(0, 1fr);
            }
        }

        /* Cart list */
        .cart-list {
            display: flex;
            flex-direction: column;
            gap: 0.9rem;
        }

        .cart-item-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
        }

        /* Swipeable background actions (remove / save) */
        .cart-item-actions-bg {
            position: absolute;
            inset: 0;
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            pointer-events: none;
        }

        .cart-item-actions-bg button {
            width: 96px;
            border: none;
            outline: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            color: var(--white);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            pointer-events: auto;
        }

        .bg-remove {
            background: linear-gradient(135deg, var(--danger), #8E1B0E);
        }

        .bg-save {
            background: linear-gradient(135deg, #2E7D32, var(--success));
        }

        /* Foreground card (clipped, draggable) */
        .cart-item-card {
            background: rgba(255, 255, 255, 0.96);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            box-shadow:
                0 18px 30px rgba(42, 22, 8, 0.08),
                0 0 0 1px rgba(255, 255, 255, 0.6);
            padding: 0.9rem 1.05rem;
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            gap: 0.8rem;
            align-items: center;
            transform: translateX(0);
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
            cursor: grab;
        }

        .cart-item-card:active {
            cursor: grabbing;
        }

        .cart-item-thumb {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            background: radial-gradient(circle at 20% 0, #fff 0, #f2e3d2 40%, #c2b280 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
        }

        .cart-item-main {
            display: flex;
            flex-direction: column;
            gap: 0.2rem;
            min-width: 0;
        }

        .cart-item-name-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .cart-item-name {
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .cart-item-badge {
            font-size: 0.7rem;
            padding: 0.1rem 0.5rem;
            border-radius: 999px;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            background: rgba(111, 76, 62, 0.06);
            color: var(--muted);
        }

        .cart-item-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            font-size: 0.8rem;
            color: var(--muted);
        }

        .meta-dot {
            width: 4px;
            height: 4px;
            border-radius: 999px;
            background: rgba(161, 138, 122, 0.7);
        }

        /* Visible action buttons (edit/remove) */
        .cart-item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 0.4rem;
        }

        .price-tag {
            font-weight: 600;
            font-size: 0.95rem;
        }

        .qty-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.1rem 0.45rem;
            border-radius: 999px;
            background: rgba(111, 76, 62, 0.06);
            font-size: 0.75rem;
            color: var(--muted);
        }

        .qty-pill button {
            border: none;
            background: transparent;
            color: var(--mocha);
            padding: 0;
            line-height: 1;
        }

        .cart-item-cta-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-icon-soft {
            border-radius: 999px;
            border: 1px solid rgba(111, 76, 62, 0.18);
            background: rgba(255, 255, 255, 0.92);
            min-width: 68px;
            height: 34px;
            padding: 0 0.65rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--mocha);
            text-transform: uppercase;
            letter-spacing: 0.08em;
            transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        }

        .btn-icon-soft .bi {
            font-size: 0.95rem;
        }

        .btn-icon-soft:hover {
            background: #f6efe4;
            transform: translateY(-1px);
            box-shadow: 0 8px 14px rgba(42, 22, 8, 0.14);
        }

        .btn-icon-soft.btn-remove {
            color: var(--danger);
            border-color: rgba(192, 57, 43, 0.38);
        }

        .btn-icon-soft.btn-edit {
            color: #4f3a2f;
            border-color: rgba(111, 76, 62, 0.35);
        }

        .qty-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            border-radius: 999px;
            background: rgba(111, 76, 62, 0.08);
            border: 1px solid rgba(111, 76, 62, 0.2);
            padding: 0.25rem 0.35rem;
        }

        .qty-pill button {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid rgba(111, 76, 62, 0.2);
            background: #fff;
            color: var(--mocha);
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform var(--transition), background var(--transition);
        }

        .qty-pill button:hover {
            transform: scale(1.05);
            background: #fdf5ec;
        }

        .qty-pill .js-qty-value {
            min-width: 22px;
            text-align: center;
            font-weight: 700;
            color: var(--espresso);
        }

        .btn-icon-soft:hover {
            background: #f3ebe0;
            transform: translateY(-1px);
            box-shadow: 0 8px 14px rgba(42, 22, 8, 0.12);
        }

        .btn-icon-soft.btn-remove {
            color: var(--danger);
            border-color: rgba(192, 57, 43, 0.3);
        }

        .empty-state {
            padding: 2.5rem 1.8rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.9);
            border: 1px dashed rgba(161, 138, 122, 0.45);
            text-align: center;
            color: var(--muted);
        }

        /* Summary panel */
        .summary-card {
            background: #13100f;
            color: #fefaf5;
            border-radius: 20px;
            padding: 1.4rem 1.3rem 1.5rem;
            box-shadow:
                0 18px 30px rgba(12, 8, 2, 0.6),
                0 0 0 1px rgba(255, 255, 255, 0.04);
            position: sticky;
            top: 1rem;
        }

        .summary-title {
            font-family: var(--font-display);
            font-size: 1.25rem;
            margin-bottom: 0.4rem;
        }

        .summary-sub {
            font-size: 0.85rem;
            color: rgba(245, 235, 220, 0.7);
            margin-bottom: 1rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-bottom: 0.45rem;
        }

        .summary-row.total {
            margin-top: 0.5rem;
            padding-top: 0.65rem;
            border-top: 1px dashed rgba(250, 244, 235, 0.3);
            font-weight: 600;
        }

        .summary-row.total span:last-child {
            font-size: 1rem;
        }

        .summary-chip-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.35rem;
            margin: 0.75rem 0 0.9rem;
        }

        .summary-chip {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.18em;
            padding: 0.2rem 0.7rem;
            border-radius: 999px;
            border: 1px solid rgba(245, 235, 220, 0.32);
            color: rgba(245, 235, 220, 0.85);
        }

        .btn-checkout {
            width: 100%;
            border-radius: 999px;
            border: none;
            padding: 0.7rem 1.2rem;
            background: linear-gradient(135deg, var(--sand), #f0e4c0);
            color: #231712;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.16em;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            box-shadow:
                0 16px 30px rgba(10, 6, 3, 0.8),
                0 0 0 1px rgba(255, 255, 255, 0.3);
            transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
        }

        .btn-checkout:hover {
            transform: translateY(-1px);
            box-shadow:
                0 22px 36px rgba(10, 6, 3, 0.9),
                0 0 0 1px rgba(255, 255, 255, 0.4);
            background: linear-gradient(135deg, #f5e4b8, #f8f1d4);
        }

        .btn-checkout:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            box-shadow: none;
        }

        .summary-footer-note {
            margin-top: 0.8rem;
            font-size: 0.75rem;
            color: rgba(245, 235, 220, 0.7);
        }
    </style>
</head>

<body>
    <!-- Navbar (Back to Product List) -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">
                ☕ Mindflayer<span class="dot">.</span>
            </a>

            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMainCart" aria-controls="navMainCart" aria-expanded="false" aria-label="Toggle navigation">
                <i class="text-warning bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMainCart">
                <ul class="gap-1 mx-auto navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../ProductListPage/products.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="../AboutPage/about.php">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="../ProfilePage/profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link active" href="./shoppingcart.php">Shopping Cart</a></li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <a href="../ProductListPage/products.php" class="nav-link" style="font-size: 0.85rem;">
                        Back to Menu
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="cart-shell">
        <header class="cart-header">
            <div>
                <h1 class="cart-title">
                    Your Cart
                    <span class="badge-soft">Actions: Edit / Remove / Quantity</span>
                </h1>
            </div>
            <div class="cart-header-meta">
                <a class="btn-back-menu" href="../ProductListPage/products.php" aria-label="Back to Menu">
                    <i class="bi-arrow-left bi"></i> Back to Menu
                </a>
                <div class="fw-semibold">
                    <span id="cart-count-label">0 items</span> in your order
                </div>
                <div class="small">Drag left/right or use the edit / remove buttons.</div>
            </div>
        </header>

        <section class="cart-layout">
            <div>
                <div id="cart-list" class="cart-list"></div>
                <div id="cart-empty" class="empty-state d-none">
                    <h2 class="mb-2 h5">Your cart is empty</h2>
                    <p class="mb-3">
                        Add a drink from the menu to see it here. Use the cart to tweak quantities and quickly tidy up your order.
                    </p>
                    <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn-outline-dark btn btn-sm">
                        <i class="me-1 bi bi-cup-hot"></i>
                        Back to menu
                    </a>
                </div>
            </div>

            <aside class="summary-card">
                <h2 class="summary-title">Order Summary</h2>
                <p class="mb-2 summary-sub">
                    Prices include taxes. Free cup sleeve for hot drinks.
                </p>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">₱0</span>
                </div>
                <div class="summary-row">
                    <span>Estimated tax</span>
                    <span id="summary-tax">₱0</span>
                </div>
                <div class="summary-row">
                    <span>Service fee</span>
                    <span id="summary-fee">₱0</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="summary-total">₱0</span>
                </div>

                <div class="summary-chip-row">
                    <span class="summary-chip">Tap buttons to edit or remove</span>
                    <span class="summary-chip">Free pickup in-store</span>
                </div>

                <button id="btn-checkout" class="btn-checkout" disabled>
                    Proceed to checkout
                    <i class="bi-arrow-right-short bi fs-5"></i>
                </button>

                <p class="mb-0 summary-footer-note">
                    You can still adjust your cart on the checkout screen before paying.
                </p>
            </aside>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cart data hydrated from PHP session
        const initialCart = <?php echo json_encode(array_values($sessionCart), JSON_UNESCAPED_UNICODE); ?>;
        let cart = Array.isArray(initialCart) ? [...initialCart] : [];

        const cartListEl = document.getElementById('cart-list');
        const cartEmptyEl = document.getElementById('cart-empty');
        const cartCountLabel = document.getElementById('cart-count-label');
        const subtotalEl = document.getElementById('summary-subtotal');
        const taxEl = document.getElementById('summary-tax');
        const feeEl = document.getElementById('summary-fee');
        const totalEl = document.getElementById('summary-total');
        const btnCheckout = document.getElementById('btn-checkout');

        function formatPeso(value) {
            return '₱' + value.toLocaleString('en-PH', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        function updateSummary() {
            const subtotal = cart.reduce((sum, item) => sum + item.price * item.qty, 0);
            const tax = Math.round(subtotal * 0.12);
            const fee = subtotal > 0 ? 10 : 0;
            const total = subtotal + tax + fee;

            subtotalEl.textContent = formatPeso(subtotal);
            taxEl.textContent = formatPeso(tax);
            feeEl.textContent = formatPeso(fee);
            totalEl.textContent = formatPeso(total);

            const itemCount = cart.reduce((sum, item) => sum + item.qty, 0);
            cartCountLabel.textContent = `${itemCount} item${itemCount === 1 ? '' : 's'}`;
            btnCheckout.disabled = cart.length === 0;

            cartListEl.classList.toggle('d-none', cart.length === 0);
            cartEmptyEl.classList.toggle('d-none', cart.length !== 0);
        }

        function renderCart() {
            cartListEl.innerHTML = '';

            cart.forEach(item => {
                const wrapper = document.createElement('div');
                wrapper.className = 'cart-item-wrapper';
                wrapper.dataset.id = item.id;

                const bg = document.createElement('div');
                bg.className = 'cart-item-actions-bg';
                bg.innerHTML = `
                    <button class="bg-remove js-remove">
                        <i class="bi bi-trash3"></i>
                        <span>Remove</span>
                    </button>
                    <button class="bg-save js-save">
                        <i class="bi bi-bookmark-heart"></i>
                        <span>Save</span>
                    </button>
                `;

                const card = document.createElement('article');
                card.className = 'cart-item-card';
                card.innerHTML = `
                    <div class="cart-item-thumb">
                        <span>${item.emoji || '☕'}</span>
                    </div>
                    <div class="cart-item-main">
                        <div class="cart-item-name-row">
                            <div class="text-truncate cart-item-name">${item.name}</div>
                            ${item.badge ? `<span class="cart-item-badge">${item.badge}</span>` : ''}
                        </div>
                        <div class="cart-item-meta">
                            <span>${item.size}</span>
                            <span class="meta-dot"></span>
                            <span>${item.milk}</span>
                            <span class="meta-dot"></span>
                            <span>${item.temp}</span>
                        </div>
                        <div class="qty-pill" role="group" aria-label="Quantity stepper">
                            <button class="js-qty-dec" type="button" aria-label="Decrease quantity">
                                <i class="bi bi-dash"></i>
                            </button>
                            <span class="js-qty-value" aria-live="polite">${item.qty}</span>
                            <button class="js-qty-inc" type="button" aria-label="Increase quantity">
                                <i class="bi bi-plus"></i>
                            </button>
                        </div>
                        <small class="text-muted" style="font-size:0.72rem; margin-top:0.2rem; display:inline-block;">
                            Use − / + to adjust quantity without typing.
                        </small>
                    </div>
                    <div class="cart-item-actions">
                        <div class="price-tag">${formatPeso(item.price * item.qty)}</div>
                        <div class="cart-item-cta-row">
                            <button class="btn-icon-soft btn-edit js-edit" type="button" title="Edit item">
                                <i class="bi bi-pencil"></i>
                                <span>Edit</span>
                            </button>
                            <button class="btn-icon-soft btn-remove js-remove" type="button" title="Remove item">
                                <i class="bi bi-trash"></i>
                                <span>Remove</span>
                            </button>
                        </div>
                    </div>
                `;

                wrapper.appendChild(bg);
                wrapper.appendChild(card);
                cartListEl.appendChild(wrapper);

                attachSwipeHandlers(wrapper, card, item.id);
            });

            updateSummary();
        }

        function removeItem(id) {
            cart = cart.filter(item => item.id !== id);
            renderCart();

            const fd = new FormData();
            fd.set('action', 'remove');
            fd.set('product_id', String(id));
            fetch('/Mindflayers/pages/ShoppingCartPage/shoppingcart.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: fd,
                credentials: 'same-origin',
            }).catch(() => {});
        }

        function changeQty(id, delta) {
            cart = cart
                .map(item => item.id === id ? {
                    ...item,
                    qty: Math.max(1, item.qty + delta)
                } : item);
            renderCart();

            const updated = cart.find(item => item.id === id);
            if (!updated) return;
            const fd = new FormData();
            fd.set('action', 'set_qty');
            fd.set('product_id', String(id));
            fd.set('qty', String(updated.qty));
            fetch('/Mindflayers/pages/ShoppingCartPage/shoppingcart.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: fd,
                credentials: 'same-origin',
            }).catch(() => {});
        }

        function attachSwipeHandlers(wrapper, card, id) {
            let startX = 0;
            let currentX = 0;
            let isDragging = false;

            const handleStart = (clientX) => {
                startX = clientX;
                currentX = clientX;
                isDragging = true;
                card.style.transition = 'none';
            };

            const handleMove = (clientX) => {
                if (!isDragging) return;
                currentX = clientX;
                const deltaX = currentX - startX;
                const limited = Math.max(-96, Math.min(96, deltaX));
                card.style.transform = `translateX(${limited}px)`;
            };

            const handleEnd = () => {
                if (!isDragging) return;
                isDragging = false;
                const deltaX = currentX - startX;
                card.style.transition = 'transform var(--transition)';

                if (deltaX <= -60) {
                    // Intention: remove
                    card.style.transform = 'translateX(-110%)';
                    setTimeout(() => removeItem(id), 220);
                } else if (deltaX >= 60) {
                    // Intention: save for later (for now, just remove)
                    card.style.transform = 'translateX(110%)';
                    setTimeout(() => removeItem(id), 220);
                } else {
                    card.style.transform = 'translateX(0)';
                }
            };

            // Mouse events
            card.addEventListener('mousedown', (e) => handleStart(e.clientX));
            window.addEventListener('mousemove', (e) => handleMove(e.clientX));
            window.addEventListener('mouseup', handleEnd);

            // Touch events
            card.addEventListener('touchstart', (e) => {
                const touch = e.touches[0];
                if (!touch) return;
                handleStart(touch.clientX);
            }, {
                passive: true
            });

            card.addEventListener('touchmove', (e) => {
                const touch = e.touches[0];
                if (!touch) return;
                handleMove(touch.clientX);
            }, {
                passive: true
            });

            card.addEventListener('touchend', handleEnd);
            card.addEventListener('touchcancel', handleEnd);

            // Click handlers for visible buttons
            wrapper.addEventListener('click', (e) => {
                const target = e.target.closest('button');
                if (!target) return;

                if (target.classList.contains('js-remove')) {
                    removeItem(id);
                } else if (target.classList.contains('js-qty-inc')) {
                    changeQty(id, 1);
                } else if (target.classList.contains('js-qty-dec')) {
                    changeQty(id, -1);
                } else if (target.classList.contains('js-edit')) {
                    alert('Edit options coming soon — e.g., milk, size, sweetness.');
                } else if (target.classList.contains('js-save')) {
                    alert('Save for later coming soon.');
                }
            });
        }

        btnCheckout.addEventListener('click', () => {
            // Hook this into your checkout flow (e.g., redirect to CheckoutPage/checkout.php)
            window.location.href = '../CheckoutPage/checkout.php';
        });

        renderCart();
    </script>
</body>

</html>