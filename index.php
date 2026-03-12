<?php
// MindFlayer Coffee — index.php
$shop_name = "Mindflayer";
$tagline = "Brewed with intention. Served with soul.";
$year = date("Y");

$products = [
    [
        "name" => "Spanish Latte",
        "desc" => "Condensed milk sweetness meets bold espresso, silky and rich.",
        "price" => "₱180",
        "badge" => "Bestseller",
        "emoji" => "☕",
        "color" => "#6F4C3E",
        "light" => "#E8D8B0"
    ],
    [
        "name" => "Matcha Latte",
        "desc" => "Ceremonial-grade matcha whisked with oat milk, earthy and calm.",
        "price" => "₱195",
        "badge" => "Fan Fave",
        "emoji" => "🍵",
        "color" => "#7A8C5E",
        "light" => "#E2EBCF"
    ],
    [
        "name" => "Ube Latte",
        "desc" => "Velvety purple yam swirled into steamed milk, sweet and dreamy.",
        "price" => "₱195",
        "badge" => "Local Pride",
        "emoji" => "💜",
        "color" => "#7B5EA7",
        "light" => "#EAE0F5"
    ],
    [
        "name" => "Iced Sea Salt",
        "desc" => "Cold brew with a whisper of sea salt cream floating on top.",
        "price" => "₱170",
        "badge" => "Refreshing",
        "emoji" => "🧊",
        "color" => "#4A7C8C",
        "light" => "#D0EAF0"
    ],
    [
        "name" => "Caramel Macchiato",
        "desc" => "Layers of vanilla, espresso, and golden caramel drizzle.",
        "price" => "₱185",
        "badge" => "Classic",
        "emoji" => "🍯",
        "color" => "#B87333",
        "light" => "#F5E6CC"
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $shop_name ?> Coffee</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400;1,700&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />

    <style>
        /* ═══════════════════════════════
           CSS VARIABLES — COLOR PALETTE
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
            --font-body: 'DM Sans', sans-serif;
            --transition: 0.35s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* ═══════════════════════════════
           BASE
        ═══════════════════════════════ */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--linen);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        h4 {
            font-family: var(--font-display);
        }

        /* ═══════════════════════════════
           NOISE TEXTURE OVERLAY
        ═══════════════════════════════ */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 9999;
            opacity: 0.5;
        }

        /* ═══════════════════════════════
           NAVIGATION — Serial Positioning
           (Logo left = PRIMARY, Order Now right = CTA)
        ═══════════════════════════════ */
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

        /* CTA in nav — rightmost = high recall */
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

        /* ═══════════════════════════════
           HERO — Z-pattern starts top-left
        ═══════════════════════════════ */
        .hero {
            min-height: 92vh;
            background-color: var(--espresso);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-bg-circle {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(194, 178, 128, 0.12) 0%, transparent 70%);
        }

        .hero-bg-circle.c1 {
            width: 700px;
            height: 700px;
            top: -200px;
            right: -150px;
        }

        .hero-bg-circle.c2 {
            width: 400px;
            height: 400px;
            bottom: -100px;
            left: 5%;
        }

        /* Diagonal split line */
        .hero::after {
            content: '';
            position: absolute;
            right: 38%;
            top: 0;
            bottom: 0;
            width: 1px;
            background: linear-gradient(to bottom, transparent, rgba(194, 178, 128, 0.3) 30%, rgba(194, 178, 128, 0.3) 70%, transparent);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            padding: 0 2.5rem;
            animation: fadeSlideUp 0.9s ease both;
        }

        .hero-eyebrow {
            font-family: var(--font-body);
            font-size: 0.75rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--sand);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .hero-eyebrow::before {
            content: '';
            display: inline-block;
            width: 32px;
            height: 1px;
            background: var(--sand);
        }

        .hero-title {
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 1.0;
            color: var(--linen);
            margin-bottom: 1.5rem;
            letter-spacing: -0.03em;
        }

        .hero-title em {
            font-style: italic;
            color: var(--sand);
        }

        .hero-subtitle {
            font-size: 1.05rem;
            font-weight: 300;
            color: rgba(245, 245, 240, 0.65);
            max-width: 420px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }

        .hero-cta-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn-primary-cta {
            background-color: var(--sand);
            color: var(--espresso);
            font-family: var(--font-body);
            font-size: 0.88rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.85rem 2.2rem;
            border: none;
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition);
            cursor: pointer;
        }

        .btn-primary-cta:hover {
            background-color: var(--cream);
            color: var(--espresso);
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(59, 42, 42, 0.4);
        }

        .btn-primary-cta i {
            font-size: 1rem;
        }

        .btn-ghost-cta {
            background: transparent;
            color: var(--cream);
            font-family: var(--font-body);
            font-size: 0.88rem;
            font-weight: 400;
            letter-spacing: 0.06em;
            padding: 0.85rem 1.8rem;
            border: 1px solid rgba(232, 216, 176, 0.35);
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all var(--transition);
        }

        .btn-ghost-cta:hover {
            border-color: var(--sand);
            color: var(--sand);
        }

        /* Hero image side */
        .hero-visual {
            position: relative;
            z-index: 2;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            animation: fadeSlideUp 1.1s 0.2s ease both;
        }

        .hero-cup-wrapper {
            position: relative;
            width: 340px;
            height: 340px;
        }

        .hero-cup-ring {
            position: absolute;
            inset: -20px;
            border-radius: 50%;
            border: 1px solid rgba(194, 178, 128, 0.2);
        }

        .hero-cup-ring.r2 {
            inset: -45px;
            border-color: rgba(194, 178, 128, 0.1);
        }

        .hero-cup-ring.r3 {
            inset: -75px;
            border-color: rgba(194, 178, 128, 0.06);
        }

        .hero-cup {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: radial-gradient(ellipse at 35% 35%, var(--mocha), var(--espresso) 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9rem;
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.5), inset 0 -10px 30px rgba(0, 0, 0, 0.3);
            animation: floatCup 4s ease-in-out infinite;
        }

        .hero-stats {
            position: absolute;
            bottom: 20px;
            right: -20px;
            background: rgba(245, 245, 240, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(194, 178, 128, 0.2);
            padding: 1rem 1.4rem;
            border-radius: 4px;
        }

        .hero-stat-num {
            font-family: var(--font-display);
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--sand);
            line-height: 1;
        }

        .hero-stat-label {
            font-size: 0.7rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: rgba(232, 216, 176, 0.6);
            margin-top: 0.2rem;
        }

        .hero-badge {
            position: absolute;
            top: 10px;
            left: -30px;
            background: var(--sand);
            color: var(--espresso);
            font-size: 0.7rem;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.6rem 1rem;
            border-radius: 2px;
        }

        /* ═══════════════════════════════
           MARQUEE STRIP
        ═══════════════════════════════ */
        .marquee-section {
            background-color: var(--sand);
            padding: 0.75rem 0;
            overflow: hidden;
        }

        .marquee-track {
            display: flex;
            gap: 0;
            animation: marquee 18s linear infinite;
            white-space: nowrap;
        }

        .marquee-item {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            padding: 0 2.5rem;
            font-size: 0.78rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--espresso);
        }

        .marquee-item .sep {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: var(--espresso);
            opacity: 0.5;
        }

        /* ═══════════════════════════════
           SECTION COMMON
        ═══════════════════════════════ */
        .section-label {
            font-family: var(--font-body);
            font-size: 0.72rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--mocha);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-label::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 1px;
            background: var(--mocha);
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 700;
            color: var(--espresso);
            line-height: 1.1;
            letter-spacing: -0.02em;
        }

        .section-title em {
            font-style: italic;
            color: var(--mocha);
        }

        /* ═══════════════════════════════
           ABOUT STRIP
        ═══════════════════════════════ */
        .about-section {
            background-color: var(--linen);
            padding: 6rem 2.5rem;
        }

        .about-number {
            font-family: var(--font-display);
            font-size: 7rem;
            font-weight: 900;
            color: var(--cream);
            line-height: 1;
            letter-spacing: -0.05em;
        }

        .about-text {
            font-size: 1.05rem;
            color: var(--text-light);
            line-height: 1.8;
            max-width: 480px;
        }

        .about-divider {
            width: 1px;
            background: var(--cream);
            align-self: stretch;
            margin: 0 3rem;
        }

        /* ═══════════════════════════════
           MENU / PRODUCTS
        ═══════════════════════════════ */
        .menu-section {
            background-color: var(--mocha);
            padding: 6rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .menu-section::before {
            content: 'MENU';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-family: var(--font-display);
            font-size: 22vw;
            font-weight: 900;
            color: rgba(194, 178, 128, 0.04);
            letter-spacing: -0.05em;
            pointer-events: none;
            white-space: nowrap;
        }

        .menu-section .section-label {
            color: var(--sand);
        }

        .menu-section .section-label::before {
            background: var(--sand);
        }

        .menu-section .section-title {
            color: var(--linen);
        }

        .menu-section .section-title em {
            color: var(--sand);
        }

        /* Product cards */
        .product-card {
            background: rgba(245, 245, 240, 0.04);
            border: 1px solid rgba(194, 178, 128, 0.12);
            border-radius: 4px;
            padding: 2rem 1.75rem;
            position: relative;
            transition: all var(--transition);
            height: 100%;
            cursor: pointer;
            overflow: hidden;
        }

        .product-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, var(--sand), transparent);
            transform: scaleX(0);
            transition: transform var(--transition);
        }

        .product-card:hover {
            background: rgba(245, 245, 240, 0.07);
            transform: translateY(-6px);
            border-color: rgba(194, 178, 128, 0.3);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .product-card:hover::before {
            transform: scaleX(1);
        }

        .product-badge {
            font-size: 0.65rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 1.25rem;
        }

        .product-emoji {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            display: block;
            transition: transform var(--transition);
        }

        .product-card:hover .product-emoji {
            transform: scale(1.15) rotate(5deg);
        }

        .product-name {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--linen);
            margin-bottom: 0.65rem;
            line-height: 1.2;
        }

        .product-desc {
            font-size: 0.88rem;
            color: rgba(245, 245, 240, 0.5);
            line-height: 1.65;
            margin-bottom: 1.5rem;
        }

        .product-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1.25rem;
            border-top: 1px solid rgba(194, 178, 128, 0.12);
        }

        .product-price {
            font-family: var(--font-display);
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--sand);
        }

        .btn-add {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(194, 178, 128, 0.12);
            border: 1px solid rgba(194, 178, 128, 0.25);
            color: var(--sand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all var(--transition);
            cursor: pointer;
        }

        .btn-add:hover {
            background: var(--sand);
            color: var(--espresso);
            border-color: var(--sand);
        }

        /* ═══════════════════════════════
           EXPERIENCE SECTION
        ═══════════════════════════════ */
        .experience-section {
            background-color: var(--linen);
            padding: 6rem 2.5rem;
        }

        .exp-card {
            text-align: center;
            padding: 2.5rem 1.5rem;
        }

        .exp-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--cream);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.4rem;
            color: var(--mocha);
            border: 1px solid var(--sand);
        }

        .exp-title {
            font-family: var(--font-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--espresso);
            margin-bottom: 0.5rem;
        }

        .exp-text {
            font-size: 0.88rem;
            color: var(--text-light);
            line-height: 1.7;
        }

        /* ═══════════════════════════════
           TESTIMONIAL
        ═══════════════════════════════ */
        .quote-section {
            background-color: var(--mocha);
            padding: 5rem 2.5rem;
            text-align: center;
        }

        .quote-mark {
            font-family: var(--font-display);
            font-size: 6rem;
            line-height: 0;
            color: rgba(194, 178, 128, 0.3);
            padding-bottom: 2rem;
            display: block;
        }

        .quote-text {
            font-family: var(--font-display);
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-style: italic;
            font-weight: 400;
            color: var(--linen);
            max-width: 700px;
            margin: 0 auto 1.5rem;
            line-height: 1.5;
        }

        .quote-author {
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--sand);
        }

        /* ═══════════════════════════════
           FOOTER CTA — Gutenberg Principle
           Primary CTA at bottom-right
        ═══════════════════════════════ */
        .footer-cta-section {
            background-color: var(--espresso);
            padding: 5rem 2.5rem 3rem;
            position: relative;
            overflow: hidden;
        }

        .footer-cta-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(194, 178, 128, 0.08) 0%, transparent 70%);
        }

        .footer-cta-heading {
            font-family: var(--font-display);
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
            color: var(--linen);
            line-height: 1.05;
            letter-spacing: -0.03em;
        }

        .footer-cta-heading em {
            color: var(--sand);
            font-style: italic;
        }

        .footer-cta-sub {
            font-size: 1rem;
            color: rgba(245, 245, 240, 0.55);
            margin-top: 1rem;
            max-width: 380px;
            line-height: 1.7;
        }

        /* THE PRIMARY CTA — bottom-right per Gutenberg Principle */
        .btn-main-order {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso);
            font-family: var(--font-body);
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 1.1rem 2.8rem;
            border: none;
            border-radius: 2px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-main-order::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(-100%);
            transition: transform 0.4s ease;
        }

        .btn-main-order:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(194, 178, 128, 0.4);
            color: var(--espresso);
        }

        .btn-main-order:hover::after {
            transform: translateX(0);
        }

        .btn-main-order i {
            font-size: 1.1rem;
        }

        /* Footer bottom bar */
        .footer-bar {
            background-color: var(--espresso);
            border-top: 1px solid rgba(194, 178, 128, 0.12);
            padding: 1.5rem 2.5rem;
        }

        .footer-bar-text {
            font-size: 0.78rem;
            color: rgba(245, 245, 240, 0.35);
            letter-spacing: 0.04em;
        }

        .footer-links a {
            color: rgba(245, 245, 240, 0.4);
            font-size: 0.78rem;
            text-decoration: none;
            margin-left: 1.5rem;
            transition: color var(--transition);
        }

        .footer-links a:hover {
            color: var(--sand);
        }

        /* Social icons */
        .social-icons a {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(194, 178, 128, 0.2);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(245, 245, 240, 0.5);
            font-size: 0.85rem;
            text-decoration: none;
            margin-left: 0.5rem;
            transition: all var(--transition);
        }

        .social-icons a:hover {
            border-color: var(--sand);
            color: var(--sand);
            transform: translateY(-2px);
        }

        /* ═══════════════════════════════
           ANIMATIONS
        ═══════════════════════════════ */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floatCup {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-14px);
            }
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ═══════════════════════════════
           RESPONSIVE
        ═══════════════════════════════ */
        @media (max-width: 991.98px) {
            .hero::after {
                display: none;
            }

            .hero-visual {
                margin-top: 3rem;
            }

            .hero-cup-wrapper {
                width: 260px;
                height: 260px;
            }

            .hero-cup {
                font-size: 7rem;
            }

            .about-divider {
                display: none;
            }

            .navbar {
                padding: 0.9rem 1.5rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-cup-wrapper {
                width: 200px;
                height: 200px;
            }

            .hero-cup {
                font-size: 5rem;
            }

            .hero-badge,
            .hero-stats {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- ═══════════════════════════════════════════════════════
     NAVBAR — Serial Positioning: Logo (left) + Order Now (right)
═══════════════════════════════════════════════════════ -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

            <!-- PRIMARY: Brand — leftmost, high recall -->
            <a class="navbar-brand" href="#">
                ☕ <?= $shop_name ?><span class="dot">.</span>
            </a>

            <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <i class="text-warning bi bi-list fs-4"></i>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <!-- Center nav items -->
                <ul class="gap-1 mx-auto navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/AboutPage/about.php">Our Story</a></li>
                    <li class="nav-item"><a class="nav-link" href="#experience">Experience</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Locations</a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/ProfilePage/profile.php">Profile</a></li>
                </ul>

                <!-- SERIAL POSITIONING: Auth + primary CTA on the right -->
                <div class="d-flex align-items-center gap-2">
                    <a href="pages/SignupPage/login.php" class="nav-link" style="font-size: 0.85rem;">
                        Login
                    </a>
                    <a href="pages/SignupPage/signup.php" class="btn-nav-cta nav-link">
                        Sign Up <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <!-- ═══════════════════════════════════════════════════════
     HERO — Gutenberg Z-pattern: Top-left start
═══════════════════════════════════════════════════════ -->
    <section class="hero">
        <div class="hero-bg-circle c1"></div>
        <div class="hero-bg-circle c2"></div>

        <div class="container-fluid">
            <div class="align-items-center row">

                <!-- Z-START: top-left — headline & context -->
                <div class="col-lg-6 hero-content">
                    <p class="hero-eyebrow">Specialty Coffee · Makati City</p>
                    <h1 class="hero-title">
                        Every sip,<br>
                        <em>a moment</em><br>
                        worth savoring.
                    </h1>
                    <p class="hero-subtitle">
                        <?= $tagline ?> Hand-crafted drinks made with ethically sourced beans and real ingredients.
                    </p>
                    <div class="hero-cta-group">
                        <a href="pages/ProductListPage/products.php" class="btn-primary-cta">
                            <i class="bi-grid-fill bi"></i> Explore Menu
                        </a>
                        <a href="pages/AboutPage/about.php" class="btn-ghost-cta">
                            <i class="bi bi-play-circle"></i> Our Story
                        </a>
                    </div>
                </div>

                <!-- Visual element -->
                <div class="col-lg-6 hero-visual">
                    <div class="hero-cup-wrapper">
                        <div class="hero-cup-ring"></div>
                        <div class="hero-cup-ring r2"></div>
                        <div class="hero-cup-ring r3"></div>
                        <div class="hero-cup">☕</div>

                        <div class="hero-badge">Open Daily 7AM–10PM</div>

                        <div class="hero-stats">
                            <div class="hero-stat-num">12+</div>
                            <div class="hero-stat-label">Signature Drinks</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- MARQUEE STRIP -->
    <div class="marquee-section">
        <div class="marquee-track">
            <?php
            $marquee_items = ['Freshly Brewed', 'Ethically Sourced', 'Oat Milk Available', 'Free WiFi', 'All Day Breakfast', 'Cold Brew Ready', 'Dine In · Takeaway · Delivery'];
            // Repeat for seamless loop
            $all_items = array_merge($marquee_items, $marquee_items, $marquee_items, $marquee_items);
            foreach ($all_items as $item): ?>
                <span class="marquee-item"><?= $item ?> <span class="sep"></span></span>
            <?php endforeach; ?>
        </div>
    </div>


    <!-- ═══════════════════════════════════════════════════════
     PRODUCTS / MENU
═══════════════════════════════════════════════════════ -->
    <section class="menu-section" id="menu">
        <div class="position-relative container">
            <div class="align-items-end mb-5 row reveal">
                <div class="col-lg-7">
                    <div class="section-label">Signature Drinks</div>
                    <h2 class="section-title">Our most-loved <em>crafted</em> sips.</h2>
                </div>
                <div class="mt-3 mt-lg-0 text-lg-end col-lg-5">
                    <a href="pages/ProductListPage/products.php" class="btn-ghost-cta" style="border-color: rgba(194,178,128,0.3); color: var(--sand);">
                        View Full Menu <i class="bi-arrow-right bi"></i>
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($products as $i => $product): ?>
                    <div class="col-md-6 col-lg-4 reveal" style="animation-delay: <?= $i * 0.1 ?>s">
                        <?php if ($i === 4): // 5th card — span wider on lg 
                        ?>
                            <div class="col-lg-12" style="display:contents">
                            <?php endif; ?>
                            <div class="h-100 product-card">
                                <span class="product-badge" style="background-color: <?= $product['color'] ?>22; color: <?= $product['light'] ?>; border: 1px solid <?= $product['color'] ?>44;">
                                    <?= $product['badge'] ?>
                                </span>
                                <span class="product-emoji"><?= $product['emoji'] ?></span>
                                <h3 class="product-name"><?= $product['name'] ?></h3>
                                <p class="product-desc"><?= $product['desc'] ?></p>
                                <div class="product-footer">
                                    <span class="product-price"><?= $product['price'] ?></span>
                                    <button class="btn-add" aria-label="Add to order">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                            </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
            </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
     EXPERIENCE PILLARS
═══════════════════════════════════════════════════════ -->
    <section class="experience-section" id="experience">
        <div class="container">
            <div class="mb-5 text-center reveal">
                <div class="justify-content-center section-label">Why Mindflayer</div>
                <h2 class="section-title">The <em>details</em> make the difference.</h2>
            </div>

            <div class="row g-4 reveal">
                <?php
                $pillars = [
                    ['bi bi-cup-hot', 'Single Origin Beans', 'Every batch is traceable to the farm it came from.'],
                    ['bi bi-droplet', 'Cold Brew Crafted In-House', '24-hour steep, zero compromise. Always fresh.'],
                    ['bi bi-heart', 'Made to Order', 'No syrups sitting around — everything is freshly blended.'],
                    ['bi bi-tree', 'Eco Packaging', 'Compostable cups, paper straws, no plastic ever.'],
                ];
                foreach ($pillars as $pillar): ?>
                    <div class="col-sm-6 col-lg-3">
                        <div class="exp-card">
                            <div class="exp-icon">
                                <i class="<?= $pillar[0] ?>"></i>
                            </div>
                            <div class="exp-title"><?= $pillar[1] ?></div>
                            <p class="exp-text"><?= $pillar[2] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <!-- QUOTE -->
    <section class="quote-section">
        <div class="container">
            <span class="quote-mark">"</span>
            <p class="quote-text">The ube latte alone is worth crossing the city for.</p>
            <p class="quote-author">— Lifestyle Manila, Best Coffee Spots 2024</p>
        </div>
    </section>


    <!-- ═══════════════════════════════════════════════════════
     FOOTER CTA — Gutenberg Principle:
     Primary CTA is positioned BOTTOM-RIGHT,
     the terminal endpoint of the Z-pattern reading flow.
═══════════════════════════════════════════════════════ -->
    <section class="footer-cta-section" id="order">
        <div class="container">
            <div class="align-items-end row gy-5 reveal">

                <!-- LEFT: Headline — Z-pattern end begins bottom-left -->
                <div class="col-lg-7">
                    <h2 class="footer-cta-heading">
                        Ready for your<br>next <em>favourite</em> cup?
                    </h2>
                    <p class="footer-cta-sub">
                        Walk in, call ahead, or order online. We'll have it ready warm and waiting.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <div style="color: rgba(245,245,240,0.5); font-size: 0.82rem;">
                            <i class="me-1 bi bi-geo-alt" style="color: var(--sand);"></i>
                            Salcedo Village · BGC · Poblacion
                        </div>
                        <div style="color: rgba(245,245,240,0.5); font-size: 0.82rem;">
                            <i class="me-1 bi bi-clock" style="color: var(--sand);"></i>
                            Open 7:00 AM – 10:00 PM Daily
                        </div>
                    </div>
                </div>

                <!-- RIGHT: Primary CTA — BOTTOM-RIGHT = Gutenberg terminal zone -->
                <div class="d-flex flex-column align-items-lg-end align-items-start gap-3 col-lg-5">
                    <a href="pages/SignupPage/signup.php" class="btn-main-order">
                        Order Now <i class="bi-arrow-right-circle bi"></i>
                    </a>
                    <span style="font-size: 0.75rem; color: rgba(245,245,240,0.3); letter-spacing: 0.08em;">
                        Ready in 5 minutes · Free delivery over ₱500
                    </span>
                </div>

            </div>
        </div>
    </section>


    <!-- FOOTER BAR -->
    <footer class="footer-bar">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 container-fluid">
            <p class="mb-0 footer-bar-text">
                &copy; <?= $year ?> <?= $shop_name ?> Coffee. All rights reserved.
            </p>
            <div class="d-flex align-items-center">
                <div class="footer-links">
                    <a href="#">Privacy</a>
                    <a href="#">Terms</a>
                    <a href="#contact">Contact</a>
                </div>
                <div class="ms-3 social-icons">
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-tiktok"></i></a>
                </div>
            </div>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // ─── Scroll Reveal ───────────────────────────────
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });
        revealEls.forEach(el => observer.observe(el));

        // ─── Add to Order button feedback ────────────────
        document.querySelectorAll('.btn-add').forEach(btn => {
            btn.addEventListener('click', function() {
                this.innerHTML = '<i class="bi bi-check-lg"></i>';
                this.style.background = 'var(--sand)';
                this.style.color = 'var(--espresso)';
                this.style.borderColor = 'var(--sand)';
                setTimeout(() => {
                    this.innerHTML = '<i class="bi bi-plus-lg"></i>';
                    this.style.background = '';
                    this.style.color = '';
                    this.style.borderColor = '';
                }, 1800);
            });
        });

        // ─── Smooth active nav highlight ─────────────────
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(sec => {
                if (window.scrollY >= sec.offsetTop - 120) current = sec.id;
            });
            navLinks.forEach(link => {
                link.style.color = link.getAttribute('href') === '#' + current ?
                    'var(--cream)' : '';
            });
        });
    </script>

</body>

</html>