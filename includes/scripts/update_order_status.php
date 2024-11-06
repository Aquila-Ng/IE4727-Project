<?php
// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID and status ID from the form submission
    $orderId = isset($_POST['orderId']) ? (int)$_POST['orderId'] : 0;
    $statusId = isset($_POST['statusId']) ? (int)$_POST['statusId'] : 0;

    // Output the values for debugging
    echo "Order ID: " . $orderId . "<br>";
    echo "Status ID: " . $statusId;
}
?>

