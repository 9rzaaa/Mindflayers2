<?php
// Simple signup page – front-end only
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up · Mindflayer Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        :root {
            --espresso:   #3B2A2A;
            --mocha:      #6F4C3E;
            --sand:       #C2B280;
            --cream:      #E8D8B0;
            --linen:      #F5F5F0;
            --white:      #FFFFFF;
            --text-dark:  #2A1E1E;
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body:    'DM Sans', sans-serif;
            --transition:   0.3s ease;
        }

        * , *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: stretch;
            justify-content: center;
            font-family: var(--font-body);
            background: radial-gradient(circle at top left, #C2B28022, #3B2A2A 55%, #000000 100%);
            color: var(--white);
        }

        .auth-page {
            width: 100%;
            max-width: 1100px;
            margin: 2rem auto;
            background: rgba(26, 18, 18, 0.96);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(0,0,0,0.7);
            border: 1px solid rgba(194,178,128,0.25);
        }

        .auth-hero {
            flex: 0 0 50%;
            padding: 2.5rem 2.75rem;
            background:
                radial-gradient(circle at top left, rgba(194,178,128,0.2), transparent 60%),
                linear-gradient(145deg, #3B2A2A 0%, #1C1412 40%, #000000 100%);
            position: relative;
            color: var(--linen);
        }

        .auth-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.035'/%3E%3C/svg%3E");
            mix-blend-mode: soft-light;
            pointer-events: none;
        }

        .brand-link {
            position: relative;
            z-index: 1;
            font-family: var(--font-display);
            font-weight: 900;
            font-size: 1.6rem;
            color: var(--cream);
            text-decoration: none;
            letter-spacing: -0.03em;
        }
        .brand-link .dot { color: var(--sand); }

        .hero-heading {
            position: relative;
            z-index: 1;
            margin-top: 3rem;
            font-family: var(--font-display);
            font-size: clamp(2.4rem, 3vw, 3.2rem);
            font-weight: 900;
            line-height: 1.05;
            letter-spacing: -0.03em;
        }
        .hero-heading em {
            font-style: italic;
            color: var(--sand);
        }

        .hero-text {
            position: relative;
            z-index: 1;
            margin-top: 1.2rem;
            font-size: 0.98rem;
            color: rgba(245,245,240,0.75);
            max-width: 320px;
        }

        .hero-note {
            position: relative;
            z-index: 1;
            margin-top: 2.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(245,245,240,0.55);
        }

        .auth-card {
            flex: 0 0 50%;
            padding: 2.5rem 2.5rem;
            background-color: #0E0908;
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            font-size: 0.92rem;
            color: var(--text-light);
            margin-top: 0.5rem;
            margin-bottom: 1.8rem;
        }

        .form-label {
            font-size: 0.8rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(245,245,240,0.7);
            margin-bottom: 0.35rem;
        }

        .form-control {
            background-color: #1A1210;
            border-radius: 999px;
            border: 1px solid rgba(194,178,128,0.25);
            padding: 0.65rem 0.95rem;
            font-size: 0.9rem;
            color: var(--linen);
        }
        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(194,178,128,0.5);
            border-color: rgba(194,178,128,0.8);
            background-color: #1F1512;
        }

        .btn-submit {
            width: 100%;
            border-radius: 999px;
            border: none;
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-size: 0.95rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            padding: 0.9rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
        }
        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.6);
            filter: brightness(1.02);
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: rgba(245,245,240,0.7);
            text-decoration: none;
            margin-top: 1.4rem;
        }
        .back-link:hover {
            color: var(--cream);
        }

        .helper-text {
            font-size: 0.75rem;
            color: rgba(245,245,240,0.5);
        }

        .form-check-label {
            font-size: 0.8rem;
            color: rgba(245,245,240,0.7);
        }

        .text-link {
            color: var(--sand);
            text-decoration: none;
        }
        .text-link:hover {
            color: var(--cream);
            text-decoration: underline;
        }

        @media (max-width: 991.98px) {
            body {
                background: #0E0908;
            }
            .auth-page {
                margin: 0;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                border: none;
            }
            .auth-hero {
                display: none;
            }
            .auth-card {
                flex: 1 1 auto;
                padding: 2.25rem 1.5rem 2.5rem;
            }
        }
    </style>
</head>
<body>

<div class="auth-page d-flex">
    <div class="auth-hero d-none d-lg-flex flex-column justify-content-between">
        <div>
            <a href="../../index.php" class="brand-link">
                ☕ Mindflayer<span class="dot">.</span>
            </a>
            <h1 class="hero-heading">
                Join the<br>
                <em>Mindflayer</em> circle.
            </h1>
            <p class="hero-text">
                Save your favourites, earn rewards on every cup, and get first dibs on limited small-batch roasts.
            </p>
        </div>
        <p class="hero-note">
            Members-only drops · Early access · Birthday drink on us
        </p>
    </div>

    <div class="auth-card d-flex flex-column justify-content-between">
        <div>
            <h2 class="auth-title">Create your account</h2>
            <p class="auth-subtitle">Sign up in under a minute. No spam, just coffee.</p>

            <form id="signup-form" novalidate>
                <div class="mb-3">
                    <label class="form-label" for="name">Full name</label>
                    <input type="text" class="form-control" id="name" placeholder="e.g. Alex Reyes" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                    <div class="helper-text mt-1">We’ll send your digital stamps and receipts here.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="At least 8 characters" minlength="8" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="confirm_password">Confirm password</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Repeat your password" minlength="8" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="newsletter">
                    <label class="form-check-label" for="newsletter">
                        Send me limited-run drink announcements and perks.
                    </label>
                </div>

                <button type="submit" class="btn-submit">
                    Create account
                </button>

                <p class="helper-text mt-3 mb-0">
                    By signing up, you agree to our
                    <a href="#" class="text-link">Terms</a> and
                    <a href="#" class="text-link">Privacy Policy</a>.
                </p>
            </form>
        </div>

        <div class="mt-3">
            <a href="../../index.php" class="back-link">
                Back to home
            </a>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const form = document.getElementById('signup-form');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;

        if (!name || !email || !password || !confirm) {
            alert('Please fill in all required fields.');
            return;
        }
        if (password.length < 8) {
            alert('Password must be at least 8 characters.');
            return;
        }
        if (password !== confirm) {
            alert('Passwords do not match.');
            return;
        }

        alert('Signup successful (demo only – no data is stored).');
        form.reset();
    });
</script>
</body>
</html>
