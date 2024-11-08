<?php
 include('../includes/components/navbar.php');
 include('../includes/components/admin-table.php');
 include("../includes/config/db_connect.php");

// Variants Query
$variantItems = [];
$result = $conn->query("
    SELECT 
        v.id,
        v.name,
        v.product_id,
        p.name AS product_name,
        v.color,
        v.quantity,
        v.image
    FROM variants v
    JOIN products p ON v.product_id = p.id
");
while ($row = $result->fetch_assoc()) {
    $variantItems[] = [
        'id' => $row['id'],
        'name' => $row['name'],
        'product_id' => $row['product_id'],
        'product_name' => $row['product_name'],
        'color' => $row['color'],
        'quantity' => $row['quantity'],
        'image' => $row['image']
    ];
}


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
       navbar(false);
    ?>
    <main>
        <div class="container pt-2">
            <h2 class="emphasized">Products</h2>
            <?php
                variant_table($variantItems);
            ?>
        </div>
        <?php
             include('../includes/components/variant-modal.php');
        ?>
    </main>
    <script type="module" src="../assets/js/pages/admin-variant.js"></script>
</body>
</html>

