<?php
 include('../includes/components/navbar.php');
 include('../includes/components/product-card.php');
 include('../includes/components/footer.php');
 include('../includes/components/filter-and-sort.php');
include("../includes/db_connect.php");

// Define dynamic parameters for filtering
$categoryId = 1;          // Set this to the desired category ID
$minPrice = 200;          // Set to the minimum price, or leave null if no lower bound
$maxPrice = 760;          // Set to the maximum price, or leave null if no upper bound
// $sortOrder = "ASC";       // Use "ASC" for ascending and "DESC" for descending

// Base SQL query
$sql = "
    SELECT 
        p.id AS productId,
        p.name AS productName,
        p.price AS productPrice,
        p.description AS productDescription,
        v.id AS variantId,
        v.name AS variantName,
        v.color AS variantColor,
        v.quantity AS variantQuantity,
        v.image AS variantImage
    FROM 
        products p
    JOIN 
        variants v ON p.id = v.product_id
";
// Check if any conditions are set and manage the WHERE clause
$conditions = []; // Array to hold condition strings

if (isset($categoryId)) {
    $conditions[] = "p.category_id = $categoryId"; // Add category condition
}

if (isset($minPrice)) {
    $conditions[] = "p.price >= $minPrice"; // Add min price condition
}

if (isset($maxPrice)) {
    $conditions[] = "p.price <= $maxPrice"; // Add max price condition
}

// If there are conditions, add them to the SQL query
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}
if(isset($sortOrder)){
    $sql .= " ORDER BY p.price $sortOrder, v.id";
}else{
    $sql .= " ORDER BY p.id, v.id";
}



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

// // Output the result (for testing purposes)
// echo "<pre>";
// print_r($allProductItems);
// echo "</pre>";
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
    <main class="content">
        <div id="overlay">
        </div>
        <div class="container pt-2">
            <h2 class="emphasized">Category</h2>
                <?php
                    filterAndSort(100,6000);
                ?>
        </div>
        <?php
            if($inValid){
                ?>
                <div class="container pt-2">
                    <h3 class="danger emphasized m-0 py-1 pl-3" style="border: none; border-radius: var(--spacing-xs); overflow: hidden;"><?php echo htmlspecialchars($errorMessage)?></h3>
                </div>
                <?php
            }
        ?>
        <div id="product-container" class="container d-flex flex-wrap justify-start pb-2 ma">
            <?php
                all_product_cards(false, $allProductItems);
            ?>     
        </div>
    </main>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/pages/product-listing.js"></script>
    <script>

        </script>
</body>
</html>
