<?php
// pages/about.php  — OR place at root as about.php
$year = date("Y");

$timeline = [
    ["year" => "2020", "title" => "The First Pour",       "body" => "What started as a 10-sqm corner stall in Salcedo Village quickly became the neighbourhood's best-kept secret. A manual espresso machine, three drinks on the menu, and a whole lot of heart."],
    ["year" => "2021", "title" => "Roots & Recipes",      "body" => "We partnered directly with a family-run farm in Benguet to source our beans. That same year, our Ube Latte was born — inspired by our founder's lola's weekend halaya recipe."],
    ["year" => "2022", "title" => "Growing the Circle",   "body" => "Mindflayer opened its second branch in BGC. We introduced our signature cold brew program, steeping in-house every 24 hours with zero compromise on freshness."],
    ["year" => "2023", "title" => "Community First",      "body" => "We launched our \"Cup for a Cause\" initiative — for every drink sold on Saturdays, a percentage goes to local urban farming cooperatives across Metro Manila."],
    ["year" => "2024", "title" => "Third Wave, Our Way",  "body" => "Poblacion branch opened. We also introduced our rotating seasonal menu, letting guest roasters from across the Philippines take over the bar for a week each month."],
];

$values = [
    ["icon" => "bi-leaf",          "title" => "Ethically Sourced",    "body" => "Every bean is traceable. We work directly with smallholder farms in Benguet, Sagada, and Mt. Apo — paying above fair-trade rates because the people matter as much as the product."],
    ["icon" => "bi-heart",         "title" => "Made to Order",        "body" => "Nothing is pre-made, pre-poured, or pre-syruped. Every drink is crafted fresh from the moment you order. The wait is worth it."],
    ["icon" => "bi-recycle",       "title" => "Zero Waste Goals",     "body" => "Compostable cups, paper straws, and no single-use plastics across all branches. Spent coffee grounds go back to our partner farms as compost."],
    ["icon" => "bi-people",        "title" => "Crew Over Everything", "body" => "Our baristas earn living wages, get paid training, and have a genuine path to growth. A happy team makes better coffee — it really is that simple."],
];

