<?php
// pages/AboutPage/about_bad.php
$year = date("Y");

$timeline = [
    ["year" => "2020", "title" => "The First Pour",       "body" => "What started as a 10-sqm corner stall in Salcedo Village quickly became the neighbourhood's best-kept secret. A manual espresso machine, three drinks on the menu, and a whole lot of heart."],
    ["year" => "2021", "title" => "Roots & Recipes",      "body" => "We partnered directly with a family-run farm in Benguet to source our beans. That same year, our Ube Latte was born — inspired by our founder's lola's weekend halaya recipe."],
    ["year" => "2022", "title" => "Growing the Circle",   "body" => "Mindflayer opened its second branch in BGC. We introduced our signature cold brew program, steeping in-house every 24 hours with zero compromise on freshness."],
    ["year" => "2023", "title" => "Community First",      "body" => "We launched our \"Cup for a Cause\" initiative — for every drink sold on Saturdays, a percentage goes to local urban farming cooperatives across Metro Manila."],
    ["year" => "2024", "title" => "Third Wave, Our Way",  "body" => "Poblacion branch opened. We also introduced our rotating seasonal menu, letting guest roasters from across the Philippines take over the bar for a week each month."],
];

$values = [
    ["icon" => "bi-leaf",    "title" => "Ethically Sourced",    "body" => "Every bean is traceable. We work directly with smallholder farms in Benguet, Sagada, and Mt. Apo — paying above fair-trade rates because the people matter as much as the product."],
    ["icon" => "bi-heart",   "title" => "Made to Order",        "body" => "Nothing is pre-made, pre-poured, or pre-syruped. Every drink is crafted fresh from the moment you order. The wait is worth it."],
    ["icon" => "bi-recycle", "title" => "Zero Waste Goals",     "body" => "Compostable cups, paper straws, and no single-use plastics across all branches. Spent coffee grounds go back to our partner farms as compost."],
    ["icon" => "bi-people",  "title" => "Crew Over Everything", "body" => "Our baristas earn living wages, get paid training, and have a genuine path to growth. A happy team makes better coffee — it really is that simple."],
];

