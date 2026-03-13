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

        * { box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            min-height: 100vh;
        }

        a { text-decoration: none; }

        .checkout-navbar {
            background-color: var(--espresso);
            color: var(--cream);
            padding: 0.9rem 1.5rem;
        }

        .checkout-brand {
            font-family: var(--font-display);
            font-weight: 900;
            letter-spacing: -0.03em;
            font-size: 1.4rem;
        }

        .checkout-brand span.dot { color: var(--sand); }

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
            .confirm-card { padding: 2.5rem 3rem; }
        }

        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.25rem;
            box-shadow: 0 8px 24px rgba(194, 178, 128, 0.4);
        }

        .confirm-heading {
            font-family: var(--font-display);
            font-size: clamp(1.6rem, 3vw, 2rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--espresso);
            margin-bottom: 0.35rem;
        }

        .confirm-subtitle {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .order-id-badge {
            background: rgba(111, 76, 62, 0.1);
            border: 1px dashed rgba(111, 76, 62, 0.4);
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-family: monospace;
            font-size: 1rem;
            font-weight: 600;
            color: var(--espresso);
            margin-bottom: 1.5rem;
            display: inline-block;
        }

        .details-section {
            text-align: left;
            border-top: 1px solid rgba(194, 178, 128, 0.3);
            padding-top: 1.5rem;
            margin-top: 1.5rem;
        }

        .details-title {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 700;
            color: var(--espresso);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .details-row {
            font-size: 0.92rem;
            color: var(--text-dark);
            margin-bottom: 0.35rem;
        }

        .details-row strong { color: var(--text-mid); }

        .order-summary-box {
            background: rgba(248, 244, 233, 0.9);
            border-radius: 8px;
            padding: 1rem 1.2rem;
            border: 1px dashed rgba(194, 178, 128, 0.8);
            font-size: 0.9rem;
            margin-top: 1rem;
        }

        .order-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.35rem;
        }

        .order-summary-row.total {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(194, 178, 128, 0.4);
            font-weight: 700;
            color: var(--espresso);
        }

        .btn-back-home {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            border: none;
            padding: 0.85rem 1.6rem;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            margin-top: 1.5rem;
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .btn-back-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(194, 178, 128, 0.5);
            color: var(--espresso);
        }

        .empty-state {
            padding: 3rem 2rem;
        }

        .empty-state .success-icon {
            opacity: 0.6;
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
    <header class="checkout-navbar">
        <div class="d-flex align-items-center justify-content-between">
            <a href="../../index.php" class="d-flex align-items-center gap-2 text-decoration-none text-light">
                <span class="checkout-brand">☕ <?= $shop_name ?><span class="dot">.</span></span>
            </a>
            <a href="../ShoppingCartPage/shoppingcart.php" class="text-light small text-uppercase" style="letter-spacing:0.12em;">
                <i class="bi bi-bag me-1"></i> Cart
            </a>
        </div>
    </header>

    <main class="confirm-wrapper">
        <?php if ($has_order): ?>
            <!-- Process Bar: all steps completed -->
            <section aria-label="Order progress" class="checkout-steps position-relative">
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

                <div class="details-section">
                    <div class="details-title">Delivery Details</div>
                    <div class="details-row"><strong><?= $fullName ?></strong></div>
                    <div class="details-row"><?= $email ?></div>
                    <div class="details-row"><?= $phone ?></div>
                    <div class="details-row"><?= $address ?>, <?= $city ?> <?= $postal ?></div>
                    <?php if ($deliveryNotes): ?>
                        <div class="details-row text-muted"><em>Note: <?= $deliveryNotes ?></em></div>
                    <?php endif; ?>

                    <div class="details-title mt-3">Order Summary</div>
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

                <p class="text-muted small mt-3 mb-0">A confirmation email has been sent to <strong><?= $email ?></strong></p>
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
                <a href="../CheckoutPage/checkout.php" class="btn btn-outline-secondary mt-2 ms-2" style="border-color:var(--sand);color:var(--espresso);">
                    <i class="bi bi-bag-check"></i> Go to Checkout
                </a>
            </section>
        <?php endif; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
