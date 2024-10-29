<?php
    function renderColorVariants($isCenter,$colors, $variantId, $images, $productId) {
        $centerClass = $isCenter ? "justify-center" : ""
        ?>
        
        <div class="d-flex <?php echo htmlspecialchars($centerClass); ?> gap-1 mb-1 items-center">
            <?php foreach ($colors as $index => $color): ?>
                <div class="variant-option" style="background-color: <?php echo htmlspecialchars($color); ?>;"
                    data-index="<?php echo $index; ?>" 
                    data-id="<?php echo htmlspecialchars($productId); ?>" 
                    data-variant-id="<?php echo htmlspecialchars($variantId[$index]); ?>"
                    data-image="<?php echo htmlspecialchars($images[$index]); ?>"></div>
            <?php endforeach; ?>
        </div>
        <?php
    }
?>