$team = [
    ["name" => "Steven Kyle",      "role" => "Lead Barista & Developer",          "note" => "Trains the bar team and obsesses over extractions so every shot tastes the same, every day."],
    ["name" => "Daniel",           "role" => "Head Roaster & Founder",            "note" => "Leads sourcing and roasting, making sure every bean that reaches the bar is worth brewing."],
    ["name" => "Hilary Ashley",    "role" => "Menu Organizer & Developer",        "note" => "Works on seasonal drinks and signatures, balancing flavors so nothing feels too sweet or too safe."],
    ["name" => "Rhanz Christian",  "role" => "Store Operations & Quality Assurance", "note" => "Keeps the doors running smoothly and makes sure regulars feel like the space is theirs, too."],
    ["name" => "Amilia Danielle",  "role" => "Assistant Barista & Designer",      "note" => "Jumps between bar and floor, helping the team stay fast, calm, and extra friendly during rush hours."],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>About</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- BAD: Three completely different typefaces loaded with no typographic logic -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Courier+Prime:ital,wght@0,400;0,700;1,400&family=Oswald:wght@300;400;600;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

    <style>
        :root {
            --espresso: #3B2A2A;
            --mocha:    #6F4C3E;
            --sand:     #C2B280;
            --cream:    #E8D8B0;
            --linen:    #F5F5F0;
        }

        /* BAD: No box-sizing reset, no consistent base */
        body {
            /* BAD: Body uses a monospace font — wrong tone, wrong readability */
            font-family: 'Courier Prime', monospace;
            background: var(--linen);
            color: #2A1E1E;
            margin: 0;
        }

        /* BAD: Navbar crammed, tiny padding, no breathing room */
        .bad-nav {
            background: var(--espresso);
            padding: 4px 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2px;
        }

        /* BAD: Brand uses yet another font (Oswald) — clashes with body */
        .bad-nav-brand {
            font-family: 'Oswald', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--cream);
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.3em;
        }

        .bad-nav-links {
            list-style: none;
            margin: 0; padding: 0;
            display: flex; flex-wrap: wrap; gap: 3px;
        }
        .bad-nav-links a {
            /* BAD: Nav links switch to DM Sans — 3rd font in the navbar alone */
            font-family: 'DM Sans', sans-serif;
            font-size: 0.65rem;
            color: var(--cream);
            text-decoration: none;
            padding: 1px 3px;
        }
        .bad-nav-cta {
            /* BAD: CTA uses Courier Prime — monospace on a button looks wrong */
            font-family: 'Courier Prime', monospace;
            font-size: 0.65rem;
            background: var(--sand);
            color: var(--espresso);
            padding: 2px 7px;
            text-decoration: none;
            font-weight: 700;
        }

        /* BAD: Hero — minimal padding, no visual hierarchy established */
        .bad-hero {
            background: var(--espresso);
            padding: 10px 12px 8px;
        }

        /* BAD: Hero eyebrow uses Oswald — feels like a poster, not a story page */
        .bad-hero-eye {
            font-family: 'Oswald', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--sand);
            margin: 0 0 4px;
        }

        /* BAD: H1 suddenly switches to Playfair — third font style already on this page */
        .bad-hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 900;
            color: var(--linen);
            margin: 0 0 4px;
            line-height: 1.15;
        }

        /* BAD: Hero desc uses Courier Prime — a dense, hard-to-read wall of monospace text */
        .bad-hero p {
            font-family: 'Courier Prime', monospace;
            font-size: 0.72rem;
            color: rgba(245,245,240,0.55);
            margin: 0;
            line-height: 1.3;
            max-width: 100%;
        }

        /* ── MANIFESTO ──────────────────────────── */
        /* BAD: No section gap — content immediately follows hero with only 6px breathing room */
        .bad-manifesto {
            padding: 6px 12px;
            background: var(--linen);
        }

        /* BAD: Section label uses Oswald — again inconsistent with everything around it */
        .bad-section-label {
            font-family: 'Oswald', sans-serif;
            font-size: 0.65rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--mocha);
            margin: 0 0 3px;
        }

        /* BAD: Manifesto heading uses Courier Prime — monospace for a big statement looks terrible */
        .bad-manifesto h2 {
            font-family: 'Courier Prime', monospace;
            font-size: 1rem;
            font-weight: 700;
            color: var(--espresso);
            margin: 0 0 4px;
            line-height: 1.3;
        }

        /* BAD: Body uses DM Sans here but Courier Prime elsewhere — jarring switch */
        .bad-manifesto p {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.8rem;
            color: #7A6355;
            margin: 0 0 3px;
            line-height: 1.35;
        }

        /* BAD: Stats crammed inline with no visual separation from manifesto text */
        .bad-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            margin-top: 5px;
        }
        .bad-stat {
            /* BAD: tiny stat block, no padding, no border separation */
            font-family: 'Courier Prime', monospace;
            font-size: 0.7rem;
            color: var(--espresso);
            border-left: 2px solid var(--sand);
            padding-left: 5px;
        }
        /* BAD: stat number barely bigger than label — no visual weight */
        .bad-stat strong {
            font-size: 0.85rem;
            display: block;
        }

        /* ── TIMELINE ───────────────────────────── */
        /* BAD: No section gap — abuts the manifesto section directly */
        .bad-timeline {
            padding: 8px 12px;
            background: var(--espresso);
        }

        /* BAD: Timeline heading uses Playfair after Oswald labels — inconsistent again */
        .bad-timeline h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--linen);
            margin: 0 0 6px;
        }

        /* BAD: All five timeline entries dumped as a single dense paragraph blob,
                no year labels, no visual grouping, no separation between entries */
        .bad-timeline-blob {
            font-family: 'Courier Prime', monospace;
            font-size: 0.72rem;
            color: rgba(245,245,240,0.6);
            line-height: 1.35;
            margin: 0;
        }

        /* ── QUOTE ──────────────────────────────── */
        /* BAD: Almost no vertical spacing from timeline above */
        .bad-quote {
            background: var(--mocha);
            padding: 8px 12px;
            text-align: left; /* BAD: Quote not centered, feels like body text */
        }

        /* BAD: Quote text uses Oswald — wrong tone for a warm human quote */
        .bad-quote p {
            font-family: 'Oswald', sans-serif;
            font-size: 0.88rem;
            font-weight: 300;
            color: var(--linen);
            margin: 0 0 2px;
            line-height: 1.3;
        }

        /* BAD: Attribution uses Courier Prime — wildly different from the quote above it */
        .bad-quote cite {
            font-family: 'Courier Prime', monospace;
            font-size: 0.6rem;
            color: var(--sand);
        }

        /* ── VALUES ─────────────────────────────── */
        /* BAD: Minimal top padding — barely separated from quote block */
        .bad-values {
            padding: 6px 12px;
            background: #fff;
        }

        /* BAD: Values heading switches back to Playfair — 4th font style shift so far */
        .bad-values h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--espresso);
            margin: 0 0 5px;
        }

        /* BAD: All four values crammed into one dense paragraph block, no cards or icons */
        .bad-values-blob {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.75rem;
            color: #7A6355;
            line-height: 1.4;
            margin: 0;
        }

        /* BAD: Values listed inline with just dashes — no grouping, no icons, no spacing */
        .bad-values-blob span {
            font-family: 'Oswald', sans-serif; /* BAD: inline font switch inside a paragraph */
            font-weight: 600;
            font-size: 0.72rem;
            text-transform: uppercase;
        }

        /* ── TEAM ───────────────────────────────── */
        /* BAD: 4px gap from values — indistinguishable from previous section */
        .bad-team {
            padding: 5px 12px 8px;
            background: var(--espresso);
        }

        /* BAD: Team heading uses Courier Prime — monospace heading on dark bg */
        .bad-team h2 {
            font-family: 'Courier Prime', monospace;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--linen);
            margin: 0 0 4px;
        }

        /* BAD: Team members all dumped as one run-on block. 
                No avatar, no role label hierarchy, no padding between members */
        .bad-team-blob {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.73rem;
            color: rgba(245,245,240,0.55);
            line-height: 1.35;
            margin: 0;
        }

        /* BAD: Name uses yet another inline font — Oswald — mid-paragraph */
        .bad-team-blob strong {
            font-family: 'Oswald', sans-serif;
            font-size: 0.75rem;
            color: var(--cream);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        /* BAD: Role is styled same size/weight as body — no visual hierarchy */
        .bad-team-blob em {
            font-family: 'Courier Prime', monospace;
            font-style: italic;
            color: var(--sand);
            font-size: 0.7rem;
        }

        /* ── FOOTER CTA ─────────────────────────── */
        /* BAD: No gap from team section — flows right into it */
        .bad-footer-cta {
            background: var(--espresso);
            border-top: 1px solid rgba(194,178,128,0.12);
            padding: 6px 12px;
        }

        /* BAD: CTA heading uses DM Sans — 4th typeface in this section */
        .bad-footer-cta h2 {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--linen);
            margin: 0 0 3px;
        }

        .bad-footer-cta p {
            font-family: 'Courier Prime', monospace;
            font-size: 0.67rem;
            color: rgba(245,245,240,0.45);
            margin: 0 0 5px;
            line-height: 1.3;
        }

        /* BAD: CTA button — tiny, left-aligned, no prominence */
        .bad-cta-btn {
            font-family: 'Oswald', sans-serif;
            font-size: 0.68rem;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            background: var(--sand);
            color: var(--espresso);
            padding: 3px 10px;
            text-decoration: none;
            display: inline-block;
            margin-right: 4px;
        }
        .bad-ghost-btn {
            font-family: 'Courier Prime', monospace;
            font-size: 0.65rem;
            color: rgba(245,245,240,0.5);
            text-decoration: underline;
            display: inline-block;
        }

        /* BAD: Footer bar — no padding, barely visible */
        .bad-footer-bar {
            background: var(--espresso);
            border-top: 1px solid rgba(194,178,128,0.08);
            padding: 3px 12px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 2px;
        }
        /* BAD: Brand uses Playfair, txt uses Courier — two fonts in one footer bar */
        .bad-footer-brand {
            font-family: 'Playfair Display', serif;
            font-size: 0.72rem;
            font-weight: 900;
            color: rgba(245,245,240,0.35);
        }
        .bad-footer-brand span { color: var(--sand); }
        .bad-footer-txt {
            font-family: 'Courier Prime', monospace;
            font-size: 0.58rem;
            color: rgba(245,245,240,0.2);
        }
    </style>
