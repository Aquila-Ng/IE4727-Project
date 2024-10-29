<?php
    function renderQuantityControl($variantId, $quantity) {
        ?>
       <div class="quantity-container">
            <input type="number" id="quantity-<?php echo htmlspecialchars($variantId); ?>" class="quantity-input" value="<?php echo htmlspecialchars($quantity); ?>" min="1" onchange="updateSubtotal(<?php echo htmlspecialchars($variantId); ?>)">
            <div class="quantity-btns">
                <button class="quantity-btn increase" onclick="updateQuantity(1, <?php echo htmlspecialchars($variantId); ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </button>
                <button class="quantity-btn decrease" onclick="updateQuantity(-1, <?php echo htmlspecialchars($variantId); ?>)">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                    </svg>
                </button>
            </div>
        </div>
        <?php
    }
?>