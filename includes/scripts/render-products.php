<?php
include('./components/product-card.php');

// Decode the JSON input from JavaScript
$data = json_decode(file_get_contents("php://input"), true);

// Render product cards
if ($data) {
    ob_start(); // Start output buffering
    all_product_cards($data); // Render product cards as HTML
    $html = ob_get_clean(); // Get buffered content as a string
    echo $html; // Output the HTML to JavaScript
}
?>
