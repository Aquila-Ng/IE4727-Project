<?php
    include('../includes/components/navbar.php');
    include('../includes/components/product-card.php');
    include('../includes/components/footer.php');
    include('../includes/components/filter-and-sort.php');
    // include("../includes/db_connect.php");

    include('../includes/config/db_connect.php');

$searchQuery = isset($_GET['searchQuery']) ? $_GET['searchQuery'] : NULL;
$sortOrder = isset($_GET['sortOrder']) ? "p.price " . $_GET['sortOrder'] : "p.id";
$minPrice = isset($_GET['minPrice']) ? (int) $_GET['minPrice'] : NULL;
$maxPrice = isset($_GET['maxPrice']) ? (int) $_GET['maxPrice'] : NULL;
$categoryId = null; // Initialize categoryId as null

if (isset($_GET['categoryId'])) {
    if (is_array($_GET['categoryId'])) {
        // Check if both category values are selected
        if (in_array("1", $_GET['categoryId']) && in_array("2", $_GET['categoryId'])) {
            $categoryId = null; // Set to null if both are selected
        } else {
            // If only one is selected, assign it to categoryId
            $categoryId = (int) $_GET['categoryId'][0]; // Just take the first one if not both
        }
    } else {
        // If it's a single value
        $categoryId = (int) $_GET['categoryId'];
    }
}

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

if (!is_null($categoryId)) {
    $conditions[] = "p.category_id = $categoryId"; // Add category condition
}

if (!is_null($minPrice)) {
    $conditions[] = "p.price >= $minPrice"; // Add min price condition
}

if (!is_null($maxPrice)) {
    $conditions[] = "p.price <= $maxPrice"; // Add max price condition
}

if (!is_null($searchQuery)) {
    $conditions[] = "p.name LIKE '%" . mysqli_real_escape_string($conn, $searchQuery) . "%'"; // Add search condition with sanitization
}

// If there are conditions, add them to the SQL query
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$sql .= " ORDER BY $sortOrder, v.id";

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

$inValid=true;
$errorMessage="error Message";

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
                    filterAndSort(
                        isset($minPrice) ? $minPrice : 175,
                        isset($maxPrice) ? $maxPrice : 780
                    );
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

