<?php
 include('includes/components/navbar.php');
include('includes/components/product-card.php');
include('includes/components/carousel.php');
include('includes/components/footer.php');

$carouselItems = [
    [
        'image' => './assets/images/hero-banner-image-3.png',
        'title' => 'Chic Crossbody Bag',
        'description' => 'Versatile crossbody handbag for both casual and formal looks',
    ],
    [
        'image' => './assets/images/hero-banner-image-4.png',
        'title' => 'Pamo Tote Bag',
        'description' => 'Patterned tote bag with motif and leather accents',
    ],
    [
        'image' => './assets/images/hero-banner-image-2.png',
        'title' => 'Dolla Shoulder Bag',
        'description' => 'Timeless sophistication with the sleek black shoulder bag',
    ]
];

$productItems = [
    [
        'id' => '1',
        'name' => 'Awesome Product 1',
        'price' => '$19.99',
        'variantId' => ['1', '2', '3'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '2',
        'name' => 'Awesome Product 2',
        'price' => '$19.99',
        'variantId' => ['4', '5', '6'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '3',
        'name' => 'Awesome Product 3',
        'price' => '$19.99',
        'variantId' => ['7', '8', '9'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '4',
        'name' => 'Awesome Product 4',
        'price' => '$19.99',
        'variantId' => ['10', '11', '12'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '5',
        'name' => 'Awesome Product 5',
        'price' => '$19.99',
        'variantId' => ['13', '14', '15'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '6',
        'name' => 'Awesome Product 6',
        'price' => '$19.99',
        'variantId' => ['16', '17', '18'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '7',
        'name' => 'Awesome Product 7',
        'price' => '$19.99',
        'variantId' => ['19', '20', '21'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
    [
        'id' => '8',
        'name' => 'Awesome Product 8',
        'price' => '$19.99',
        'variantId' => ['22', '23', '24'],
        'colors' => ['#ff0000', '#00ff00', '#0000ff'],
        'images' => ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'],
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/styles.css" />
</head>
<body class="m-0">
    <?php
       navbar(true);
    ?>
    <div class="content">
        <div class="container-fluid p-0">
        <?php
            bannerCarousel($carouselItems);
            ?>
        </div>
        <div class="container pt-2">
            <h2 class="emphasized">Featured Products</h2>
        </div>
        <div class="container d-flex flex-wrap justify-center pb-2">
            <?php
                all_product_cards($productItems);
            ?>     
        </div>
    </div>
    <?php
        footer(true);
    ?>
    <script type="module" src="./assets/js/main.js"></script>
</body>
</html>