</head>
<body>

<!-- BAD: Navbar crammed, three fonts in one bar, minimal padding -->
<div class="bad-nav">
    <a href="../../index.php" class="bad-nav-brand">☕ Mindflayer.</a>
    <ul class="bad-nav-links">
        <li><a href="../ProductListPage/products.php">Menu</a></li>
        <li><a href="about.php">Our Story</a></li>
        <li><a href="../../index.php#experience">Experience</a></li>
        <li><a href="../../index.php#contact">Locations</a></li>
        <li><a href="../ProfilePage/profile.php">Profile</a></li>
    </ul>
    <a href="../SignupPage/login.php" class="bad-nav-cta">Sign Up</a>
</div>


<!-- BAD: Hero — no section breathing room, dense text dump, inconsistent fonts -->
<div class="bad-hero">
    <p class="bad-hero-eye">Est. 2020 · Makati City</p>
    <!-- BAD: H1 in Playfair after an Oswald eyebrow — jarring font switch -->
    <h1>We didn't open a coffee shop. We built a ritual.</h1>
    <!-- BAD: Dense paragraph with no spacing from h1. Manifesto and intro merged into one block -->
    <p>Mindflayer Coffee started in 2020 as a 10-sqm corner stall in Salcedo Village. We believe coffee is more than caffeine. It's the five minutes before a hard day begins, the slow Sunday morning, the first sip that tells you today will be okay. We make drinks that earn that moment. Every decision we make — where we source our beans, how we pay our farmers, what goes into a recipe, how we design a space — comes back to one question: does this make the moment better? If the answer is yes, we do it. If it isn't, we don't. We've served 5,000+ regulars across 3 branches using 100% real ingredients for 4+ years of craft.</p>
