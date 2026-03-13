<?php
// pages/ProductDetailsPage/productdetails.php

session_start();

require_once __DIR__ . '/../ProductListPage/products-data.php';

$productId = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$selectedProduct = null;
foreach ($products as $product) {
    if ($product['id'] === $productId) {
        $selectedProduct = $product;
        break;
    }
}

if (!$selectedProduct) {
    header('Location: /Mindflayers/pages/ProductListPage/products.php');
    exit;
}

function html($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$iconMap = [
    'specs'    => 'bi-list-check',
    'reviews'  => 'bi-chat-square-text',
    'shipping' => 'bi-truck',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html($selectedProduct['name']) ?> · Mindflayer Coffee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
    <style>
        body { background: #F9F7F3; font-family: 'DM Sans', sans-serif; }
        .card-hero { border: 1px solid rgba(0,0,0,.06); border-radius: 0.8rem; background: #fff; }
        .card-hero img { border-top-left-radius: 0.8rem; border-top-right-radius: 0.8rem; }
        .modal-content { border-radius: 1rem; overflow: hidden; }
        .modal-header { border-bottom: 1px solid #e8e5e0; background: linear-gradient(110deg, #f8f1e8, #fff7ef); }
        .modal-body { background: radial-gradient(circle at top left, #fffaf3 0%, #fef9f5 60%, #f6efe4 100%); }
        .section-heading { font-family: var(--font-serif); font-weight: 700; margin-top: 1.2rem; margin-bottom: 0.75rem; text-transform: uppercase; font-size: 1.05rem; letter-spacing: 0.06em; color: #5b3f2f; }
        .section-heading i { margin-right: 0.4rem; color: #8b5e3c; }
        .tag-badge { border-radius: 0.45rem; padding: 0.22rem 0.65rem; }
        .tasting-badge { background: #fff; border: 1px solid #e2dace; border-radius: 0.55rem; color: #6b5138; }
        .spec-row { margin-bottom: 0.55rem; }
        .spec-label { color: #7b5b4a; font-weight: 500; }
        .ship-list li { margin-bottom: 0.45rem; }
        .product-banner { border-left: 4px solid #8C6647; padding-left: 0.85rem; margin-top: 1.2rem; }
        .tag-badge { font-size: 0.75rem; border-radius: 0.35rem; }
        .btn-brown { background: #8b5e3c; color: #fff; border-color: #8b5e3c; }
        .btn-brown:hover { background: #79523a; color: #fff; }
        .spec-card { background: #fff; border: 1px solid #e6dfd4; border-radius: 0.75rem; padding: 0.95rem; min-height: 76px; transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .spec-card:hover { transform: translateY(-2px); box-shadow: 0 6px 18px rgba(0,0,0,0.08); }
        .spec-card-title { display: flex; align-items: center; gap: 0.45rem; font-weight: 600; color: #5d3f2a; margin-bottom: 0.35rem; }
        .spec-card-title i { color: #8c6a4f; }
        .spec-card-value { color: #6f5b50; font-size: 0.9rem; }
        /* Modal: left landscape image gallery */
        .modal-gallery-left { flex: 0 0 42%; max-width: 42%; }
        .modal-gallery-main {
            aspect-ratio: 16 / 10;
            border-radius: 0.65rem;
            overflow: hidden;
            background: #E8D8B0;
            border: 1px solid #e6dac8;
        }
        .modal-gallery-main img { width: 100%; height: 100%; object-fit: cover; }
        @media (max-width: 767px) { .modal-gallery-left { flex: 0 0 100%; max-width: 100%; order: -1; } }
    </style>
</head>
<body>
<header class="py-3 bg-white border-bottom">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn btn-link text-decoration-none">
            <i class="bi bi-chevron-left"></i> Back to Menu
        </a>
        <a href="/Mindflayers/pages/ProductListPage/products.php" class="btn btn-outline-dark btn-sm">Menu</a>
    </div>
</header>

<main class="container py-5">
    <div class="card card-hero overflow-hidden shadow-sm">
        <img src="<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>" class="img-fluid" style="max-height: 420px; object-fit: cover; width: 100%;">
        <div class="card-body p-4">
            <h1 class="h2"><?= html($selectedProduct['name']) ?></h1>
            <p class="text-secondary mb-2"><?= html($selectedProduct['tagline']) ?></p>
            <div class="d-flex align-items-center flex-wrap gap-2 mb-3">
                <span class="badge bg-warning text-dark tag-badge"><?= html($selectedProduct['badge']) ?></span>
                <span class="badge bg-secondary text-white tag-badge"><?= html($selectedProduct['category']) ?></span>
                <span class="badge bg-light text-dark tag-badge"><?= html($selectedProduct['volume']) ?></span>
            </div>

            <div class="row gy-3">
                <div class="col-md-5">
                    <div class="p-3 rounded-3 h-100" style="background:#FBF7F2;">
                        <h5 class="section-heading"><i class="bi bi-bag-heart"></i> Quick Info</h5>
                        <p class="mb-2"><strong>Price:</strong> ₱<?= number_format($selectedProduct['price']) ?></p>
                        <p class="mb-2"><strong>Calories:</strong> <?= html($selectedProduct['calories']) ?></p>
                        <p class="mb-2"><strong>Rating:</strong> <?= number_format($selectedProduct['rating'], 1) ?> <i class="bi bi-star-fill text-warning"></i> (<?= html($selectedProduct['reviews']) ?> reviews)</p>
                        <a href="#productDetailModal" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#productDetailModal">
                            Open Full Product Modal
                        </a>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="p-3 rounded-3" style="background:#FFF8EF;">
                        <h5 class="section-heading"><i class="bi bi-lightbulb"></i> Why You’ll Love It</h5>
                        <p class="mb-0"><?= html($selectedProduct['desc']) ?></p>
                    </div>
                </div>
            </div>

            <div class="product-banner text-muted mt-4">
                <small><strong>Tip:</strong> Scroll inside the modal for segmented details: specs, reviews, shipping, and preparation callout. This is built for clarity and easy scanning.</small>
            </div>
        </div>
    </div>
</main>

<!-- Modal === -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">  
                <div>
                    <h5 class="modal-title" id="productDetailModalLabel">
                        <?= html($selectedProduct['name']) ?> <small class="text-muted">· <?= html($selectedProduct['category']) ?></small>
                    </h5>
                    <p class="mb-0 text-secondary" style="font-size: 0.9rem;">"<?= html($selectedProduct['tagline']) ?>"</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
            <div class="modal-body p-4">
                <div class="row g-4 align-items-start flex-lg-nowrap mb-4">
                    <!-- Left: single photo -->
                    <div class="modal-gallery-left col-12 col-lg-5">
                        <div class="modal-gallery-main">
                            <img src="<?= html($selectedProduct['image']) ?>" alt="<?= html($selectedProduct['name']) ?>" class="img-fluid">
                        </div>
                    </div>
                    <!-- Right: product info -->
                    <div class="col-12 col-lg-7">
                        <p class="text-muted mb-3"><?= html($selectedProduct['tagline']) ?></p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-warning text-dark"><?= html($selectedProduct['badge']) ?></span>
                            <span class="badge bg-info text-white"><?= html($selectedProduct['category']) ?></span>
                            <span class="badge bg-light text-dark"><?= html($selectedProduct['volume']) ?></span>
                        </div>
                        <div class="row g-2 mb-3 text-smaller" style="font-size:0.93rem;">
                            <div class="col-6"><i class="bi bi-currency-dollar"></i> <strong>Price:</strong> ₱<?= number_format($selectedProduct['price']) ?></div>
                            <div class="col-6"><i class="bi bi-thermometer-half"></i> <strong>Calories:</strong> <?= html($selectedProduct['calories']) ?></div>
                            <div class="col-6"><i class="bi bi-star-fill text-warning"></i> <strong>Rating:</strong> <?= number_format($selectedProduct['rating'],1) ?> ⭐</div>
                            <div class="col-6"><i class="bi bi-chat-dots"></i> <strong>Reviews:</strong> <?= html($selectedProduct['reviews']) ?></div>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <form method="post" action="/Mindflayers/pages/ShoppingCartPage/shoppingcart.php" class="m-0">
                                <input type="hidden" name="product_id" value="<?= (int) $selectedProduct['id'] ?>">
                                <button type="submit" class="btn btn-brown text-white">
                                    <i class="bi bi-cart-fill"></i> Add to Cart <i class="bi bi-plus-circle ms-1"></i>
                                </button>
                            </form>
                            <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                <i class="bi bi-x-lg"></i> Close
                            </button>
                        </div>
                    </div>
                </div>

                <section class="mb-4">
                    <h6 class="section-heading"><i class="bi bi-info-circle"></i> About this drink</h6>
                    <p><?= html($selectedProduct['desc']) ?></p>
                    <div class="d-flex flex-wrap gap-2 mt-3">
                        <span class="badge bg-light text-dark p-2 border"><i class="bi bi-heart-fill text-danger"></i> Cozy Flavor</span>
                        <span class="badge bg-light text-dark p-2 border"><i class="bi bi-lightning-fill text-warning"></i> Energy Boost</span>
                        <span class="badge bg-light text-dark p-2 border"><i class="bi bi-emoji-smile-fill text-success"></i> Feel Good</span>
                    </div>
                </section>

                <section class="mb-4">
                    <h6 class="section-heading"><i class="bi bi-clipboard-data"></i> Taste Profile</h6>
                    <div class="row g-2 text-muted" style="font-size:0.92rem;">
                        <div class="col-6"><i class="bi bi-droplet-half"></i> Creamy</div>
                        <div class="col-6"><i class="bi bi-stars"></i> Sweet</div>
                        <div class="col-6"><i class="bi bi-flower1"></i> Floral</div>
                        <div class="col-6"><i class="bi bi-snow"></i> Cool Finish</div>
                    </div>
                </section>

                <section class="mb-4">
                    <h4 class="section-heading" style="font-size:1.2rem; font-family:var(--font-serif);"> <i class="bi bi-list-check"></i> Key Specifications</h4>
                    <div class="row g-2 mb-3">
                        <?php
                        $mainSpecs = array_filter($selectedProduct['specs'], function ($spec) {
                            return in_array(strtolower($spec['label']), ['temperature', 'base', 'milk', 'caffeine']);
                        });
                        ?>
                        <?php foreach ($mainSpecs as $spec): ?>
                            <?php
                            $specIcon = match(strtolower($spec['label'])) {
                                'temperature' => 'bi-thermometer-half',
                                'base' => 'bi-cup-straw',
                                'milk' => 'bi-droplet-half',
                                'caffeine' => 'bi-lightning-charge',
                                default => $spec['icon'] ?? 'bi-chevron-right',
                            };
                            ?>
                            <div class="col-6 col-md-3">
                                <div class="p-2 rounded-3 border bg-white text-center" style="min-height:88px;">
                                    <i class="bi <?= html($specIcon) ?> fs-3 text-brown"></i>
                                    <div class="fw-bold" style="font-size:0.9rem;"><?= html($spec['label']) ?></div>
                                    <small class="text-secondary"><?= html($spec['value']) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row g-3">
                        <?php foreach ($selectedProduct['specs'] as $spec): ?>
                            <?php
                            $specIcon = match(strtolower($spec['label'])) {
                                'temperature' => 'bi-thermometer-half',
                                'base' => 'bi-cup-straw',
                                'milk' => 'bi-droplet-half',
                                'caffeine' => 'bi-lightning-charge',
                                default => $spec['icon'] ?? 'bi-chevron-right',
                            };
                            ?>
                            <div class="col-12 col-sm-6 col-xl-4">
                                <article class="spec-card">
                                    <div class="spec-card-title">
                                        <i class="bi <?= html($specIcon) ?> fs-5"></i>
                                        <?= html($spec['label']) ?>
                                    </div>
                                    <div class="spec-card-value"><?= html($spec['value']) ?></div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>


            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/scripts.js"></script>

</body>
</html>
