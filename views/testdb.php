<?php
// Database connection (adjust credentials as needed)
include("../includes/db_connect.php");

// Define dynamic parameters for filtering
$categoryId = 1;          // Set this to the desired category ID
$minPrice = 500;          // Set to the minimum price, or leave null if no lower bound
$maxPrice = 760;          // Set to the maximum price, or leave null if no upper bound
$sortOrder = "ASC";       // Use "ASC" for ascending and "DESC" for descending

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
    WHERE
        p.category_id = $categoryId
";

// Add dynamic conditions for price range
if (isset($minPrice)) {
    $sql .= " AND p.price >= $minPrice";
}
if (isset($maxPrice)) {
    $sql .= " AND p.price <= $maxPrice";
}

// Add ORDER BY clause
$sql .= " ORDER BY p.price $sortOrder, v.id";

// Execute the query
$result = $conn->query($sql);

// Check for errors
if (!$result) {
    die("Query Error: " . $conn->error);
}

// Fetch results
$resultsArray = [];
while ($row = $result->fetch_assoc()) {
    $resultsArray[] = $row;
}

// Display or process results
print_r($resultsArray);

// Close the connection
$conn->close();
?>
