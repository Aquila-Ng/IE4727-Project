<?php
include('../includes/components/navbar.php');
include('../includes/components/product-description-card.php');
include('../includes/components/color-variants.php');
include('../includes/components/quantity-control.php');
include('../includes/components/footer.php');

$productDescriptionItems = [
    [
        'image' => '../assets/images/hero-banner-image-3.png',
        'variantId' => '1'
    ],
    [
        'image' => '../assets/images/hero-banner-image-4.png',
        'variantId' => '1'
    ],
    [
        'image' => '../assets/images/hero-banner-image-6.png',
        'variantId' => '2'
    ],
    [
        'image' => '../assets/images/hero-banner-image-2.png',
        'variantId' => '2'
    ]
    // ],
    // [
    //     'image' => '../assets/images/hero-banner-image-1.png',
    //     'variantId' => '2'
    // ]
];

$productColors = [
    'id' => '1',
    'name' => 'Stylish Backpack',
    'description' => 'Very good bag',
    'price' => '19.99', // Added missing comma
    'variantId' => ['1', '2'], // Only variant IDs 1 and 2
    'colors' => ['#000000', 'Navy'],
    'images'=>['','']
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
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body class="m-0">
    <?php
       navbar(true);
    ?>
    <div class="content mb-2">
        <div class="container pt-5"> 
            <div class="row gap-6">
                <div class="col-7 long-content">
                    <?php
                        productDescription($productDescriptionItems);
                    ?>
                </div> 
                <div class="product-description col px-5">
                    <div class="short-content">
                        <h1 class="emphasized"><?php echo htmlspecialchars($productColors['name']); ?></h1> <!-- Fixed to echo the name -->
                        <h3 class="emphasized">$<?php echo htmlspecialchars($productColors['price']); ?></h3> <!-- Fixed to echo the price -->
                        <?php
                            renderColorVariants(
                                false,
                                $productColors['colors'],   // Colors: Red and Green
                                $productColors['variantId'], // Variant IDs: 1 and 2
                                $productColors['images'],
                                $productColors['id']         // Product ID
                            );
                        ?>
                        <h3 class="emphasized">Quantity</h3>
                        <?php
                            renderQuantityControl(1,1);
                        ?>
                        <button class="btn btn-primary full mt-3">
                            <h4 class="my-1">Add to Cart</h4>
                        </button>
                        <p class="mt-3"><?php echo htmlspecialchars($productColors['description']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/pages/product-description.js"></script>
</body>
</html>
