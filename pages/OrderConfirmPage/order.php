<?php
// Mindflayer Coffee — Order Confirmation Page
$shop_name = "Mindflayer";

// Check if we have order data (from checkout POST)
$has_order = ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['fullName']));

// Order summary (matches checkout defaults; in production this would come from cart/db)
$order_items = "3 × Signature drinks";
$order_subtotal = "₱540";
$order_delivery = "₱60";
$order_promo = "-₱60";
$order_total = "₱540";
$order_id = "MF-" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));

// Estimated delivery: 45–60 min from now (Philippine Time)
$now      = new DateTime('now', new DateTimeZone('Asia/Manila'));
$eta_from = clone $now;
$eta_from->modify('+45 minutes');
$eta_to   = clone $now;
$eta_to->modify('+60 minutes');
$eta_date  = $eta_from->format('F j, Y');
$eta_range = $eta_from->format('g:i A') . ' – ' . $eta_to->format('g:i A');

// Customer data from POST
$fullName = htmlspecialchars($_POST['fullName'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$address = htmlspecialchars($_POST['address'] ?? '');
$city = htmlspecialchars($_POST['city'] ?? '');
$postal = htmlspecialchars($_POST['postal'] ?? '');
$deliveryNotes = htmlspecialchars($_POST['deliveryNotes'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $shop_name ?> · Order Confirmed</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
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
            --text-dark: #2A1E1E;
            --text-mid: #6F4C3E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            --transition: 0.3s ease;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        .navbar {
            background-color: var(--espresso);
            padding: 2px 4px;
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 5px solid rgba(194, 178, 128, 0.2);
        }

        .navbar-brand {
            font-family: var(--font-display);
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 8rem;
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

        .btn-nav-cta {
            background-color: var(--sand);
            color: var(--espresso) !important;
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.5rem 1.4rem !important;
            border-radius: 2px;
            border: none;
            transition: background var(--transition), transform var(--transition);
        }

        .btn-nav-cta:hover {
            background-color: var(--cream);
            transform: translateY(-1px);
        }

        @media (max-width: 991.98px) {
            .navbar {
                padding: 0.9rem 1.5rem;
            }
        }

        .confirm-wrapper {
            max-width: 100%;
            margin: 0;
            padding: 4px 8px;
            line-height: 1.2;
        }

        .confirm-card {
            background-color: var(--white);
            border: none;
            border-radius: 0;
            box-shadow: none;
            padding: 4px 0;
        }

        .success-icon {
            width: 16px;
            height: 16px;
            border-radius: 0;
            background: transparent;
            color: var(--text-light);
            display: inline;
            font-size: 0.8rem;
            margin: 0 4px 0 0;
            opacity: 0.7;
        }

        .confirm-heading {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            display: inline;
            color: var(--text-light);
            margin: 0 4px 0 0;
        }

        .confirm-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
            margin: 0;
            display: inline;
        }

        .order-id-badge {
            display: inline;
            margin: 0 0 0 4px;
            font-size: 0.85rem;
            font-weight: 400;
            color: var(--text-light);
        }

        .eta-banner {
            display: inline;
            margin: 0;
            padding: 0;
        }

        .eta-icon {
            font-size: 0.85rem;
            color: var(--mocha);
        }

        .eta-label,
        .eta-time,
        .eta-date {
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .details-section {
            margin: 0;
            padding: 0;
            border: none;
        }

        .details-title {
            font-size: 0.9rem;
            color: var(--text-light);
            margin: 0;
            display: inline;
        }

        .details-row {
            font-size: 0.9rem;
            color: var(--text-light);
            margin: 0;
            display: inline;
        }

        .details-row strong {
            font-weight: 400;
            color: var(--text-light);
        }

        .details-row::after {
            content: " · ";
        }

        .order-summary-box {
            margin: 0;
            padding: 0;
            border: none;
            display: inline;
        }

        .order-summary-row {
            display: inline;
            margin: 0;
            font-size: 0.9rem;
            color: var(--text-light);
        }

        .order-summary-row::after {
            content: " · ";
        }

        .order-summary-row.total::after {
            content: "";
        }

        .order-summary-row.total {
            font-weight: 400;
            color: var(--text-light);
        }

        .btn-back-home {
            background: transparent;
            color: var(--text-light);
            border: none;
            padding: 0;
            font-size: 0.85rem;
            font-weight: 400;
            margin: 0 0 0 4px;
            display: inline;
        }

        .btn-back-home:hover {
            color: var(--text-light);
            background: transparent;
        }

        .email-plain {
            font-weight: 400;
            color: var(--text-light);
        }

        .empty-state {
            padding: 4px 0;
        }

        .checkout-steps {
            display: inline;
            margin: 0;
            padding: 0;
        }

        .checkout-steps::before {
            display: none;
        }

        .checkout-step {
            display: inline;
            margin: 0 2px 0 0;
        }

        .step-circle {
            width: 16px;
            height: 16px;
            font-size: 0.65rem;
            display: inline-flex;
            vertical-align: middle;
        }

        .step-label {
            display: inline;
            margin: 0 8px 0 0;
            font-size: 0.7rem;
        }

        .dense-block {
            margin: 0;
            padding: 4px 8px;
            line-height: 1.3;
        }

        .dense-block p,
        .dense-block div {
            margin: 0 0 2px 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">
                ☕ <?= $shop_name ?><span class="dot">.</span>
            </a>

            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="text-warning bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="gap-1 mx-auto navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../../index.php#contact">Locations</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../pages/ProfilePage/profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../pages/ProductListPage/products.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../index.php#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../pages/AboutPage/about.php">Our Story</a></li>
                </ul>
                <div class="d-flex align-items-center gap-2">
                    <a href="../../pages/ProductListPage/products.php" class="btn-nav-cta nav-link">
                        Order Now <i class="bi-arrow-right ms-1 bi"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="confirm-wrapper">
        <div class="confirm-card dense-block">
        <?php if ($has_order): ?>
            <p><span class="success-icon"><i class="bi bi-check-lg"></i></span><span class="confirm-heading">Order Confirmed!</span><span class="confirm-subtitle">Thank you for your order. We're already brewing your drinks.</span><span class="order-id-badge">Order #<?= $order_id ?></span><span class="eta-banner"><i class="bi bi-clock eta-icon"></i><span class="eta-label">Estimated Delivery</span> <span class="eta-time"><?= $eta_range ?></span><span class="eta-date"> <?= $eta_date ?></span></span></p>
            <p><span class="details-title">Delivery Details</span><span class="details-row"><strong><?= $fullName ?></strong></span><span class="details-row"><?= $email ?></span><span class="details-row"><?= $phone ?></span><span class="details-row"><?= $address ?>, <?= $city ?> <?= $postal ?></span><?php if ($deliveryNotes): ?><span class="details-row"><em>Note: <?= $deliveryNotes ?></em></span><?php endif; ?><span class="details-title">Order Summary</span><span class="order-summary-box"><span class="order-summary-row"><?= $order_items ?> <?= $order_subtotal ?></span><span class="order-summary-row">Delivery <?= $order_delivery ?></span><span class="order-summary-row">Promo (FREEDELIVERY) <?= $order_promo ?></span><span class="order-summary-row total">Total <?= $order_total ?></span></span></p>
            <p>A confirmation email has been sent to <span class="email-plain"><?= $email ?></span> <a href="../../index.php" class="btn btn-back-home">Back to Home</a></p>
        <?php else: ?>
            <p><span class="success-icon"><i class="bi bi-cart-x"></i></span><span class="confirm-heading">No Order Found</span><span class="confirm-subtitle">You arrived here without completing a checkout. Start an order from our shop.</span><a href="../../index.php" class="btn btn-back-home">Browse Menu</a><a href="../CheckoutPage/checkout.php" class="btn btn-back-home">Go to Checkout</a></p>
        <?php endif; ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>