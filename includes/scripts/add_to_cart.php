<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        add_to_cart($_GET["variantId"], $_GET["quantity"]);
        header("Location: ../../views/cart.php");
        // header("Location: {$_SERVER['HTTP_REFERER']}");
    }
    function add_to_cart($variant_id, $quantity) {
        if (isset($_SESSION['cart'][$variant_id])) {
            // Update quantity if the item already exists in the cart
            $_SESSION['cart'][$variant_id]['quantity'] += $quantity;
        } else {
            // Add a new item to the cart with the specified variant_id and quantity
            $_SESSION['cart'][$variant_id] = [
                'variant_id' => $variant_id,
                'quantity' => $quantity
            ];
        }
    }
?>
