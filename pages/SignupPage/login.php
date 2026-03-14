<?php
// Login page – front-end only
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Log In · Mindflayer Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
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
            --text-light: #9C8878;
            --font-display: 'Playfair Display', Georgia, serif;
            --font-body: 'DM Sans', sans-serif;
            --transition: 0.3s ease;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

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
            max-width: 1000px;
            margin: 2rem auto;
            background: rgba(26, 18, 18, 0.96);
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(194, 178, 128, 0.25);
        }

        .auth-hero {
            flex: 0 0 50%;
            padding: 2.5rem 2.75rem;
            background:
                radial-gradient(circle at top left, rgba(194, 178, 128, 0.2), transparent 60%),
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

        .brand-link .dot {
            color: var(--sand);
        }

        .hero-heading {
            position: relative;
            z-index: 1;
            margin-top: 3rem;
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 3vw, 3rem);
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
            color: rgba(245, 245, 240, 0.75);
            max-width: 320px;
        }

        .hero-note {
            position: relative;
            z-index: 1;
            margin-top: 2.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(245, 245, 240, 0.55);
        }

        .auth-card {
            flex: 0 0 50%;
            padding: 2.5rem 2.5rem;
            background: linear-gradient(145deg, #FDF7ED 0%, #FAF1DF 35%, #F5E6CC 100%);
            color: var(--text-dark);
        }

        .auth-title {
            font-family: var(--font-display);
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--espresso);
            letter-spacing: -0.02em;
        }

        .auth-subtitle {
            font-size: 0.92rem;
            color: rgba(42, 46, 67, 0.7);
            margin-top: 0.5rem;
            margin-bottom: 1.4rem;
        }

        .social-login-btn {
            width: 100%;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.6);
            background-color: #FFFFFF;
            color: var(--espresso);
            font-size: 0.9rem;
            padding: 0.7rem 0.9rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0.55rem;
            transition: background-color var(--transition), transform 0.15s ease, box-shadow 0.15s ease;
        }

        .social-login-btn i {
            font-size: 1rem;
        }

        .social-login-btn:hover {
            background-color: var(--cream);
            box-shadow: 0 8px 22px rgba(59, 42, 42, 0.18);
            transform: translateY(-1px);
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 1.3rem 0 1.15rem;
            font-size: 0.78rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-light);
        }

        .divider span {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(194, 178, 128, 0.7), transparent);
        }

        .form-label {
            font-size: 0.8rem;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: rgba(42, 46, 67, 0.75);
            margin-bottom: 0.35rem;
        }

        .form-control {
            background-color: #FFFFFF;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.65);
            padding: 0.65rem 0.95rem;
            font-size: 0.9rem;
            color: var(--espresso);
        }

        .form-control:focus {
            outline: none;
            box-shadow: 0 0 0 1px rgba(194, 178, 128, 0.55);
            border-color: rgba(194, 178, 128, 0.95);
            background-color: #FFFFFF;
        }

        .primary-btn {
            width: 48%;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.7);
            background-color: #FFFFFF;
            color: var(--espresso);
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.85rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: background-color 0.15s ease, transform 0.15s ease;
        }

        .primary-btn:hover {
            background-color: rgba(232, 216, 176, 0.2);
            transform: translateY(-1px);
        }

        .secondary-btn {
            width: 48%;
            margin-top: 0.75rem;
            margin-left: auto;
            border-radius: 999px;
            border: 1px solid rgba(194, 178, 128, 0.7);
            background-color: #FFFFFF;
            color: var(--espresso);
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.85rem 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            text-decoration: none;
            transition: background-color 0.15s ease, color 0.15s ease, transform 0.15s ease;
        }

        .secondary-btn:hover {
            background-color: rgba(232, 216, 176, 0.2);
            transform: translateY(-1px);
        }

        .helper-row {
            margin-top: 0.75rem;
            font-size: 0.8rem;
            color: #5A6480;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: 0.85rem;
            color: rgba(245, 245, 240, 0.9);
            text-decoration: none;
            margin-top: 1.4rem;
            padding: 0.45rem 0.9rem;
            border-radius: 999px;
            border: 1px solid rgba(232, 216, 176, 0.7);
            background-color: rgba(14, 9, 8, 0.4);
            transition: background-color var(--transition), border-color var(--transition), transform 0.15s ease;
        }

        .back-link:hover {
            color: var(--espresso);
            background-color: var(--cream);
            border-color: var(--cream);
            transform: translateY(-1px);
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

    <div class="d-flex auth-page">
        <div class="d-lg-flex flex-column justify-content-between auth-hero d-none">
            <div>
                <a href="../../index.php" class="brand-link">
                    ☕ Mindflayer<span class="dot">.</span>
                </a>
                <h1 class="hero-heading">
                    Welcome back,<br>
                    <em>favourite</em> regular.
                </h1>
                <p class="hero-text">
                    Pick up where you left off — saved orders, earned perks, and your go-to cup in just a few taps.
                </p>
            </div>
            <p class="hero-note">
                Members-only perks · Faster checkout · Order history
            </p>
        </div>

        <div class="d-flex flex-column justify-content-between auth-card">
            <div>
                <h2 class="auth-title">Log in or Sign up</h2>
                <p class="auth-subtitle">Choose below.</p>

                <form id="login-form" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Your password" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between helper-row">
                        <div class="mb-0 form-check">
                            <input class="form-check-input" type="checkbox" value="" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="#" style="font-size: 0.8rem; text-decoration: none; color: #273ED3;">Forgot password?</a>
                    </div>

                    <!-- Equal weight buttons, no hierarchy -->
                    <div style="display: flex; gap: 1rem; justify-content: space-between; margin-top: 1.5rem;">
                        <button type="submit" class="primary-btn">
                            Log in
                        </button>
                        <a href="signup.php" class="secondary-btn">
                            <span>Sign up</span>
                        </a>
                    </div>
                </form>
            </div>

            <div class="mt-3">
                <a href="../../index.php" class="back-link">
                    <i class="bi-arrow-left bi"></i>
                    Back to home
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Auth JS -->
    <script src="../../assets/js/auth.js"></script>
    <script>
        const loginForm = document.getElementById('login-form');

        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email || !password) {
                alert('Please enter your email and password.');
                return;
            }

            // Set user as logged in
            setLoggedIn(email);

            alert('Login successful! Redirecting to home page...');

            // Redirect to home page
            setTimeout(() => {
                window.location.href = '../../index.php';
            }, 500);
        });
    </script>
</body>

</html>