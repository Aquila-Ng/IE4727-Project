<?php 
    session_start();
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = []; // Initialize the cart as an empty array
    }
    include('../includes/scripts/cart.php');

    include('../includes/components/navbar.php');
    include('../includes/components/form.php');
    include('../includes/components/order.php');
    include('../includes/components/cart-table.php');
    include('../includes/components/footer.php');
    



    // $userDetails = [
    //     'first_name' => 'John',
    //     'last_name' => 'Doe',
    //     'email' => 'john.doe@example.com',
    //     'contact_number' => '1234567890',
    //     'address_line1' => '123 Main St',
    //     'address_line2' => 'Apt 4B',
    //     'country' => 'USA',
    //     'postal_code' => '10001'
    //     ];

    // // Example usage
    // $prices = [
    //     'item' => 3,
    //     'subtotal' => 39.99,
    //     'delivery' => 29.99,
    //     'gst' => 19.99,
    //     'total' => 89.99
    // ];

    // $cartItems = [
    //     [
    //         'cartId' => 1,
    //         'name' => 'Aventurer Explorer Time',
    //         'price' => 600,
    //         'variantId' => 10,
    //         'quantity' => 2,
    //         'maxQuantity' => 10,
    //         'image' => '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/main.png',
    //         'variantName' => 'Ebony Classic'
    //     ],
    //     [
    //         'cartId' => 2,
    //         'name' => 'Legacy Noble Classic',
    //         'price' => 700,
    //         'variantId' => 6,
    //         'quantity' => 1,
    //         'maxQuantity' => 10,
    //         'image' => '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png',
    //         'variantName' => 'Classic Black'
    //     ],
    //     [
    //         'cartId' => 3,
    //         'name' => 'Legacy Lunar Heritage',
    //         'price' => 750,
    //         'variantId' => 0,
    //         'quantity' => 3,
    //         'maxQuantity' => 10,
    //         'image' => '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png',
    //         'variantName' => 'Midnight Blue'
    //     ]
    // ];

    $isInValid=false;
    $errorMessage="Nothing in the cart.";
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
    <main class="content mb-2">
        <div class="cart container">
            <div class="row">
                <h2 class="emphasized">Shopping Cart</h2>
            </div>  
            <?php
                if($isInValid){
                    ?>
                    <div class="row">
                        <h3 class="danger emphasized m-0 py-1 px-3 full" style="border: none; border-radius: var(--spacing-xs); overflow: hidden;"><?php echo htmlspecialchars($errorMessage)?></h3>
                    </div>
                    <?php
                }
            ?>
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
                            orderSummary($prices);
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
    </main>
    <?php
        footer(true);
    ?>
    <!-- <script type="module" src="../assets/js/pages/cart.js"> -->
    <script>
    function updateQuantity(change, variantId) {
        // // Corrected template literals with backticks
        const quantityInputId = `quantity-${variantId}`;
        const formId = `cartQuantityChange-${variantId}`;
        console.log(`Attempting to access: ${quantityInputId}`);
        const quantityInput = document.getElementById(quantityInputId);
        const cartQuantityChangeForm = document.getElementById(formId);

        if (!quantityInput) {
            console.error(`Element with ID ${quantityInputId} not found!`);
            return; // Exit if the input is null
        }

        let currentQuantity = parseInt(quantityInput.value);
        

        let maxQuantity = parseInt(quantityInput.max);

        if (isNaN(currentQuantity)) {
            console.error(`Current quantity is not a number: ${currentQuantity}`);
            return; // Handle the case where the value is not a number
        }

        // Update the quantity while keeping it within limits
        currentQuantity = Math.max(1, currentQuantity + change); // Ensure quantity is at least 1
        
        if (currentQuantity > maxQuantity) {
            currentQuantity = maxQuantity;
        }
        
        // Set the updated value in the input
        quantityInput.value = currentQuantity;
        console.log("Updated quantity Input Value: " + quantityInput.value);

        cartQuantityChangeForm.submit();
    }
    </script>
</body>
</html>
