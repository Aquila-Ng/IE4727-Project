
<?php
function carousel($isBanner, $carouselItems) {
    $imageClass = $isBanner ? "banner-image" : "product-description-image";
    $selectedClass = $isBanner ? "selected" : "";
    
    if (empty($carouselItems)) {
        return ''; // Return an empty string if no items are provided
    }
    
    $carousel = '';
    $carouselInner = '';
    
    $prevButton = '<button class="carousel-control-prev" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M41.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.3 256 246.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/>
                    </svg>
                   </button>';

    $nextButton = '<button class="carousel-control-next" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z"/>
                    </svg>
                   </button>';

    // Generate carousel items
    foreach ($carouselItems as $index => $item) {
        $activeClass = ($index === 0) ? 'active' : '';
        
        if ($isBanner) {
            // Use background image for banner
            $carouselInner .= "<div class='carousel-image $imageClass $activeClass' style='background-image: url(\"" . htmlspecialchars($item['image']) . "\");'>";
            if ($isBanner) {
                $carouselInner .= "<div class='banner-caption'>
                                    <h2 class='emphasized'>" . htmlspecialchars($item['title']) . "</h2>
                                    <p>" . htmlspecialchars($item['description']) . "</p>
                                  </div>"; // Close the caption div
            }
        } else {
            // Use <img> tag for non-banner items
            $carouselInner .= "<div class='carousel-image $imageClass $activeClass'>
                      <img src='" . htmlspecialchars($item) . "' alt='Carousel Image' />";

        }

        $carouselInner .= "</div>";               
    }

    // Build the complete carousel HTML
    $carousel .= "<div class='carousel'>
                    <div class='carousel-inner $selectedClass '>
                        $carouselInner
                    </div>
                    $prevButton
                    $nextButton
                  </div>";
    
    echo $carousel;
}
?>