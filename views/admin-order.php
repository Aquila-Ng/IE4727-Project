<?php
    include('../includes/components/navbar.php');
    include('../includes/components/footer.php');
    include('../includes/components/admin-table.php');
    include('../includes/scripts/admin_get_order.php');

 // Sample order statuses array
$orderStatuses = [
    1 => 'Pending',
    2 => 'Processing',
    3 => 'On Hold',
    4 => 'Completed',
    5 => 'Shipped',
    6 => 'Cancelled',
    7 => 'Refunded',
    8 => 'Failed'
];

// Sample order items array
// $orderItems = [
//     [
//         'id' => '1001',
//         'date' => '2024-11-01',
//         'statusId' => 2, // Processing
//         'name' => 'Alice Johnson',
//         'billing_address' => '123 Maple St, Springfield, IL',
//         'shipping_address' => '456 Oak St, Springfield, IL',
//         'total_amount' => 120.50
//     ],
//     [
//         'id' => '1002',
//         'date' => '2024-11-02',
//         'statusId' => 1, // Pending
//         'name' => 'Bob Smith',
//         'billing_address' => '789 Pine St, Metropolis, NY',
//         'shipping_address' => '101 Elm St, Metropolis, NY',
//         'total_amount' => 89.99
//     ],
//     [
//         'id' => '1003',
//         'date' => '2024-11-03',
//         'statusId' => 4, // Completed
//         'name' => 'Carol White',
//         'billing_address' => '321 Birch St, Gotham, NJ',
//         'shipping_address' => '654 Cedar St, Gotham, NJ',
//         'total_amount' => 75.00
//     ]
// ];


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
    <main>
        <div class="container pt-2">
            <h2 class="emphasized">Orders</h2>
            <?php
                order_table($orderStatuses, $orderItems);
            ?>
        </div>
    </main>
    <script type="module" src="../assets/js/pages/admin.js"></script>
</body>
</html>

