<?php
function orderSummary($isCheckout,$prices) {
    ?>
    <div class="order-summary">
            <div class="row justify-between">
            <h3 class="emphasized ">Order Summary</h3>
            <h3 class="emphasized "><?php echo $prices['item']; ?> items</h3>
        </div>
        <div class="row justify-between">
            <h4 class="mb-0">Subtotal</h4>
            <h4 class="mb-0">$<?php echo number_format($prices['subtotal'], 2); ?></h4>
        </div>
        <?php
        if($isCheckout){
            ?>
        <div class="row justify-between">
            <h4 class="mb-0">Delivery</h4>
            <h4 class="mb-0">$<?php echo number_format($prices['delivery'], 2); ?></h4>
        </div>
        <?php }
            ?>
        <div class="row justify-between">
            <h4>GST (Included)</h4>
            <h4>$<?php echo number_format($prices['gst'], 2); ?></h4>
        </div>
        <div class="row justify-between">
            <h4 class="emphasized">Order Total</h4>
            <h4 class="emphasized">$<?php echo number_format($prices['total'], 2); ?></h4>
        </div>
    </div>
    <?php
}

function orderRow($orderId, $name, $price, $variantId, $quantity, $image, $variantName) {
    ?>
    <div class="row gap-3 my-3">
        <div class="col-2">
            <div class="order-image-wrapper mb-1">
                <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($variantName); ?>" class="cart-image" data-variantId="<?php echo htmlspecialchars($variantId); ?>">
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col">
                    <h4 class="emphasized"><?php echo htmlspecialchars($name); ?></h4>
                    <h5 class="my-1"><?php echo htmlspecialchars($variantName); ?></h5>
                    <h5 class="my-1"><?php echo htmlspecialchars(number_format($price, 2)); ?></h5>
                    <h5 class="my-1">Quantity: <?php echo htmlspecialchars($quantity); ?></h5>
                </div>
                <div class="col d-flex justify-end mx-0">
                    <h4 class="emphasized">Subtotal: $<?php echo htmlspecialchars(number_format($price * $quantity, 2)); ?></h4>
                </div>
            </div>
            <div class="row d-flex justify-end">
                <h4 class="emphasized">View Product</h4>
            </div>
        </div>
    </div>
    <?php
}

function order($orderItems, $orderId, $date, $totalAmt) {
    if (empty($orderItems)) {
        echo '<p>No items in the order.</p>'; // Better to indicate empty cart
    } else {
        ?>
        <div class="order-header row gap-5 my-3 px-3">
            <div class="flex-column">
                <h4 class="emphasized mt-2 mb-1">Order Number</h4>
                <h4 class="mt-1 mb-2"><?php echo htmlspecialchars($orderId); ?></h4>
            </div>
            <div class="flex-column">
                <h4 class="emphasized mt-2 mb-1">Date Placed</h4>
                <h4 class="mt-1 mb-2"><?php echo htmlspecialchars($date); ?></h4>
            </div>
            <div class="flex-column">
                <h4 class="emphasized mt-2 mb-1">Total Amount</h4>
                <h4 class="mt-1 mb-2">$<?php echo htmlspecialchars(number_format($totalAmt, 2)); ?></h4>
            </div>
        </div>
        
        <?php foreach ($orderItems as $item) {
            orderRow(
                $item['orderId'],
                $item['name'],
                $item['price'],
                $item['variantId'],
                $item['quantity'],
                $item['image'],
                $item['variantName']
            );
        } ?>
        <?php
    }
}

function allOrder($allOrderItems) {
    if (empty($allOrderItems)) {
        echo '<h4>No items are previously purchased.</h4>';
    } else {
        foreach ($allOrderItems as $orderData) {
            // Make sure to define $orderId, $date, $totalAmt for each order
            order($orderData['items'], $orderData['orderId'], $orderData['date'], $orderData['totalAmt']);
        }
    }
}
?>


