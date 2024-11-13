<?php
function renderColorVariants($isCenter = false, $productId = "", $variants) {
    $centerClass = $isCenter ? "justify-center" : "";
    ?>
    
    <div class="d-flex <?php echo htmlspecialchars($centerClass); ?> gap-1 mb-1 items-center">
        <?php foreach ($variants as $index => $variant): ?>
            <?php 
            $strikethroughClass = ($variant['quantity'] == 0) ? "strikethrough" : ""; 
            ?>
            <div class="variant-option <?php echo htmlspecialchars($strikethroughClass); ?>" 
                style="background-color: <?php echo htmlspecialchars($variant['variantColor']); ?>;"
                data-id="<?php echo htmlspecialchars($productId); ?>" 
                data-index="<?php echo $index; ?>" 
                data-variant-id="<?php echo htmlspecialchars($variant['variantId']); ?>"
                <?php if ($isCenter && isset($variant['image']) && !empty($variant['image'])){ ?>
                    data-image="<?php echo htmlspecialchars($variant['image']); ?>"
                <?php } ?>
                >
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}
?>

