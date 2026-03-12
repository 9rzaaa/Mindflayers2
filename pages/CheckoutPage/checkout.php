<?php
// Mindflayer Coffee — Checkout Page (Single-column form + progress bar)
$shop_name = "Mindflayer";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $shop_name ?> · Checkout</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        /* ═══════════════════════════════
           COLOR PALETTE (same as homepage)
        ═══════════════════════════════ */
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

        /* Simple top bar to match brand */
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

        .checkout-brand span.dot {
            color: var(--sand);
        }

        .checkout-wrapper {
            max-width: 960px;
            margin: 2.5rem auto;
            padding: 0 1.25rem 3rem;
        }

        .checkout-heading {
            font-family: var(--font-display);
            font-size: clamp(1.8rem, 3vw, 2.4rem);
            font-weight: 800;
            letter-spacing: -0.03em;
            color: var(--espresso);
        }

        .checkout-subtitle {
            color: var(--text-light);
            font-size: 0.95rem;
            max-width: 520px;
        }

        /* ═══════════════════════════════
           PROCESS BAR — Cart → Shipping → Payment → Confirmation
           (Tip 9 – Process Bar)
        ═══════════════════════════════ */
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
            transition: background-color var(--transition), color var(--transition), border-color var(--transition), transform var(--transition);
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

        .checkout-step.current .step-circle {
            background-color: var(--cream);
            color: var(--espresso);
            border-color: var(--cream);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 42, 42, 0.25);
        }

        .checkout-step.completed .step-label,
        .checkout-step.current .step-label {
            color: var(--text-mid);
            font-weight: 500;
        }

        /* Highlight completed path */
        .checkout-steps-progress {
            position: absolute;
            left: 0;
            top: 22px;
            height: 2px;
            background: linear-gradient(90deg, var(--sand), var(--cream));
            z-index: 1;
            transition: width var(--transition);
        }

        /* ═══════════════════════════════
           SINGLE COLUMN CHECKOUT FORM
           (Tip 14 – Single Column Form)
        ═══════════════════════════════ */
        .checkout-card {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: 0 18px 40px rgba(0, 0, 0, 0.09);
            border: 1px solid rgba(194, 178, 128, 0.25);
            padding: 1.8rem 1.6rem;
        }

        @media (min-width: 768px) {
            .checkout-card {
                padding: 2.2rem 2.4rem;
            }
        }

        .section-title-sm {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--espresso);
            margin-bottom: 0.75rem;
        }

        .section-helper {
            font-size: 0.8rem;
            color: var(--text-light);
            margin-bottom: 1.1rem;
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-mid);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-bottom: 0.35rem;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            border: 1px solid rgba(194, 178, 128, 0.5);
            font-size: 0.92rem;
            padding: 0.65rem 0.8rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--sand);
            box-shadow: 0 0 0 0.16rem rgba(194, 178, 128, 0.22);
        }

        .input-row-spacer {
            margin-top: 1rem;
        }

        .order-summary {
            background: rgba(248, 244, 233, 0.9);
            border-radius: 8px;
            padding: 1.1rem 1.2rem;
            border: 1px dashed rgba(194, 178, 128, 0.8);
            font-size: 0.9rem;
        }

        .order-summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.35rem;
        }

        .order-summary-row.total {
            margin-top: 0.6rem;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(194, 178, 128, 0.4);
            font-weight: 700;
            color: var(--espresso);
        }

        .badge-pill {
            background: rgba(111, 76, 62, 0.08);
            border-radius: 999px;
            padding: 0.18rem 0.6rem;
            font-size: 0.7rem;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--text-mid);
        }

        .btn-place-order {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            border: none;
            padding: 0.95rem 1.6rem;
            font-size: 0.9rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: transform var(--transition), box-shadow var(--transition), background-position 0.4s ease;
            background-size: 140% 100%;
        }

        .btn-place-order:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(194, 178, 128, 0.5);
            background-position: 100% 0;
        }

        .btn-place-order:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            box-shadow: none;
        }

        .text-muted-small {
            font-size: 0.78rem;
            color: var(--text-light);
        }

        @media (max-width: 575.98px) {
            .checkout-card {
                border-radius: 0.9rem;
            }

            .checkout-steps::before {
                top: 20px;
            }

            .step-circle {
                width: 30px;
                height: 30px;
                font-size: 0.8rem;
            }

            .step-label {
                font-size: 0.68rem;
                letter-spacing: 0.08em;
            }
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
                <i class="bi bi-bag me-1"></i> Back to Cart
            </a>
        </div>
    </header>

    <main class="checkout-wrapper">
        <div class="mb-2">
            <h1 class="checkout-heading">Checkout</h1>
            <p class="checkout-subtitle mb-0">
                Finalize your order in a single, easy-to-scan column. You can review your items and delivery details before you place your order.
            </p>
        </div>

        <!-- Process Bar (Tip 9) -->
        <section aria-label="Checkout progress" class="checkout-steps position-relative">
            <!-- completed bar up to 'Payment' -->
            <div class="checkout-steps-progress" style="width: 75%;"></div>

            <div class="checkout-step completed">
                <div class="step-circle">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div class="step-label">Cart</div>
            </div>
            <div class="checkout-step completed">
                <div class="step-circle">
                    <i class="bi bi-check-lg"></i>
                </div>
                <div class="step-label">Shipping</div>
            </div>
            <div class="checkout-step current">
                <div class="step-circle">3</div>
                <div class="step-label">Payment</div>
            </div>
            <div class="checkout-step">
                <div class="step-circle">4</div>
                <div class="step-label">Confirmation</div>
            </div>
        </section>

        <!-- Single-column layout (Tip 14) -->
        <section class="checkout-card" aria-label="Checkout details">
            <form id="checkoutForm" class="single-column-form">
                <!-- Contact & shipping -->
                <div class="mb-4">
                    <div class="section-title-sm">Contact & Shipping</div>
                    <p class="section-helper mb-0">
                        We’ll use these details for your receipt and delivery updates.
                    </p>
                </div>

                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" placeholder="Juan Dela Cruz" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email for receipt</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Mobile number</label>
                    <input type="tel" class="form-control" id="phone" placeholder="09XX XXX XXXX" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Delivery address</label>
                    <textarea id="address" rows="2" class="form-control" placeholder="Unit / building · street · barangay · city" required></textarea>
                </div>

                <div class="row g-3 input-row-spacer">
                    <div class="col-sm-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Makati City" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="postal" class="form-label">ZIP</label>
                        <input type="text" class="form-control" id="postal" maxlength="4" pattern="\d{4}" placeholder="1200" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="deliveryNotes" class="form-label">Rider note (optional)</label>
                        <input type="text" class="form-control" id="deliveryNotes" placeholder="Gate code, landmark, etc.">
                    </div>
                </div>

                <!-- Payment -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <div class="section-title-sm mb-1">Payment</div>
                            <p class="section-helper mb-0">
                                Securely processed. We never store your full card details.
                            </p>
                        </div>
                        <span class="badge-pill">
                            <i class="bi bi-shield-lock me-1"></i> 256-bit secured
                        </span>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="cardName" class="form-label">Name on card</label>
                    <input type="text" class="form-control" id="cardName" placeholder="As it appears on card" required>
                </div>

                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card number</label>
                    <input type="text" inputmode="numeric" maxlength="19" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" required>
                </div>

                <div class="row g-3 input-row-spacer">
                    <div class="col-sm-4">
                        <label for="cardExpiry" class="form-label">Expiry (MM/YY)</label>
                        <input type="text" inputmode="numeric" maxlength="5" class="form-control" id="cardExpiry" placeholder="08/28" required>
                    </div>
                    <div class="col-sm-3">
                        <label for="cardCVC" class="form-label">CVC</label>
                        <input type="text" inputmode="numeric" maxlength="3" class="form-control" id="cardCVC" placeholder="123" required>
                    </div>
                    <div class="col-sm-5">
                        <label class="form-label">Save card?</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="saveCard">
                            <label class="form-check-label small" for="saveCard">
                                Save for next time on this device.
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Order summary + submit -->
                <div class="mt-4 pt-3 border-top d-flex flex-column flex-md-row gap-3 align-items-md-center justify-content-between">
                    <div class="order-summary w-100 w-md-50">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="fw-semibold">Order summary</span>
                            <a href="../ShoppingCartPage/shoppingcart.php" class="small text-decoration-underline text-dark">
                                Edit items
                            </a>
                        </div>
                        <div class="order-summary-row">
                            <span>3 × Signature drinks</span>
                            <span>₱540</span>
                        </div>
                        <div class="order-summary-row">
                            <span>Delivery</span>
                            <span>₱60</span>
                        </div>
                        <div class="order-summary-row">
                            <span>Promo (<span class="text-success">FREEDELIVERY</span>)</span>
                            <span>-₱60</span>
                        </div>
                        <div class="order-summary-row total">
                            <span>Total</span>
                            <span>₱540</span>
                        </div>
                    </div>

                    <div class="text-md-end">
                        <button type="submit" class="btn-place-order mt-2 mt-md-0">
                            Place order
                            <i class="bi bi-arrow-right-circle"></i>
                        </button>
                        <p class="mt-2 mb-0 text-muted-small">
                            By placing your order, you agree to our terms & privacy policy.
                        </p>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Basic front-end validation feedback on submit
        const checkoutForm = document.getElementById('checkoutForm');
        checkoutForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (!checkoutForm.checkValidity()) {
                checkoutForm.classList.add('was-validated');
                // Let the browser surface built-in validation messages
                return;
            }

            const btn = this.querySelector('.btn-place-order');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processing...';

            setTimeout(() => {
                // In a real app, redirect to confirmation page
                window.location.href = '../OrderConfirmPage/order.php';
            }, 1200);
        });

        // Simple input helpers for payment fields
        const cardNumber = document.getElementById('cardNumber');
        const cardExpiry = document.getElementById('cardExpiry');
        const cardCVC = document.getElementById('cardCVC');

        cardNumber.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').slice(0, 16);
            const parts = [];
            for (let i = 0; i < value.length; i += 4) {
                parts.push(value.slice(i, i + 4));
            }
            e.target.value = parts.join(' ');
        });

        cardExpiry.addEventListener('input', (e) => {
            let value = e.target.value.replace(/\D/g, '').slice(0, 4);
            if (value.length >= 3) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }
            e.target.value = value;
        });

        cardCVC.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 3);
        });
    </script>
</body>

</html>