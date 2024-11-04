<?php
 include('../includes/components/navbar.php');
include('../includes/components/product-card.php');
include('../includes/components/carousel.php');
include('../includes/components/footer.php');
include("../includes/db_connect.php");

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

$sql="
WITH TopProducts AS (
    SELECT 
        p.id AS productId,
        p.name AS productName,
        p.price AS productPrice,
        p.description AS productDescription,
        p.category_id,
        ROW_NUMBER() OVER (PARTITION BY p.category_id ORDER BY p.id) AS row_num
    FROM 
        products p
)
SELECT 
    tp.productId,
    tp.productName,
    tp.productPrice,
    tp.productDescription,
    tp.category_id,
    v.id AS variantId,
    v.name AS variantName,
    v.color AS variantColor,
    v.quantity AS variantQuantity,
    v.image AS variantImage
FROM 
    TopProducts tp
JOIN 
    variants v ON tp.productId = v.product_id
WHERE 
    tp.row_num <= 2
ORDER BY 
    tp.category_id, tp.productId, v.id;
";
// Execute the query
$results = $conn->query($sql);

// Check for errors
if (!$results) {
    die("Query Error: " . $conn->error);
}

// Process data into desired structure
$allProductItems = [];
$currentProductId = null;

foreach ($results as $row) {
    if ($row['productId'] !== $currentProductId) {
        // New product entry
        $currentProductId = $row['productId'];
        $allProductItems[] = [
            'id' => $row['productId'],
            'name' => $row['productName'],
            'price' => $row['productPrice'],
            'description' => $row['productDescription'],
            'variants' => []
        ];
    }
    
    // Add variant to the latest product entry
    $allProductItems[count($allProductItems) - 1]['variants'][] = [
        'variantId' => $row['variantId'],
        'variantName' => $row['variantName'],
        'variantColor' => $row['variantColor'],
        'quantity' => $row['variantQuantity'],
        'image' => $row['variantImage']
    ];
}

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

