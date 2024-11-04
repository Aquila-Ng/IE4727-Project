<?php
    include('color-variants.php');
    function product_card($isAnimated, $id, $name, $price, $variants) {
        $animatedClass=$isAnimated?"animated":"";
        ?>
            <div class="product-card <?php echo htmlspecialchars($animatedClass); ?> m-3" data-id="<?php echo htmlspecialchars($id); ?>">
                <!-- Product Image (the first image will be displayed initially) -->
                <a href="product-description.php?id=<?php echo urlencode($id); ?>">
                    <div class="product-image-wrapper mb-1">
                        <img src="<?php echo htmlspecialchars($variants[0]['image']); ?>" alt="<?php echo htmlspecialchars($name); ?>" class="product-image" data-id="<?php echo htmlspecialchars($id); ?>">
                    </div>
                </a>
                <!-- Product Color Variants (clickable to change the image) -->
                <?php renderColorVariants(true, $id, $variants); ?>
                <a href="product-description.php?id=<?php echo urlencode($id); ?>">
                    <!-- Product Title and Price -->
                    <h3 class="product-title emphasized mb-1"><?php echo htmlspecialchars($name); ?></h3>
                    <h4 class="m-0">$<?php echo htmlspecialchars(number_format($price, 2)); ?></h4>
                </a>
            </div>
        
        <?php
    }
?>

<?php
    function all_product_cards($isAnimated, $productItems) {
        if (empty($productItems)) {
            echo '<h3 class="ml-3">No items match the search.</h3>';
            return ""; // Return an empty string if no items are provided
        }

        $productCards = ''; // Initialize an empty string to hold all product cards
        foreach ($productItems as $index => $item) {
            $productCards .= product_card($isAnimated, $item['id'], $item['name'], $item['price'], $item['variants']);
        }
        echo $productCards; 
    }
?>


                