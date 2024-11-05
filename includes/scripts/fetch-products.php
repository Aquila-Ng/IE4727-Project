<?php
include('./components/product-card.php');

// Example array of products (in a real application, fetch this data from a database)
$productItems = [
    ['id' => 1, 'name' => 'Product A', 'price' => 25.99, 'variantId' => 1, 'colors' => ['red', 'blue'], 'images' => ['image1.jpg']],
    ['id' => 2, 'name' => 'Product B', 'price' => 19.99, 'variantId' => 2, 'colors' => ['green', 'yellow'], 'images' => ['image2.jpg']],
    // Add more products as needed
];

// Get the sort parameter from the URL
$sortOption = $_GET['sort'] ?? '';

// Sort the products based on the selected option
if ($sortOption === 'price-asc') {
    usort($productItems, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($sortOption === 'price-desc') {
    usort($productItems, fn($a, $b) => $b['price'] <=> $a['price']);
}

// Send sorted products as JSON
header('Content-Type: application/json');
echo json_encode($productItems);
?>
