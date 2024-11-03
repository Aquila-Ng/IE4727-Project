<?php
include('../includes/components/navbar.php');
include('../includes/components/product-description-card.php');
include('../includes/components/color-variants.php');
include('../includes/components/quantity-control.php');
include('../includes/components/footer.php');
$allProductDescriptionItems = [
    [
        'id' => 1,
        'name' => "Legacy Noble Classic",
        'description' => "Embrace the celestial beauty of the Legacy Lunar Majesty. This exquisite timepiece features a stunning moonphase complication, allowing you to track the moon's cycles as you navigate life's adventures. Its elegant design, complemented by refined details, makes it the perfect companion for those who appreciate the harmony of time and nature.",
        'price' => 750,
        'variants' => [
            [
                'variantId' => 1,
                'variantName' => "Classic Black",
                'variantColor' => "#322f2e",
                'quantity' => 0,
                'galleryImages' => [
                    '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png',
                    '../assets/images/products/watch/legacy-noble-classic/classic-black/front.png',
                    '../assets/images/products/watch/legacy-noble-classic/classic-black/portrait.png',
                    '../assets/images/products/watch/legacy-noble-classic/classic-black/front-face.png',
                    '../assets/images/products/watch/legacy-noble-classic/classic-black/back.png',
                ],
            ],
            [
                'variantId' => 2,
                'variantName' => "Elegant Charm",
                'variantColor' => "#ece8e1",
                'quantity' => 4,
                'galleryImages' => [
                    '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png',
                    '../assets/images/products/watch/legacy-noble-classic/elegant-charm/front.png',
                    '../assets/images/products/watch/legacy-noble-classic/elegant-charm/back.png',
                    '../assets/images/products/watch/legacy-noble-classic/elegant-charm/front-face.png',
                    '../assets/images/products/watch/legacy-noble-classic/elegant-charm/back-face.png',
                ],
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
    <main class="content mb-2">
        <div class="container pt-5"> 
            <div class="row gap-6">
                <div class="col-7 long-content">
                    <?php
                        allProductDescription($allProductDescriptionItems[0]['variants']);
                    ?>
                </div> 
                <div class="product-description col px-5">
                    <div class="short-content">
                        <h1 class="emphasized"><?php echo htmlspecialchars($allProductDescriptionItems[0]['name']); ?></h1> 
                        <h2 class="variant-name emphasized" ><?php echo htmlspecialchars($allProductDescriptionItems[0]['variants'][0]['variantName']); ?></h2> 
                        <h3 class="emphasized">$<?php echo htmlspecialchars(number_format($allProductDescriptionItems[0]['price'], 2)); ?></h3>
                        <?php
                            renderColorVariants(false, $allProductDescriptionItems[0]['id'], $allProductDescriptionItems[0]['variants']);
                        ?>
                        <h3 class="emphasized">Quantity</h3>
                        <?php
                            foreach ($allProductDescriptionItems[0]['variants'] as $index => $variant) {
                                ?>
                                <div class="variant-description" data-variant-id=<?php echo htmlspecialchars($variant['variantId']); ?>>
                                    <?php
                                        $isQuantityNotZero = ($variant['quantity'] != 0); 
                                        renderQuantityControl($variant['variantId'], ($isQuantityNotZero ? 1 : 0), $variant['quantity']);
                                    ?>
                                    <button class="<?php echo ($isQuantityNotZero ? 'open-modal' : '') ?> btn btn-primary full mt-3" <?php echo ($isQuantityNotZero ? '' : 'disabled') ?>>
                                        <h4 class="my-1"><?php echo ($isQuantityNotZero ? "Add to Cart" : "Out of Stock") ?></h4>
                                    </button>
                                </div>
                                <?php
                            }
                        ?>
                        
                        <p class="mt-3"><?php echo htmlspecialchars($allProductDescriptionItems[0]['description']); ?></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="overlay" class="modal justify-center items-center" data-variant-id="">
            <div class="modal-content justify-start">
                <span class="close-btn">&times;</span>
                <h1 class="emphasized">Item has been added to cart</h1>
                <div class="row">
                    <div class="col-6 modal-image-wrapper">
                        <img id="modalVariantImage" src="<?php echo htmlspecialchars($allProductDescriptionItems[0]['variants'][0]['galleryImages'][0]); ?>"/>
                    </div>
                    <div class="col text-left">
                        <h4 id="modalProductName" class="emphasized"><?php echo htmlspecialchars($allProductDescriptionItems[0]['name']); ?></h4> <!-- Fixed to echo the name -->
                        <h5 id="modalVariantName" class="emphasized"><?php echo htmlspecialchars($allProductDescriptionItems[0]['variants'][0]['variantName']); ?></h5>
                        <h5 id="modalProductPrice" class="emphasized">$<?php echo htmlspecialchars(number_format($allProductDescriptionItems[0]['price'], 2)); ?></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="close-modal btn btn-transparent full" onclick="window.location.href='product-listing.php'">Continue Shopping</button>
                    </div>
                    <div class="col">
                        <button class="close-modal btn btn-primary full" onclick="window.location.href='cart.php'">Shopping Cart</button>
                    </div>
                </div>
                
            </div>
        </div>

    </main>
    <?php
        footer(true);
    ?>
    <script>
        const allProductDescriptionItems = <?php echo json_encode($allProductDescriptionItems); ?>;
    </script>
    <script type="module" src="../assets/js/pages/product-description.js"></script>
</body>
</html>