$team = [
    [
        "name" => "Steven Kyle",
        "role" => "Lead Barista & Developer",
        "note" => "Trains the bar team and obsesses over extractions so every shot tastes the same, every day."
    ],
    [
        "name" => "Daniel",
        "role" => "Head Roaster & Founder",
        "note" => "Leads sourcing and roasting, making sure every bean that reaches the bar is worth brewing."
    ],
    [
        "name" => "Hilary Ashley",
        "role" => "Menu Organizer & Developer",
        "note" => "Works on seasonal drinks and signatures, balancing flavors so nothing feels too sweet or too safe."
    ],
    [
        "name" => "Rhanz Christian",
        "role" => "Store Operations & Quality Assurance",
        "note" => "Keeps the doors running smoothly and makes sure regulars feel like the space is theirs, too."
    ],
    [
        "name" => "Amilia Danielle",
        "role" => "Assistant Barista & Designer",
        "note" => "Jumps between bar and floor, helping the team stay fast, calm, and extra friendly during rush hours."
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Our Story — Mindflayer Coffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <!-- Tip 31: ONE typeface — Playfair Display used for everything, sized and weighted appropriately -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,900;1,400;1,600;1,700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

    <style>
        /* ══════════════════════════════════════
           VARIABLES
        ══════════════════════════════════════ */
        :root {
            --espresso:   #3B2A2A;
            --mocha:      #6F4C3E;
            --sand:       #C2B280;
            --cream:      #E8D8B0;
            --linen:      #F5F5F0;
            --white:      #FFFFFF;
            --text-dark:  #2A1E1E;
            --text-mid:   #6F4C3E;
            --text-muted: #9C8878;

            /* Tip 31 — single typeface everywhere */
            --font: 'Playfair Display', Georgia, serif;

            /* Tip 41 — spacing system (multiples of base unit) */
            --space-xs:  0.5rem;
            --space-sm:  1rem;
            --space-md:  2rem;
            --space-lg:  4rem;
            --space-xl:  7rem;
            --space-2xl: 10rem;

            --ease: cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        *, *::before, *::after { box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            /* Tip 31: single font applied at root */
            font-family: var(--font);
            background: var(--linen);
            color: var(--text-dark);
            overflow-x: hidden;
            font-weight: 400;
            line-height: 1.75;
        }

        /* Noise texture */
        body::before {
            content: ''; position: fixed; inset: 0;
            pointer-events: none; z-index: 9999; opacity: 0.35;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        }

        /* ══════════════════════════════════════
           TYPOGRAPHY SCALE — Tip 31
           All headings/body use Playfair Display,
           varied only by size, weight, style, spacing
        ══════════════════════════════════════ */
        .t-eyebrow {
            font-size: 0.72rem;
            font-weight: 500;
            font-style: normal;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--sand);
            display: flex; align-items: center; gap: 0.75rem;
        }
        .t-eyebrow::before {
            content: '';
            display: inline-block;
            width: 28px; height: 1px;
            background: currentColor;
            flex-shrink: 0;
        }

        .t-display {
            font-size: clamp(3rem, 7vw, 6.5rem);
            font-weight: 900;
            line-height: 1.0;
            letter-spacing: -0.03em;
        }

        .t-h2 {
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -0.025em;
        }

        .t-h3 {
            font-size: 1.35rem;
            font-weight: 700;
            line-height: 1.25;
            letter-spacing: -0.01em;
        }

        .t-body-lg {
            font-size: 1.1rem;
            font-weight: 400;
            font-style: italic;
            line-height: 1.8;
        }

        .t-body {
            font-size: 0.95rem;
            font-weight: 400;
            line-height: 1.85;
        }

        .t-small {
            font-size: 0.78rem;
            font-weight: 400;
            letter-spacing: 0.04em;
        }

        .t-italic { font-style: italic; }
        .t-sand   { color: var(--sand); }
        .t-muted  { color: var(--text-muted); }
        .t-linen  { color: var(--linen); }
        .t-cream  { color: var(--cream); }

        /* ══════════════════════════════════════
           NAVBAR
        ══════════════════════════════════════ */
        .navbar {
            background: var(--espresso);
            padding: 1rem 2.5rem;
            border-bottom: 1px solid rgba(194,178,128,0.15);
            position: sticky; top: 0; z-index: 1000;
        }
        .navbar-brand {
            font-size: 1.5rem; font-weight: 900;
            color: var(--cream) !important;
            letter-spacing: -0.02em;
        }
        .navbar-brand .dot { color: var(--sand); }

        .nav-link-item {
            font-size: 0.72rem; letter-spacing: 0.14em; text-transform: uppercase;
            font-weight: 400; color: rgba(232,216,176,0.6) !important;
            text-decoration: none; padding: 0.25rem 0.9rem !important;
            transition: color 0.25s ease;
        }
        .nav-link-item:hover { color: var(--cream) !important; }
        .nav-link-item.active { color: var(--sand) !important; }

        .btn-nav {
            font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase;
            font-weight: 500; background: var(--sand); color: var(--espresso) !important;
            padding: 0.45rem 1.3rem; border-radius: 2px; text-decoration: none;
            transition: background 0.25s ease, transform 0.25s ease;
        }
        .btn-nav:hover { background: var(--cream); transform: translateY(-1px); }

        /* ══════════════════════════════════════
           HERO
        ══════════════════════════════════════ */
        .about-hero {
            background: var(--espresso);
            /* Tip 41: generous top/bottom padding */
            padding: var(--space-xl) 2.5rem;
            position: relative; overflow: hidden;
        }
        .about-hero::after {
            content: '"';
            position: absolute; right: -20px; bottom: -80px;
            font-size: 40vw; font-weight: 900; font-style: italic;
            color: rgba(194,178,128,0.04); line-height: 1;
            pointer-events: none;
        }
        .hero-inner { position: relative; z-index: 2; max-width: 780px; }

        /* ══════════════════════════════════════
           SECTION WRAPPER — Tip 41: spacing key
        ══════════════════════════════════════ */
        .about-section {
            /* Tip 41: every section gets identical generous vertical rhythm */
            padding: var(--space-xl) 2.5rem;
        }

        .about-section + .about-section {
            padding-top: 0; /* sections share the xl gap between them */
        }

        /* Alternating background for clear separation */
        .bg-linen  { background: var(--linen); }
        .bg-white  { background: var(--white); }
        .bg-dark   { background: var(--espresso); }
        .bg-mocha  { background: var(--mocha); }

        /* Section header block — consistent across all sections */
        .section-header {
            /* Tip 41: bottom margin separates label from content */
            margin-bottom: var(--space-lg);
        }
        .section-header .t-eyebrow { margin-bottom: var(--space-sm); }

        /* ══════════════════════════════════════
           INTRO / MANIFESTO
        ══════════════════════════════════════ */
        .manifesto-text {
            font-size: clamp(1.4rem, 3vw, 2rem);
            font-weight: 500; font-style: italic;
            line-height: 1.65; color: var(--text-dark);
            max-width: 820px;
        }
        .manifesto-text em { color: var(--mocha); font-style: italic; }

        .stat-block {
            /* Tip 41: generous padding inside stat blocks */
            padding: var(--space-md) 0;
            border-top: 1px solid var(--cream);
        }
        .stat-num {
            font-size: 3.5rem; font-weight: 900;
            color: var(--espresso); line-height: 1;
            letter-spacing: -0.04em;
        }
        .stat-label {
            font-size: 0.7rem; font-weight: 500;
            letter-spacing: 0.22em; text-transform: uppercase;
            color: var(--text-muted); margin-top: var(--space-xs);
        }

        /* ══════════════════════════════════════
           TIMELINE
        ══════════════════════════════════════ */
        .timeline-list { list-style: none; padding: 0; margin: 0; }

        .timeline-item {
            display: grid;
            grid-template-columns: 80px 1px 1fr;
            gap: 0 var(--space-md);
            /* Tip 41: vertical gap between each timeline entry */
            padding-bottom: var(--space-lg);
            position: relative;
        }
        .timeline-item:last-child { padding-bottom: 0; }

        .timeline-year {
            font-size: 0.72rem; font-weight: 500;
            letter-spacing: 0.18em; text-transform: uppercase;
            color: var(--sand); padding-top: 4px;
            text-align: right;
        }

        .timeline-line {
            position: relative;
            background: var(--cream);
            width: 1px;
        }
        .timeline-line::before {
            content: '';
            position: absolute; top: 6px; left: 50%;
            transform: translateX(-50%);
            width: 9px; height: 9px; border-radius: 50%;
            background: var(--sand);
            border: 2px solid var(--espresso);
        }
        .timeline-item:last-child .timeline-line { background: transparent; }

        .timeline-body {
            /* Tip 41: padding separates content from the line */
            padding-left: var(--space-sm);
            padding-bottom: var(--space-sm);
        }
        .timeline-body .t-h3 { margin-bottom: var(--space-xs); color: var(--linen); }
        .timeline-body .t-body { color: rgba(245,245,240,0.6); }

        /* ══════════════════════════════════════
           VALUES
        ══════════════════════════════════════ */
        .value-card {
            /* Tip 41: internal padding = breathing room */
            padding: var(--space-md);
            background: var(--linen);
            border: 1px solid var(--cream);
            border-radius: 4px;
            height: 100%;
            transition: transform 0.35s var(--ease), box-shadow 0.35s var(--ease), border-color 0.35s var(--ease);
        }
        .value-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 48px rgba(59,42,42,0.09);
            border-color: var(--sand);
        }

        .value-icon {
            width: 52px; height: 52px; border-radius: 50%;
            background: var(--cream); border: 1px solid var(--sand);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; color: var(--mocha);
            /* Tip 41: space below icon before title */
            margin-bottom: var(--space-md);
        }
        .value-card .t-h3 { margin-bottom: var(--space-sm); color: var(--espresso); }
        .value-card .t-body { color: var(--text-muted); }

        /* ══════════════════════════════════════
           PULL QUOTE
        ══════════════════════════════════════ */
        .pull-quote {
            /* Tip 41: very generous padding for quote block */
            padding: var(--space-xl) 2.5rem;
            text-align: center; background: var(--mocha);
        }
        .quote-mark {
            font-size: 5rem; font-weight: 900; font-style: italic;
            color: rgba(232,216,176,0.25); line-height: 0;
            display: block; margin-bottom: var(--space-md);
        }
        .quote-body {
            font-size: clamp(1.5rem, 3vw, 2.3rem);
            font-weight: 500; font-style: italic;
            color: var(--linen); max-width: 720px;
            margin: 0 auto var(--space-md); line-height: 1.55;
        }
        .quote-attr {
            font-size: 0.72rem; font-weight: 500;
            letter-spacing: 0.22em; text-transform: uppercase;
            color: var(--sand);
        }

        /* ══════════════════════════════════════
           TEAM
        ══════════════════════════════════════ */
        .team-card {
            /* Tip 41: padding inside card + gap between cards via Bootstrap g-4 */
            padding: var(--space-md);
            border: 1px solid rgba(194,178,128,0.18);
            border-radius: 4px; background: rgba(245,245,240,0.04);
            height: 100%;
            transition: border-color 0.3s ease, background 0.3s ease;
        }
        .team-card:hover {
            border-color: rgba(194,178,128,0.4);
            background: rgba(245,245,240,0.07);
        }

        .team-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--sand);
            background: var(--mocha);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: var(--space-md);
        }
        .team-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .team-avatar-fallback {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -0.02em;
        }

        .team-card .t-h3 { color: var(--linen); margin-bottom: var(--space-xs); }
        .team-role {
            font-size: 0.7rem; font-weight: 500;
            letter-spacing: 0.16em; text-transform: uppercase;
            color: var(--sand); margin-bottom: var(--space-sm);
        }
        .team-card .t-body { color: rgba(245,245,240,0.5); font-style: italic; }

        /* ══════════════════════════════════════
           FOOTER CTA
        ══════════════════════════════════════ */
        .footer-cta {
            background: var(--espresso);
            /* Tip 41: generous padding */
            padding: var(--space-xl) 2.5rem;
            position: relative; overflow: hidden;
        }
        .footer-cta::before {
            content: '';
            position: absolute; top: -120px; right: -120px;
            width: 500px; height: 500px; border-radius: 50%;
            background: radial-gradient(circle, rgba(194,178,128,0.07) 0%, transparent 70%);
        }

        .btn-cta-primary {
            background: linear-gradient(135deg, var(--sand), var(--cream));
            color: var(--espresso); font-weight: 700;
            font-size: 0.88rem; letter-spacing: 0.14em; text-transform: uppercase;
            padding: 1rem 2.5rem; border-radius: 2px; border: none;
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.65rem;
            cursor: pointer; transition: all 0.35s var(--ease);
            position: relative; overflow: hidden;
        }
        .btn-cta-primary:hover {
            color: var(--espresso); transform: translateY(-3px);
            box-shadow: 0 12px 36px rgba(194,178,128,0.35);
        }

        .btn-cta-ghost {
            background: transparent; color: var(--cream);
            font-size: 0.82rem; font-weight: 400;
            letter-spacing: 0.1em; text-transform: uppercase;
            padding: 1rem 2rem; border-radius: 2px;
            border: 1px solid rgba(232,216,176,0.3);
            text-decoration: none; display: inline-flex; align-items: center; gap: 0.6rem;
            transition: all 0.3s ease;
        }
        .btn-cta-ghost:hover { border-color: var(--sand); color: var(--sand); }

        /* ══════════════════════════════════════
           FOOTER BAR
        ══════════════════════════════════════ */
        .footer-bar {
            background: var(--espresso);
            border-top: 1px solid rgba(194,178,128,0.12);
            padding: 1.5rem 2.5rem;
        }
        .footer-bar-txt { font-size: 0.72rem; color: rgba(245,245,240,0.3); letter-spacing: 0.04em; }
        .footer-bar-brand { font-size: 0.9rem; font-weight: 900; color: rgba(245,245,240,0.4); }
        .footer-bar-brand span { color: var(--sand); }

        /* ══════════════════════════════════════
           SCROLL REVEAL
        ══════════════════════════════════════ */
        .reveal {
            opacity: 0; transform: translateY(22px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* ══════════════════════════════════════
           RESPONSIVE
        ══════════════════════════════════════ */
        @media (max-width: 991px) {
            :root { --space-xl: 5rem; --space-lg: 3rem; }
        }
        @media (max-width: 767px) {
            :root { --space-xl: 4rem; --space-lg: 2.5rem; }
            .about-hero { padding: var(--space-lg) 1.5rem; }
            .about-section { padding: var(--space-xl) 1.5rem; }
            .navbar { padding: 0.9rem 1.5rem; }
            .timeline-item { grid-template-columns: 56px 1px 1fr; }
        }
    </style>
</head>
<body>

<!-- ════════════════════════════════════
     NAVBAR
════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">☕ Mindflayer<span class="dot">.</span></a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navAbout">
            <i class="bi bi-list text-warning fs-4"></i>
        </button>

        <div class="collapse navbar-collapse" id="navAbout">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link-item" href="../index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link-item active" href="#">Our Story</a></li>
                <li class="nav-item"><a class="nav-link-item" href="productpage/products.php">Menu</a></li>
                <li class="nav-item"><a class="nav-link-item" href="#">Locations</a></li>
            </ul>
            <a href="productpage/products.php" class="btn-nav">Order Now <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</nav>


<!-- ════════════════════════════════════
     HERO
════════════════════════════════════ -->
<header class="about-hero">
    <div class="container">
        <div class="hero-inner reveal">
            <p class="t-eyebrow mb-4">Est. 2020 · Makati City</p>
            <h1 class="t-display t-linen mb-0">
                We didn't open<br>
                a coffee shop.<br>
                <em class="t-sand t-italic">We built a ritual.</em>
            </h1>
        </div>
    </div>
</header>


<!-- ════════════════════════════════════
     SECTION 1 — MANIFESTO
     Tip 41: section separated by full xl padding
════════════════════════════════════ -->
<section class="about-section bg-linen">
    <div class="container">

        <div class="row gy-5 align-items-start reveal">
            <div class="col-lg-7">
                <div class="section-header">
                    <p class="t-eyebrow t-mid mb-3" style="color: var(--mocha);">
                        What We Believe
                    </p>
                    <p class="manifesto-text">
                        Coffee is more than caffeine. It's the five minutes before a hard day begins.
                        The slow Sunday morning. The first sip that tells you <em>today will be okay.</em>
                        We make drinks that earn that moment.
                    </p>
                </div>

                <p class="t-body t-muted" style="max-width: 560px;">
                    Every decision we make — where we source our beans, how we pay our farmers, what goes into a recipe, how we design a space — comes back to one question: does this make the moment better?
                    If the answer is yes, we do it. If it isn't, we don't.
                </p>
            </div>

            <!-- Stats — Tip 41: generous padding on each block -->
            <div class="col-lg-4 offset-lg-1">
                <?php
                $stats = [
                    ["5K+",    "Happy Regulars"],
                    ["3",      "Branches in Metro Manila"],
                    ["100%",   "Real Ingredients. Always."],
                    ["4+",     "Years of Craft"],
                ];
                foreach ($stats as $stat): ?>
                <div class="stat-block">
                    <div class="stat-num"><?= $stat[0] ?></div>
                    <div class="stat-label"><?= $stat[1] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</section>


<!-- ════════════════════════════════════
     SECTION 2 — TIMELINE
════════════════════════════════════ -->
<section class="about-section bg-dark">
    <div class="container">

        <div class="section-header reveal">
            <p class="t-eyebrow mb-3">How We Got Here</p>
            <h2 class="t-h2 t-linen">
                Five years.<br>
                <em class="t-sand">One cup at a time.</em>
            </h2>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <ul class="timeline-list reveal">
                    <?php foreach ($timeline as $i => $entry): ?>
                    <li class="timeline-item" style="transition-delay:<?= $i * 0.1 ?>s">
                        <div class="timeline-year"><?= $entry['year'] ?></div>
                        <div class="timeline-line"></div>
                        <div class="timeline-body">
                            <h3 class="t-h3"><?= $entry['title'] ?></h3>
                            <p class="t-body"><?= $entry['body'] ?></p>
                        </div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

    </div>
</section>


<!-- ════════════════════════════════════
     PULL QUOTE
════════════════════════════════════ -->
<blockquote class="pull-quote reveal">
    <span class="quote-mark">"</span>
    <p class="quote-body">
        Good coffee doesn't have to be complicated. It just has to be honest.
    </p>
    <cite class="quote-attr">— Mara Santos, Founder of Mindflayer</cite>
</blockquote>


<!-- ════════════════════════════════════
     SECTION 3 — VALUES
════════════════════════════════════ -->
<section class="about-section bg-white">
    <div class="container">

        <div class="section-header reveal">
            <p class="t-eyebrow mb-3" style="color: var(--mocha);">What Drives Us</p>
            <h2 class="t-h2" style="color: var(--espresso);">
                Things we refuse<br>
                <em class="t-italic" style="color: var(--mocha);">to compromise on.</em>
            </h2>
        </div>

        <div class="row g-4 reveal">
            <?php foreach ($values as $i => $val): ?>
            <div class="col-sm-6 col-lg-3" style="transition-delay:<?= $i * 0.08 ?>s">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="bi <?= $val['icon'] ?>"></i>
                    </div>
                    <h3 class="t-h3"><?= $val['title'] ?></h3>
                    <p class="t-body"><?= $val['body'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ════════════════════════════════════
     SECTION 4 — TEAM
════════════════════════════════════ -->
<section class="about-section bg-dark">
    <div class="container">

        <div class="section-header reveal">
            <p class="t-eyebrow mb-3">The People Behind the Bar</p>
            <h2 class="t-h2 t-linen">
                You'll recognize them.<br>
                <em class="t-sand">They remember you too.</em>
            </h2>
        </div>

        <div class="row g-4 reveal">
            <?php foreach ($team as $i => $member): ?>
            <div class="col-6 col-lg" style="transition-delay:<?= $i * 0.08 ?>s">
                <div class="team-card">
                    <div class="team-avatar">
                        <?php if (!empty($member['image'] ?? '')): ?>
                            <img src="<?= htmlspecialchars($member['image']) ?>" alt="<?= htmlspecialchars($member['name']) ?> photo">
                        <?php else: ?>
                            <span class="team-avatar-fallback">
                                <?= mb_substr($member['name'], 0, 1) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <h3 class="t-h3"><?= $member['name'] ?></h3>
                    <p class="team-role"><?= $member['role'] ?></p>
                    <p class="t-body"><?= $member['note'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ════════════════════════════════════
     FOOTER CTA — Gutenberg: CTA bottom-right
════════════════════════════════════ -->
<section class="footer-cta">
    <div class="container">
        <div class="row align-items-end gy-5 reveal">
            <div class="col-lg-7">
                <p class="t-eyebrow mb-4">Come Find Us</p>
                <h2 class="t-h2 t-linen mb-3">
                    Now you know our story.<br>
                    <em class="t-sand">Come be part of it.</em>
                </h2>
                <p class="t-body" style="color: rgba(245,245,240,0.5); max-width: 420px;">
                    Three branches, one menu, zero shortcuts. Walk in any day between 7AM and 10PM — we'll have something warm (or cold) waiting for you.
                </p>
                <p class="t-small mt-3" style="color: rgba(245,245,240,0.3); letter-spacing: 0.1em; text-transform: uppercase;">
                    Salcedo Village · BGC · Poblacion
                </p>
            </div>
            <!-- Gutenberg terminal CTA — bottom-right -->
            <div class="col-lg-5 d-flex flex-column align-items-lg-end align-items-start gap-3">
                <a href="productpage/products.php" class="btn-cta-primary">
                    Explore the Menu <i class="bi bi-arrow-right-circle"></i>
                </a>
                <a href="../index.php" class="btn-cta-ghost">
                    <i class="bi bi-arrow-left"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</section>


<!-- FOOTER BAR -->
<footer class="footer-bar">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-2">
        <span class="footer-bar-brand">Mindflayer<span>.</span></span>
        <span class="footer-bar-txt">&copy; <?= $year ?> Mindflayer Coffee · Brewed with intention. Served with soul.</span>
    </div>
</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const reveals = document.querySelectorAll('.reveal');
    const obs = new IntersectionObserver((entries) => {
        entries.forEach((e, i) => {
            if (e.isIntersecting) {
                setTimeout(() => e.target.classList.add('visible'), i * 80);
                obs.unobserve(e.target);
            }
        });
    }, { threshold: 0.1 });
    reveals.forEach(el => obs.observe(el));
</script>

</body>
</html>