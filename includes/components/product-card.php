<?php
// This PHP file outputs a product card without a carousel for color variants

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
?>
