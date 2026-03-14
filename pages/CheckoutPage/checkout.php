<?php
$shop_name = "Mindflayer";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $shop_name ?> · Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha: #6F4C3E;
            --sand: #C2B280;
            --cream: #E8D8B0;
            --linen: #F5F5F0;
            --white: #FFFFFF;
            --ink: #2A1E1E;
            --muted: #6F4C3E;
            --hint: #A89880;
            --border: rgba(194, 178, 128, 0.4);
            --fd: 'Playfair Display', Georgia, serif;
            --fb: 'DM Sans', system-ui, sans-serif;
            --ease: 0.22s ease;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 15px;
        }

        body {
            font-family: var(--fb);
            background: var(--linen);
            color: var(--ink);
            line-height: 1.5;
            min-height: 100vh;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ══ Navbar ══ */
        .nav-bar {
            background: var(--espresso);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 1.75rem;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(194, 178, 128, 0.2);
        }

        .nav-brand {
            font-family: var(--fd);
            font-size: 1.55rem;
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -0.02em;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-brand .dot {
            color: var(--sand);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }

        .nav-links a {
            font-size: 0.82rem;
            font-weight: 400;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(232, 216, 176, 0.75);
            padding: 0.25rem 1rem;
            border-radius: 2px;
            transition: color var(--ease);
        }

        .nav-links a:hover {
            color: var(--cream);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-ghost {
            font-size: 0.82rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--cream);
            padding: 0.55rem 1.2rem;
            border: 1px solid rgba(232, 216, 176, 0.35);
            border-radius: 2px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(245, 245, 240, 0.06);
            transition: border-color var(--ease), background var(--ease), box-shadow var(--ease);
        }

        .btn-ghost:hover {
            border-color: rgba(194, 178, 128, 0.7);
            background: rgba(232, 216, 176, 0.1);
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.25);
            color: var(--cream);
        }

        .btn-cta {
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--espresso);
            padding: 0.6rem 1.7rem;
            background: linear-gradient(135deg, var(--sand), var(--cream));
            border: none;
            border-radius: 2px;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            box-shadow: 0 10px 26px rgba(194, 178, 128, 0.28);
            transition: transform var(--ease), box-shadow var(--ease), filter var(--ease);
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 34px rgba(194, 178, 128, 0.45);
            filter: saturate(1.05);
            color: var(--espresso);
        }

        /* ══ Page shell ══ */
        .page {
            max-width: 640px;
            margin: 0 auto;
            padding: 1.1rem 1.25rem 2rem;
        }

        .page-title {
            font-family: var(--fd);
            font-size: 1.7rem;
            font-weight: 900;
            letter-spacing: -0.03em;
            color: var(--espresso);
            line-height: 1;
        }

        .page-sub {
            font-size: 0.82rem;
            color: var(--hint);
            margin-top: 0.2rem;
        }

        /* ══ Progress steps ══ */
        .steps-wrap {
            display: none;
        }

        /* ══ Card ══ */
        .checkout-card {
            background: var(--white);
            border-radius: 10px;
            border: 1px solid var(--border);
            box-shadow: 0 4px 20px rgba(59, 42, 42, 0.07), 0 1px 4px rgba(59, 42, 42, 0.04);
            padding: 1.5rem 1.6rem;
        }

        /* ══ Section headings ══ */
        .sec-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0.85rem;
            padding-bottom: 0.55rem;
            border-bottom: 1px solid rgba(194, 178, 128, 0.22);
        }

        .sec-title {
            font-family: var(--fd);
            font-size: 1rem;
            font-weight: 700;
            color: var(--espresso);
            letter-spacing: -0.01em;
        }

        .sec-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--mocha);
            background: rgba(111, 76, 62, 0.07);
            padding: 0.2rem 0.6rem;
            border-radius: 999px;
        }

        /* Divider between sections */
        .sec-divider {
            border: none;
            border-top: 1px solid rgba(194, 178, 128, 0.2);
            margin: 1.1rem 0;
        }

        /* ══ Fields ══ */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .fld {
            margin-bottom: 0.7rem;
        }

        label.lbl {
            display: block;
            font-size: 0.7rem;
            font-weight: 600;
            color: var(--mocha);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 0.22rem;
        }

        input.inp,
        textarea.inp {
            display: block;
            width: 100%;
            font-family: var(--fb);
            font-size: 0.88rem;
            color: var(--ink);
            background: var(--white);
            border: 1px solid rgba(194, 178, 128, 0.45);
            border-radius: 5px;
            padding: 0.42rem 0.7rem;
            line-height: 1.45;
            transition: border-color var(--ease), box-shadow var(--ease);
            -webkit-appearance: none;
        }

        input.inp:focus,
        textarea.inp:focus {
            outline: none;
            border-color: var(--sand);
            box-shadow: 0 0 0 3px rgba(194, 178, 128, 0.15);
        }

        input.inp::placeholder,
        textarea.inp::placeholder {
            color: rgba(168, 152, 128, 0.6);
            font-size: 0.85rem;
        }

        textarea.inp {
            resize: none;
            min-height: 52px;
        }

        /* ══ Save card row ══ */
        .save-row {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            padding-top: 0.22rem;
        }

        .save-row input[type=checkbox] {
            width: 14px;
            height: 14px;
            accent-color: var(--mocha);
            cursor: pointer;
            flex-shrink: 0;
        }

        .save-row label {
            font-size: 0.78rem;
            color: var(--hint);
            cursor: pointer;
            line-height: 1.3;
        }

        /* ══ Order summary ══ */
        .summary-box {
            background: rgba(245, 241, 228, 0.7);
            border: 1px dashed rgba(194, 178, 128, 0.6);
            border-radius: 6px;
            padding: 0.75rem 0.9rem;
            margin-top: 0.2rem;
        }

        .summary-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .summary-top span {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--espresso);
        }

        .summary-top a {
            font-size: 0.72rem;
            color: var(--mocha);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .s-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.82rem;
            color: var(--muted);
            padding: 0.15rem 0;
        }

        .s-row.s-total {
            margin-top: 0.4rem;
            padding-top: 0.4rem;
            border-top: 1px solid rgba(194, 178, 128, 0.4);
            font-weight: 700;
            font-size: 0.92rem;
            color: var(--espresso);
        }

        /* ══ Submit ══ */
        .submit-zone {
            margin-top: 1rem;
        }

        .btn-order {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            background: linear-gradient(135deg, var(--espresso) 0%, var(--mocha) 100%);
            color: var(--cream);
            border: none;
            border-radius: 6px;
            padding: 0.7rem 1rem;
            font-family: var(--fb);
            font-size: 0.87rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform var(--ease), box-shadow var(--ease), filter var(--ease);
        }

        .btn-order:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 22px rgba(59, 42, 42, 0.28);
            filter: brightness(1.07);
        }

        .btn-order:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .btn-order:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
            filter: none;
        }

        .terms {
            text-align: center;
            font-size: 0.7rem;
            color: var(--hint);
            margin-top: 0.45rem;
        }

        .terms a {
            color: var(--mocha);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        @media (max-width: 520px) {
            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <header class="nav-bar">
        <a class="nav-brand" href="../../index.php">
            ☕ <?= $shop_name ?><span class="dot">.</span>
        </a>
        <ul class="nav-links">
            <li><a href="../../index.php#menu">Menu</a></li>
            <li><a href="../AboutPage/about.php">Our Story</a></li>
            <li><a href="../../index.php#experience">Experience</a></li>
            <li><a href="../../index.php#contact">Locations</a></li>
            <li><a href="../ProfilePage/profile.php">Profile</a></li>
        </ul>
        <div class="nav-actions">
            <a href="../ShoppingCartPage/shoppingcart.php" class="btn-ghost">
                <i class="bi bi-bag"></i> Cart
            </a>
            <a href="./checkout.php" class="btn-cta">
                Checkout <i class="bi-arrow-right bi"></i>
            </a>
        </div>
    </header>

    <!-- Page -->
    <main class="page">

        <div>
            <h1 class="page-title">Checkout</h1>
            <p class="page-sub">Review your details and place your order below.</p>
        </div>

        <!-- Progress -->
        <div class="steps-wrap">
            <div class="steps-progress"></div>
            <div class="step done">
                <div class="step-dot"><i class="bi bi-check" style="font-size:0.75rem;"></i></div>
                <span class="step-lbl">Cart</span>
            </div>
            <div class="step done">
                <div class="step-dot"><i class="bi bi-check" style="font-size:0.75rem;"></i></div>
                <span class="step-lbl">Shipping</span>
            </div>
            <div class="step active">
                <div class="step-dot">3</div>
                <span class="step-lbl">Payment</span>
            </div>
            <div class="step">
                <div class="step-dot">4</div>
                <span class="step-lbl">Confirm</span>
            </div>
        </div>

        <!-- Single-column card -->
        <div class="checkout-card">
            <form id="checkoutForm" method="post" action="../OrderConfirmPage/order.php">

                <!-- ── Contact & Shipping ── -->
                <div class="sec-head">
                    <span class="sec-title">Contact &amp; Shipping</span>
                </div>

                <div class="form-grid">
                    <div class="fld">
                        <label for="fullName" class="lbl">Full Name</label>
                        <input type="text" class="inp" id="fullName" name="fullName" placeholder="Juan Dela Cruz" required>
                    </div>

                    <div class="fld">
                        <label for="phone" class="lbl">Mobile Number</label>
                        <input type="tel" class="inp" id="phone" name="phone" placeholder="09XX XXX XXXX" required>
                    </div>

                    <div class="fld">
                        <label for="email" class="lbl">Email</label>
                        <input type="email" class="inp" id="email" name="email" placeholder="you@example.com" required>
                    </div>

                    <div class="fld">
                        <label for="address" class="lbl">Delivery Address</label>
                        <input type="text" class="inp" id="address" name="address" placeholder="Unit · street · barangay · city" required>
                    </div>

                    <div class="fld">
                        <label for="city" class="lbl">City</label>
                        <input type="text" class="inp" id="city" name="city" placeholder="Makati City" required>
                    </div>

                    <div class="fld">
                        <label for="postal" class="lbl">ZIP Code</label>
                        <input type="text" class="inp" id="postal" name="postal" maxlength="4" pattern="\d{4}" placeholder="1200" required>
                    </div>

                    <div class="fld" style="grid-column: 1 / -1;">
                        <label for="notes" class="lbl">Rider Note <span style="font-weight:400;text-transform:none;letter-spacing:0;color:var(--hint);">(optional)</span></label>
                        <input type="text" class="inp" id="notes" name="deliveryNotes" placeholder="Gate code, landmark…">
                    </div>
                </div>

                <hr class="sec-divider">

                <!-- ── Payment ── -->
                <div class="sec-head">
                    <span class="sec-title">Payment</span>
                    <span class="sec-badge"><i class="bi bi-shield-lock-fill"></i> 256-bit SSL</span>
                </div>

                <div class="form-grid">
                    <div class="fld" style="grid-column: 1 / -1;">
                        <label for="cardName" class="lbl">Name on Card</label>
                        <input type="text" class="inp" id="cardName" placeholder="As it appears on card" required>
                    </div>

                    <div class="fld" style="grid-column: 1 / -1;">
                        <label for="cardNumber" class="lbl">Card Number</label>
                        <input type="text" inputmode="numeric" maxlength="19" class="inp" id="cardNumber" placeholder="1234  5678  9012  3456" required>
                    </div>

                    <div class="fld">
                        <label for="cardExpiry" class="lbl">Expiry Date</label>
                        <input type="text" inputmode="numeric" maxlength="5" class="inp" id="cardExpiry" placeholder="08 / 28" required>
                    </div>

                    <div class="fld">
                        <label for="cardCVC" class="lbl">CVC</label>
                        <input type="text" inputmode="numeric" maxlength="3" class="inp" id="cardCVC" placeholder="123" required>
                    </div>

                    <div class="fld" style="grid-column: 1 / -1;">
                        <div class="save-row">
                            <input type="checkbox" id="saveCard">
                            <label for="saveCard">Save card for next time</label>
                        </div>
                    </div>
                </div>

                <hr class="sec-divider">

                <!-- ── Order summary ── -->
                <div class="summary-box">
                    <div class="summary-top">
                        <span>Order summary</span>
                        <a href="../ShoppingCartPage/shoppingcart.php">Edit items</a>
                    </div>
                    <div class="s-row"><span>3 × Signature drinks</span><span>₱540</span></div>
                    <div class="s-row"><span>Delivery</span><span>₱60</span></div>
                    <div class="s-row">
                        <span>Promo <span style="color:#2e7d52;font-weight:600;">FREEDELIVERY</span></span>
                        <span>−₱60</span>
                    </div>
                    <div class="s-row s-total"><span>Total</span><span>₱540</span></div>
                </div>

                <!-- ── Submit ── -->
                <div class="submit-zone">
                    <button type="submit" class="btn-order">
                        Place order &nbsp;<i class="bi-arrow-right-circle-fill bi"></i>
                    </button>
                    <p class="terms">
                        By ordering you agree to our <a href="#">terms &amp; privacy policy</a>.
                    </p>
                </div>

            </form>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const form = document.getElementById('checkoutForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                return;
            }
            const btn = form.querySelector('.btn-order');
            btn.disabled = true;
            btn.innerHTML = '<span class="me-2 spinner-border spinner-border-sm" role="status"></span> Processing…';
            setTimeout(() => form.submit(), 1200);
        });

        document.getElementById('cardNumber').addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g, '').slice(0, 16),
                p = [];
            for (let i = 0; i < v.length; i += 4) p.push(v.slice(i, i + 4));
            e.target.value = p.join('  ');
        });

        document.getElementById('cardExpiry').addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g, '').slice(0, 4);
            if (v.length >= 3) v = v.slice(0, 2) + ' / ' + v.slice(2);
            e.target.value = v;
        });

        document.getElementById('cardCVC').addEventListener('input', e => {
            e.target.value = e.target.value.replace(/\D/g, '').slice(0, 3);
        });
    </script>
</body>

</html>