<?php
include('carousel.php');

function productDescriptionGallery($variantId, $galleryImages) {
    ?>
    <div class="gallery d-flex justify-center gap-1 my-3 items-center">
        <?php foreach ($galleryImages as $index => $galleryImage): 
            $activeClass = ($index === 0) ? 'active' : ''; ?>
            <div class="gallery-option <?php echo $activeClass; ?>" 
                 data-index="<?php echo $index; ?>">
                <img src="<?php echo htmlspecialchars($galleryImage); ?>" alt="Gallery Image <?php echo $index; ?>" />
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function productDescription($productDescriptionItems) {
    ?>
    <div class="product-description-gallery" data-variant-id="<?php echo htmlspecialchars($productDescriptionItems['variantId']); ?>">
    <?php
        // Assuming $productDescriptionItems contains an array of gallery images
        carousel(false, $productDescriptionItems['galleryImages']);
        productDescriptionGallery($productDescriptionItems['variantId'], $productDescriptionItems['galleryImages']);
    ?>
    </div>
    <?php
}

function allProductDescription($allProductDescriptionItems) {
    foreach ($allProductDescriptionItems as $index => $productDescriptionItems):
        productDescription($productDescriptionItems);
    endforeach;
}
?>

