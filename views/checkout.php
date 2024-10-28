<?php
 include('../includes/components/navbar.php');
 include('../includes/components/form.php');
 include('../includes/components/order.php');
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
       navbar(false);
    ?>
    <div class="content mb-2">
        <div class="container">
            <div class="row">
                <a href="cart.php"><h2>Shopping Cart</h2></a>
                <h2>&nbsp;>&nbsp;</h2>
                <a href="#"><h2 class="emphasized">Checkout</h2></a>
            </div>  
            <div class="row">
                <?php
                    checkoutForm($userDetails);
                ?>
                <div class="col">
                    <?php
                        orderSummary(true, $prices);
                    ?>
                 </div>
            </div>
        </div>
    </div>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/main.js"></script>
</body>
</html>
