<?php
function product_card($id, $name, $price, $variantId, $colors, $images) {
    ?>
    <div class="product-card m-3" data-id="<?php echo htmlspecialchars($id); ?>">
        <!-- Product Image (the first image will be displayed initially) -->
         <div class="product-image-wrapper  mb-1">
             <img src="<?php echo htmlspecialchars($images[0]); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="product-image" data-id="<?php echo htmlspecialchars($id); ?>">
         </div>
        <!-- Product Color Variants (clickable to change the image) -->
        <div class="d-flex justify-center gap-1 mb-1 items-center">
            <?php foreach ($colors as $index => $color): ?>
                <div class="variant-option" style="background-color: <?php echo htmlspecialchars($color); ?>;"
                     data-index="<?php echo $index; ?>" data-id="<?php echo htmlspecialchars($id); ?>" data-variant-id="<?php echo htmlspecialchars($variantId[$index]); ?>"
                     data-image="<?php echo htmlspecialchars($images[$index]); ?>"></div>
            <?php endforeach; ?>
        </div>

        <!-- Product Title and Price -->
        <h3 class="product-title emphasized mb-1"><?php echo htmlspecialchars($name); ?></h3>
        <h4 class="m-0"><?php echo htmlspecialchars($price); ?></h4>
    </div>
    <?php
}
?>

<?php
function all_product_cards($productItems) {
    if (empty($productItems)) {
        return ''; // Return an empty string if no items are provided
    }

    $productCards = ''; // Initialize an empty string to hold all product cards
    foreach ($productItems as $index => $item) {
        $productCards .= product_card($item['id'], $item['name'], $item['price'], $item['variantId'], $item['colors'], $item['images']);
    }
    echo $productCards; 
}

function cart_row($cartId, $name, $price, $variantId, $quantity, $image, $variantName) {
    ?>
    <tr data-cartId="<?php echo htmlspecialchars($cartId); ?>">
        <td colspan="4">
            <div class="row gap-3">
                <div class="cart-image-wrapper mb-1">
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($variantName); ?>" class="cart-image" data-variantId="<?php echo htmlspecialchars($variantId); ?>">
                </div>
                <div class="col">
                    <h4 class="emphasized mb-0"><?php echo htmlspecialchars($name); ?></h4>
                    <h4 class="mt-1"><?php echo htmlspecialchars($variantName); ?></h4>
                </div>
            </div>
        </td>
        <td>
            <h4 ><?php echo htmlspecialchars(number_format($price, 2)); ?></h4>
        </td>
        <td class="hug-column">
            <div class="quantity-container">
                <input type="number" id="quantity-1" class="quantity-input" value="<?php echo htmlspecialchars($quantity); ?>" min="1" onchange="updateSubtotal(1)">
                <div class="quantity-btns">
                    <button class="quantity-btn increase" onclick="updateQuantity(1, 1)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                    </button>
                    <button class="quantity-btn decrease" onclick="updateQuantity(-1, 1)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                        </svg>
                    </button>
                </div>
            </div>
        </td>
        <td>
            <h4 ><?php echo htmlspecialchars(number_format($price * $quantity, 2)); ?></h4>
        </td>
        <td class="hug-column">
            <div class="mt-3">
                <button class="icon-button" data-cartId="<?php echo htmlspecialchars($cartId); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </button>
            </div>  
        </td>
    </tr>
    <?php
}

function cart_table($cartItems) {
    if (empty($cartItems)) {
        echo '<h4>There are no items in the shopping cart.</h4>';
    } else {
        ?>
        <div class="table-responsive pr-3">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="4"><h3 class="emphasized">Product</h3></th>
                        <th><h3 class="emphasized">Price</h3></th>
                        <th><h3 class="emphasized">Quantity</h3></th>
                        <th><h3 class="emphasized">Total Price</h3></th>
                        <th class="last-column"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cartItems as $item) {
                    cart_row(
                        $item['cartId'],
                        $item['name'],
                        $item['price'],
                        $item['variantId'],
                        $item['quantity'],
                        $item['image'],
                        $item['variantName']
                    );
                } ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}
?>

                