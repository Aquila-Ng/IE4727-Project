<?php
 include('../includes/components/navbar.php');
include('../includes/components/product-card.php');
include('../includes/components/carousel.php');
include('../includes/components/footer.php');

$carouselItems = [
    [
        'image' => '../assets/images/banner/hero-banner-image-3.png',
        'title' => 'Chica Crossbody Bag',
        'description' => 'Versatile crossbody handbag for both casual and formal looks',
    ],
    [
        'image' => '../assets/images/banner/hero-banner-image-4.png',
        'title' => 'Pamo Tote Bag',
        'description' => 'Patterned tote bag with motif and leather accents',
    ],
    [
        'image' => '../assets/images/banner/hero-banner-image-6.png',
        'title' => 'Emua Watch',
        'description' => 'Classic sleek watch with golden accents',
    ],
    [
        'image' => '../assets/images/banner/hero-banner-image-2.png',
        'title' => 'Dolla Shoulder Bag',
        'description' => 'Timeless sophistication with the sleek black shoulder bag',
    ]
];
$allProductItems = [
    [
        'id' => 0,
        'name' => 'Legacy Lunar Heritage',
        'price' => 750,
        'variants' => [
            [
                'variantId' => 0,
                'variantName' => 'Classic Elegance',
                'variantColor' => '#dcd7d1',
                'quantity' => 0,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/main.png',
            ],
            [
                'variantId' => 1,
                'variantName' => 'Timeless White',
                'variantColor' => '#e0e0e0',
                'quantity' => 5,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/main.png',
            ],
            [
                'variantId' => 2,
                'variantName' => 'Midnight Blue',
                'variantColor' => '#004678',
                'quantity' => 10,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png',
            ],
            [
                'variantId' => 3,
                'variantName' => 'Emerald Green',
                'variantColor' => '#025a38',
                'quantity' => 11,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/main.png',
            ],
            [
                'variantId' => 4,
                'variantName' => 'Sleek Anthracite',
                'variantColor' => '#9c9e9d',
                'quantity' => 12,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/main.png',
            ],
            [
                'variantId' => 5,
                'variantName' => 'Bronze Charm',
                'variantColor' => '#d9ad7c',
                'quantity' => 13,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/main.png',
            ],
        ],
    ],
    [
        'id' => 1,
        'name' => 'Legacy Noble Classic',
        'price' => 700,
        'variants' => [
            [
                'variantId' => 6,
                'variantName' => 'Classic Black',
                'variantColor' => '#322f2e',
                'quantity' => 5,
                'image' => '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png',
            ],
            [
                'variantId' => 7,
                'variantName' => 'Elegant Charm',
                'variantColor' => '#ece8e1',
                'quantity' => 10,
                'image' => '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png',
            ],
        ],
    ],
    [
        'id' => 12,
        'name' => "Timeless Verve Quilted Backpack",
        'description' => "The Timeless Verve Quilted Backpack combines elegance with practicality, offering ample space and a quilted design that stands out.",
        'price' => 345,
        'variants' => [
            [
                'variantId' => 38,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/black/main.png',
            ],
            [
                'variantId' => 39,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/white/main.png',
            ],
            [
                'variantId' => 40,
                'variantName' => "Vintage Brown",
                'variantColor' => "#5A4036",
                'quantity' => 13,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/main.png',
            ],
        ],
    ],
    [
        'id' => 13,
        'name' => "Timeless Verve Pouch",
        'description' => "The Timeless Verve Pouch is a compact yet stylish accessory, ideal for keeping essentials within easy reach.",
        'price' => 175,
        'variants' => [
            [
                'variantId' => 41,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/black/main.png',
            ],
            [
                'variantId' => 42,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/white/main.png',
            ],
            [
                'variantId' => 43,
                'variantName' => "Blueberry",
                'variantColor' => "#2063a4",
                'quantity' => 0,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/blueberry/main.png',
            ],
        ],
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/icons/serene-logo.svg">
    <title>SERENE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body class="m-0">
    <?php
       navbar(true);
    ?>
    <main>
        <div class="container-fluid p-0">
            <?php
                carousel(true, $carouselItems);
                ?>
            </div>
        <div class="container pt-2">
            <h2 class="emphasized">Featured Products</h2>
        </div>
        <div class="container d-flex flex-wrap justify-center pb-2">
            <?php
                all_product_cards(true, $allProductItems);
            ?>     
        </div>
    </main>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/pages/index.js"></script>
</body>
</html>

