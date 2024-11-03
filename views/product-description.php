<?php
include('../includes/components/navbar.php');
include('../includes/components/product-description-card.php');
include('../includes/components/color-variants.php');
include('../includes/components/quantity-control.php');
include('../includes/components/footer.php');
include("../includes/db_connect.php");

$productId=1;
$sql = "
    SELECT 
        p.id AS productId,
        p.name AS productName,
        p.description AS productDescription,
        p.price AS productPrice,
        v.id AS variantId,
        v.name AS variantName,
        v.color AS variantColor,
        v.quantity AS variantQuantity,
        vi.image AS variantImage
    FROM 
        products p
    JOIN 
        variants v ON p.id = v.product_id
    JOIN 
        variant_images vi ON v.id = vi.variant_id
    WHERE 
        p.id= $productId
    ORDER BY 
        p.id, v.id, vi.id;
";

$result = $conn->query($sql);

$allProductDescriptionItems = [];
$currentProductId = null;
$currentVariantId = null;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Check if we are on a new product
        if ($currentProductId !== $row['productId']) {
            $currentProductId = $row['productId'];
            $currentVariantId = null;

            // Add a new product entry
            $allProductDescriptionItems[] = [
                'id' => $row['productId'],
                'name' => $row['productName'],
                'description' => $row['productDescription'],
                'price' => $row['productPrice'],
                'variants' => [],
            ];
        }

        // Reference to the last added product for variant insertion
        $currentProduct = &$allProductDescriptionItems[count($allProductDescriptionItems) - 1];

        // Check if we are on a new variant
        if ($currentVariantId !== $row['variantId']) {
            $currentVariantId = $row['variantId'];

            // Add a new variant entry
            $currentProduct['variants'][] = [
                'variantId' => $row['variantId'],
                'variantName' => $row['variantName'],
                'variantColor' => $row['variantColor'],
                'quantity' => $row['variantQuantity'],
                'galleryImages' => [],
            ];
        }

        // Reference to the last added variant for image insertion
        $currentVariant = &$currentProduct['variants'][count($currentProduct['variants']) - 1];

        // Append image to the current variant's gallery
        $currentVariant['galleryImages'][] = $row['variantImage'];
    }
} else {
    echo "No products found.";
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
