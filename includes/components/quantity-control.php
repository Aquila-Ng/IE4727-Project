<?php
    function renderQuantityControl($variantId, $quantity, $maxQuantity) {
        $inactiveClass = ($quantity == 0) ? "inactive" : "";
        ?>
        
        <div class="quantity-container <?php echo htmlspecialchars($inactiveClass); ?>">
            <input 
                type="number" 
                id="quantity-<?php echo htmlspecialchars($variantId); ?>" 
                class="quantity-input" 
                name="quantity"
                value="<?php echo (int)$quantity; ?>" 
                min="1" 
                max="<?php echo (int)$maxQuantity; ?>" 
                onchange="updateSubtotal(<?php echo htmlspecialchars($variantId); ?>); "
                <?php if ($quantity == 0) echo 'disabled'; ?> 
            >
            <div class="quantity-btns">
                <button 
                    type="button"
                    class="quantity-btn increase" 
                    onclick="updateQuantity(1, <?php echo (int)htmlspecialchars($variantId); ?>)"
                    <?php if ($quantity == 0) echo 'disabled'; ?> 
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </button>
                <button 
                    type="button"
                    class="quantity-btn decrease" 
                    onclick="updateQuantity(-1, <?php echo (int)htmlspecialchars($variantId); ?>)"
                    <?php if ($quantity == 0) echo 'disabled'; ?> 
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                    </svg>
                </button>
            </div>
        </div>
        <?php
}
?>
