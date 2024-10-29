<?php
 include('../includes/components/navbar.php');
 include('../includes/components/form.php');
 include('../includes/components/order.php');
 include('../includes/components/cart-table.php');
 include('../includes/components/footer.php');


 $userDetails = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
    'contact_number' => '1234567890',
    'address_line1' => '123 Main St',
    'address_line2' => 'Apt 4B',
    'country' => 'USA',
    'postal_code' => '10001'
];

// Example usage
$prices = [
    'item' => 3,
    'subtotal' => 39.99,
    'delivery' => 29.99,
    'gst' => 19.99,
    'total' => 89.99
];

$cartItems = [
    [
        'cartId' => 1,
        'name' => 'Leather Backpack',
        'price' => 79.99,
        'variantId' => 101,
        'quantity' => 2,
        'image' => '../assets/product-image.png',
        'variantName' => 'Brown'
    ],
    [
        'cartId' => 2,
        'name' => 'Smartwatch',
        'price' => 199.99,
        'variantId' => 102,
        'quantity' => 1,
        'image' => '../assets/product-image.png',
        'variantName' => 'Black'
    ],
    [
        'cartId' => 3,
        'name' => 'Wireless Earbuds',
        'price' => 49.99,
        'variantId' => 103,
        'quantity' => 3,
        'image' => '../assets/product-image.png',
        'variantName' => 'White'
    ],
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
        <div class="cart container">
            <div class="row">
                <h2 class="emphasized">Shopping Cart</h2>
            </div>  
            <div class="row">
                <div class="col-9">
                    <div class="long-content">
                        <?php
                        cart_table($cartItems);
                        ?>
                    </div>
                </div> 
                <div class="col">
                    <div class="short-content">
                        <?php
                            orderSummary(true, $prices);
                        ?>
                        <a href="checkout.php">                    
                            <button class="btn btn-primary full my-2">
                                <h4 class="my-1">Checkout</h4>
                            </button>
                        </a>
                        <a href="index.php">                    
                            <button class="btn btn-transparent full">
                                <h4 class="my-1">Continue Shopping</h4>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/pages/cart.js"></script>
</body>
</html>
