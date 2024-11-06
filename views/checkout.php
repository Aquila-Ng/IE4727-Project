<?php
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize the cart as an empty array
    }

    include('../includes/components/navbar.php');
    include('../includes/components/form.php');
    include('../includes/components/order.php');
    include('../includes/components/footer.php');

    include('../scripts/get_checkout_info.php');
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
    <main class="content mb-2">
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
                    <div class="short-content">
                    <?php
                        orderSummary($prices);
                    ?>
                    </div>
                 </div>
            </div>
        </div>
    </main>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/main.js"></script>
</body>
</html>
