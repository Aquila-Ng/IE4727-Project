<?php
include('carousel.php');

function productDescriptionGallery($galleryItems) {
    ?>
    <div class="gallery d-flex justify-center gap-1 my-3 items-center">
        <?php foreach ($galleryItems as $index => $galleryItem): 
            $activeClass = ($index === 0) ? 'active' : ''; ?>
            <div class="gallery-option <?php echo $activeClass ?>" 
                 data-index="<?php echo $index; ?>" 
                 data-variant-id="<?php echo htmlspecialchars($galleryItem['variantId']); ?>"
                 data-image="<?php echo htmlspecialchars($galleryItem['image']); ?>">
                <img src="<?php echo htmlspecialchars($galleryItem['image']); ?>" alt="Gallery Image <?php echo $index; ?>" />
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

function productDescription($productDescriptionItems) {
    carousel(false, $productDescriptionItems);
    productDescriptionGallery($productDescriptionItems);
}
?>
