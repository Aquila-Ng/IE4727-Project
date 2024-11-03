<?php

function filterAndSort($minPrice, $maxPrice){
    ?>
    <div class="row d-flex flex-row justify-between">
        <button id="filterButton" class="d-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-filter icon-button" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>
            <h3 class="emphasized">Filter</h3>
        </button>
        <div class="dropdown">
            <button id="sortButton" class="d-flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                    <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5M7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1z"/>
                </svg>
                <h3 class="emphasized">Sort</h3>
            </button>
            <div id="sortOptions" class="dropdown-content">
                <div data-value="default" class="item">
                    <h5 class="m-1">Default</h5>
                </div>
                <div data-value="price-asc" class="item">
                    <h5 class="m-1">Price Low to High</h5>
                </div>
                <div data-value="price-desc" class="item">
                    <h5 class="m-1">Price High to Low</h5>
                </div>
            </div>
        </div>
    </div>
    <div id="filterPanel" class="filter-panel">
        <div class="row items-center justify-between">
            <h2 class="emphasized">Filter</h2>
            <button id="closeButton" class="icon-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>
            </button>
        </div>
        <form class="p-0">
            <div class="form-group category">
                <h3 class="emphasized">Category</h3>
                <div class="checkbox-container">
                    <input type="checkbox" id="watch" name="category" value="watch">
                    <label class="custom-checkbox" for="watch"></label>
                    <label class="custom-checkbox-label" for="watch"><h4 class="m-1">Watch</h4></label>
                </div>
                <div class="checkbox-container">
                    <input type="checkbox" id="bag" name="category" value="bag">
                    <label class="custom-checkbox" for="bag"></label>
                    <label class="custom-checkbox-label" for="bag"><h4 class="m-1">Bag</h4></label>
                </div>
            </div>
            <div class="price-range-container">
                <h3 class="emphasized">Price</h3>
                
                <div class="slider-container">
                    <div class="slider">
                    <input type="range" id="minRange" name="minRange" min="<?php echo (int)htmlspecialchars($minPrice); ?>" max="<?php echo (int)htmlspecialchars($maxPrice); ?>" step="100" value="<?php echo (int)htmlspecialchars($minPrice); ?>" oninput="updateMinMax()">
                    <input type="range" id="maxRange" name="maxRange" min="<?php echo (int)htmlspecialchars($minPrice); ?>" max="<?php echo (int)htmlspecialchars($maxPrice); ?>" step="100" value="<?php echo (int)htmlspecialchars($maxPrice); ?>" oninput="updateMinMax()">
                    </div>
                </div>
                
                <div class="price-values">
                    <span>From $</span>
                    <input type="number" id="minPriceInput" value="<?php echo (int)htmlspecialchars($minPrice); ?>" min="<?php echo $minPrice; ?>" max="<?php echo (int)htmlspecialchars($maxPrice); ?>" step="100" onchange="syncSliderWithInput('min')">
                    <span> to $</span>
                    <input type="number" id="maxPriceInput" value="<?php echo (int)htmlspecialchars($maxPrice); ?>" min="<?php echo (int)htmlspecialchars($minPrice); ?>" max="<?php echo (int)htmlspecialchars($maxPrice); ?>" step="100" onchange="syncSliderWithInput('max')">
                </div>
            </div>


            <button type="submit" class="btn btn-primary full mt-2"><h3 class="emphasized m-0">Apply</h3></button>
        </form>
    </div>
<?php
    }
?>