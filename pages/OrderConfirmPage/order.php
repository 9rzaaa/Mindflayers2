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
        }

        a {
            text-decoration: none;
        }

        .navbar {
            background-color: var(--espresso);
            padding: 1.1rem 2.5rem;
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
            max-width: 640px;
            margin: 2.5rem auto;
            padding: 0 1.25rem 3rem;
        }

        .confirm-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.09);
            border: 1px solid rgba(194, 178, 128, 0.25);
            padding: 2rem 1.8rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .confirm-card {
                padding: 2.5rem 3rem;
            }
        }

        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: transparent;
            color: rgba(194, 178, 128, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.25rem;
            box-shadow: none;
        }

        .confirm-heading {
            font-family: var(--font-body);
            font-size: 1.1rem;
            font-weight: 400;
            letter-spacing: 0;
            color: var(--text-light);
            margin-bottom: 0.35rem;
        }

        .confirm-subtitle {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            font-weight: 400;
        }

        .order-id-badge {
            background: transparent;
            border: none;
            border-radius: 0;
            padding: 0.25rem 0;
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--text-light);
            margin-bottom: 1rem;
            display: inline-block;
        }

        /* ── Estimated Delivery ── */
        .eta-banner {
            display: flex;
            align-items: center;
            gap: 0.55rem;
            border: none;
            border-radius: 0;
            padding: 0.25rem 0;
            margin-bottom: 1rem;
            text-align: left;
        }

        .eta-icon {
            font-size: 0.95rem;
            color: var(--mocha);
        }

        .eta-label {
            font-size: 0.72rem;
            text-transform: none;
            letter-spacing: 0;
            color: var(--text-light);
            font-weight: 400;
        }

        .eta-time {
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--text-light);
        }

        .eta-date {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .details-section {
            text-align: left;
            border-top: none;
            padding-top: 0;
            margin-top: 0;
        }

        .details-title {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--text-light);
            margin-bottom: 0.5rem;
            text-transform: none;
            letter-spacing: 0;
        }

        .details-row {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0.25rem;
        }

        .details-row strong {
            color: var(--text-light);
        }

        .order-summary-box {
            background: transparent;
            border-radius: 0;
            padding: 0.5rem 0;
            border: none;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .order-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.25rem;
            color: var(--text-light);
            font-size: 0.9rem;
        }

        .order-summary-row.total {
            margin-top: 0;
            padding-top: 0;
            border-top: none;
            font-weight: 400;
            color: var(--text-light);
        }

        .btn-back-home {
            background: transparent;
            color: var(--text-light);
            border: 1px solid rgba(194, 178, 128, 0.3);
            padding: 0.55rem 1.1rem;
            font-size: 0.85rem;
            font-weight: 400;
            letter-spacing: 0;
            text-transform: none;
            border-radius: 2px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 1rem;
            transition: none;
        }

        .btn-back-home:hover {
            transform: none;
            box-shadow: none;
            color: var(--text-light);
            background: rgba(194, 178, 128, 0.1);
            border-color: rgba(194, 178, 128, 0.3);
        }

        .empty-state {
            padding: 4px 0;
        }

        .checkout-steps {
            display: flex;
            justify-content: space-between;
            gap: 0.75rem;
            margin: 2rem 0 2.4rem;
            position: relative;
        }

        .checkout-steps::before {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 22px;
            height: 2px;
            background: rgba(194, 178, 128, 0.35);
            z-index: 1;
        }

        .checkout-step {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            text-align: center;
        }

        .step-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            font-weight: 600;
            border: 2px solid rgba(194, 178, 128, 0.7);
            background-color: var(--linen);
            color: var(--text-mid);
        }

        .step-label {
            margin-top: 0.4rem;
            font-size: 0.75rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-light);
        }

        .checkout-step.completed .step-circle {
            background-color: var(--sand);
            color: var(--espresso);
            border-color: var(--sand);
        }

        .checkout-step.completed .step-label {
            color: var(--text-mid);
            font-weight: 500;
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
                    <li class="nav-item"><a class="nav-link" href="../../pages/ProductListPage/products.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../pages/AboutPage/about.php">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../index.php#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../index.php#contact">Locations</a></li>
                    <li class="nav-item"><a class="nav-link" href="../../pages/ProfilePage/profile.php">Profile</a></li>
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
        <?php if ($has_order): ?>
            <!-- Process Bar: all steps completed -->
            <section aria-label="Order progress" class="position-relative checkout-steps">
                <div style="position:absolute;left:0;top:22px;height:2px;width:100%;background:linear-gradient(90deg,var(--sand),var(--cream));z-index:1;"></div>
                <div class="checkout-step completed">
                    <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                    <div class="step-label">Cart</div>
                </div>
                <div class="checkout-step completed">
                    <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                    <div class="step-label">Shipping</div>
                </div>
                <div class="checkout-step completed">
                    <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                    <div class="step-label">Payment</div>
                </div>
                <div class="checkout-step completed">
                    <div class="step-circle"><i class="bi bi-check-lg"></i></div>
                    <div class="step-label">Confirmation</div>
                </div>
            </section>

            <section class="confirm-card" aria-label="Order confirmation">
                <div class="success-icon">
                    <i class="bi bi-check-lg"></i>
                </div>
                <h1 class="confirm-heading">Order Confirmed!</h1>
                <p class="confirm-subtitle">Thank you for your order. We're already brewing your drinks.</p>
                <div class="order-id-badge">Order #<?= $order_id ?></div>

                <!-- Estimated Delivery -->
                <div class="eta-banner">
                    <i class="bi bi-clock eta-icon"></i>
                    <div>
                        <div class="eta-label">Estimated Delivery</div>
                        <span class="eta-time"><?= $eta_range ?></span>
                        <span class="ms-1 eta-date">· <?= $eta_date ?></span>
                    </div>
                </div>

                <div class="details-section">
                    <div class="details-title">Delivery Details</div>
                    <div class="details-row"><strong><?= $fullName ?></strong></div>
                    <div class="details-row"><?= $email ?></div>
                    <div class="details-row"><?= $phone ?></div>
                    <div class="details-row"><?= $address ?>, <?= $city ?> <?= $postal ?></div>
                    <?php if ($deliveryNotes): ?>
                        <div class="text-muted details-row"><em>Note: <?= $deliveryNotes ?></em></div>
                    <?php endif; ?>

                    <div class="mt-3 details-title">Order Summary</div>
                    <div class="order-summary-box">
                        <div class="order-summary-row">
                            <span><?= $order_items ?></span>
                            <span><?= $order_subtotal ?></span>
                        </div>
                        <div class="order-summary-row">
                            <span>Delivery</span>
                            <span><?= $order_delivery ?></span>
                        </div>
                        <div class="order-summary-row">
                            <span>Promo (FREEDELIVERY)</span>
                            <span><?= $order_promo ?></span>
                        </div>
                        <div class="order-summary-row total">
                            <span>Total</span>
                            <span><?= $order_total ?></span>
                        </div>
                    </div>
                </div>

                <p class="mt-3 mb-0 text-muted small">A confirmation email has been sent to <strong><?= $email ?></strong></p>
                <a href="../../index.php" class="btn btn-back-home">
                    <i class="bi bi-house-door"></i> Back to Home
                </a>
            </section>
        <?php else: ?>
            <!-- No order data (direct visit) -->
            <section class="confirm-card empty-state">
                <div class="success-icon">
                    <i class="bi bi-cart-x"></i>
                </div>
                <h1 class="confirm-heading">No Order Found</h1>
                <p class="confirm-subtitle">You arrived here without completing a checkout. Start an order from our shop.</p>
                <a href="../../index.php" class="btn btn-back-home">
                    <i class="bi bi-house-door"></i> Browse Menu
                </a>
                <a href="../CheckoutPage/checkout.php" class="ms-2 mt-2 btn-outline-secondary btn" style="border-color:var(--sand);color:var(--espresso);">
                    <i class="bi bi-bag-check"></i> Go to Checkout
                </a>
            </section>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>