<?php
// This PHP file outputs a product card without a carousel for color variants

function product_card($id, $name, $price, $variantId, $colors, $images) {
    ?>
    <div class="product-card m-3" data-id="<?php echo htmlspecialchars($id); ?>">
        <!-- Product Image (the first image will be displayed initially) -->
        <img src="<?php echo htmlspecialchars($images[0]); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="product-image mb-1" data-id="<?php echo htmlspecialchars($id); ?>">

        <!-- Product Color Variants (clickable to change the image) -->
        <div class="product-variants items-center">
            <?php foreach ($colors as $index => $color): ?>
                <div class="variant-option" style="background-color: <?php echo htmlspecialchars($color); ?>;"
                     data-index="<?php echo $index; ?>" data-id="<?php echo htmlspecialchars($id); ?>" data-variant-id="<?php echo htmlspecialchars($variantId[$index]); ?>"
                     data-image="<?php echo htmlspecialchars($images[$index]); ?>"></div>
            <?php endforeach; ?>
        </div>

        <!-- Product Title and Price -->
        <h3 class="product-title mb-1"><?php echo htmlspecialchars($name); ?></h3>
        <p class="product-price m-0"><?php echo htmlspecialchars($price); ?></p>
    </div>
    <?php
}
?>
