<?php
 include('../includes/components/navbar.php');
 include('../includes/components/order.php');
 include('../includes/components/footer.php');

// Sample cart items
$cartItems = [
    [
        'cartId' => 1,
        'name' => 'Product 1',
        'price' => 19.99,
        'variantId' => 'variant-123',
        'quantity' => 2,
        'image' => '../assets/product-image.png',
        'variantName' => 'Size M'
    ],
    [
        'cartId' => 2,
        'name' => 'Product 2',
        'price' => 9.99,
        'variantId' => 'variant-124',
        'quantity' => 1,
        'image' => '../assets/product-image.png',
        'variantName' => 'Color Red'
    ],
];

// Sample order data
$allOrderItems = [
    [
        'orderId' => 'ORD001',
        'date' => '2024-10-01',
        'totalAmt' => 49.97,
        'items' => [
            [
                'cartId' => 1,
                'name' => 'Product 1',
                'price' => 19.99,
                'variantId' => 'variant-123',
                'quantity' => 2,
                'image' => '../assets/product-image.png',
                'variantName' => 'Size M'
            ],
            [
                'cartId' => 2,
                'name' => 'Product 2',
                'price' => 9.99,
                'variantId' => 'variant-124',
                'quantity' => 1,
                'image' => '../assets/product-image.png',
                'variantName' => 'Color Red'
            ],
        ]
    ],
    [
        'orderId' => 'ORD002',
        'date' => '2024-10-15',
        'totalAmt' => 29.98,
        'items' => [
            [
                'cartId' => 3,
                'name' => 'Product 3',
                'price' => 29.98,
                'variantId' => 'variant-125',
                'quantity' => 1,
                'image' => '../assets/product-image.png',
                'variantName' => 'Color Blue'
            ],
        ]
    ],
];

// Sample order data for no orders
$emptyOrderList = [];


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
                <h2 class="emphasized">Order History</h2>
            </div>  
            <?php
                allOrder($allOrderItems);
            ?>
            </div>
        </div>
    </div>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/main.js"></script>
</body>
</html>