</div>


<!-- BAD: Timeline section — no top gap, heading font shifts again, all entries as one blob -->
<div class="bad-timeline">
    <!-- BAD: Section label in Oswald, heading in Playfair — immediate font clash -->
    <p class="bad-section-label">How We Got Here</p>
    <h2>Five years. One cup at a time.</h2>

    <!-- BAD: All 5 timeline entries crammed into a single dense paragraph,
              no year labels, no visual separation, no readable structure -->
    <p class="bad-timeline-blob">
        <?php foreach ($timeline as $i => $entry): ?>
        (<?= $entry['year'] ?>) <?= $entry['title'] ?>: <?= $entry['body'] ?><?= $i < count($timeline)-1 ? ' — ' : '' ?>
        <?php endforeach; ?>
    </p>
</div>


<!-- BAD: Quote immediately after timeline with no gap, left-aligned, wrong font -->
<div class="bad-quote">
    <p>"Good coffee doesn't have to be complicated. It just has to be honest."</p>
    <cite>— Daniel Ling, Founder of Mindflayer</cite>
</div>


<!-- BAD: Values — 6px padding from quote, no icons, all 4 values in one run-on paragraph -->
<div class="bad-values">
    <p class="bad-section-label">What Drives Us</p>
    <h2>Things we refuse to compromise on.</h2>

    <!-- BAD: Dense text block — no icons, no cards, no grouping, inline font switches -->
    <p class="bad-values-blob">
        <span>Ethically Sourced</span> — <?= $values[0]['body'] ?>
        <span>Made to Order</span> — <?= $values[1]['body'] ?>
        <span>Zero Waste Goals</span> — <?= $values[2]['body'] ?>
        <span>Crew Over Everything</span> — <?= $values[3]['body'] ?>
    </p>
</div>


<!-- BAD: Team — 5px top padding, heading uses Courier Prime, all members as one blob -->
<div class="bad-team">
    <p class="bad-section-label">The People Behind the Bar</p>
    <!-- BAD: Team heading in Courier Prime — monospace on dark bg, hard to read -->
    <h2>You'll recognize them. They remember you too.</h2>

    <!-- BAD: All 5 team members dumped as a single dense paragraph.
              No avatars, no role hierarchy, no card separation.
              Names use Oswald mid-sentence, roles use Courier italic — 3 fonts in one blob -->
    <p class="bad-team-blob">
        <?php foreach ($team as $i => $member): ?>
        <strong><?= $member['name'] ?></strong> — <em><?= $member['role'] ?></em>: <?= $member['note'] ?><?= $i < count($team)-1 ? ' | ' : '' ?>
        <?php endforeach; ?>
    </p>
</div>


<!-- BAD: Footer CTA — no gap from team, heading in DM Sans, paragraph in Courier -->
<div class="bad-footer-cta">
    <!-- BAD: CTA heading in DM Sans after entire page of serif/mono mix -->
    <h2>Now you know our story. Come be part of it.</h2>
    <p>Three branches, one menu, zero shortcuts. Open 7AM–10PM daily. Salcedo Village · BGC · Poblacion</p>
    <!-- BAD: Buttons left-aligned, mismatched fonts, no visual prominence -->
    <a href="../ProductListPage/products.php" class="bad-cta-btn">Explore Menu</a>
    <a href="../../index.php" class="bad-ghost-btn">Back to Home</a>
</div>


<!-- BAD: Footer bar — 3px padding, two fonts, barely legible -->
<div class="bad-footer-bar">
    <span class="bad-footer-brand">Mindflayer<span>.</span></span>
    <span class="bad-footer-txt">&copy; <?= $year ?> Mindflayer Coffee · Brewed with intention. Served with soul.</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>