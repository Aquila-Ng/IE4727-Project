<?php
    // Function to render a category row
    function category_row($categoryId, $categoryName) {
        ?>
        <tr>
            <td class="hug-column">
                <p class="emphasized m-0"><?php echo htmlspecialchars($categoryId); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($categoryName); ?></p>
            </td>
            <td class="hug-column flex-row gap-1">
                <button class='btn btn-warning btn-sm' 
                    onclick="openEditModal('editCategoryModal', this)"
                    data-id="<?php echo htmlspecialchars($categoryId); ?>"
                    data-name="<?php echo htmlspecialchars($categoryName); ?>">
                    Edit
                </button>
                <form class="m-0 p-0" action="../includes/scripts/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    <input type="hidden" name="id" value="<?php echo $categoryId; ?>">
                    <input type="hidden" name="action" value="deleteCategory">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        <?php
    }

    // Function to render the category table
    function category_table($categoryItems) {
        if (empty($categoryItems)) {
            echo '<h4>There is no category.</h4>';
        } else {
            ?>
            <table class="table mb-2">
                <thead>
                    <tr>
                        <td colspan="2"></td>
                        <td><button class='btn btn-success btn-sm' onclick="openAddModal('addCategoryModal')">Add Category</button></td>
                    </tr>
                    <tr style="background-color: var(--secondary-background-color);">
                        <th><h3 class="emphasized px-2">ID</h3></th>
                        <th><h3 class="emphasized px-2">Name</h3></th>
                        <th class="last-column"><h3 class="emphasized px-2">Action</h3></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($categoryItems as $categoryItem) {
                    category_row($categoryItem['id'], $categoryItem['name']);
                } ?>
                </tbody>
            </table>
            <?php
        }
    }
?>

<?php
    // Function to render a product row
    function product_row($productId, $productName, $categoryId, $categoryName, $productDescription, $productPrice) {
        ?>
        <tr>
            <td class="hug-column">
                <p class="emphasized m-0"><?php echo htmlspecialchars($productId); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($productName); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($categoryName); ?></p>
            </td>
            <td>
                <?php echo htmlspecialchars($productDescription); ?>
            </td>
            <td>
                <p class="emphasized m-0">$<?php echo htmlspecialchars(number_format($productPrice, 2)); ?></p> <!-- Corrected number_format function -->
            </td>
            <td class="hug-column flex-row gap-1">
                <button class='btn btn-warning btn-sm' 
                    onclick="openEditModal('editProductModal', this)"
                    data-id="<?php echo htmlspecialchars($productId); ?>" 
                    data-name="<?php echo htmlspecialchars($productName); ?>" 
                    data-description="<?php echo htmlspecialchars($productDescription); ?>"
                    data-price="<?php echo htmlspecialchars($productPrice); ?>"
                    data-categoryId="<?php echo htmlspecialchars($categoryId); ?>"
                >Edit</button>
                <form class="m-0 p-0" action="../includes/scripts/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    <input type="hidden" name="id" value="<?php echo $productId; ?>">
                    <input type="hidden" name="action" value="deleteProduct">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        <?php
    }

    // Function to render the product table
    function product_table($productItems) {
        if (empty($productItems)) {
            echo '<h4>There is no product.</h4>';
        } else {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="5"></td>
                        <td><button class='btn btn-success btn-sm' onclick="openAddModal('addProductModal')">Add Product</button></td>
                    </tr>
                    <tr  style="background-color: var(--secondary-background-color);">
                        <th><h3 class="emphasized px-2">ID</h3></th>
                        <th><h3 class="emphasized px-2">Name</h3></th>
                        <th><h3 class="emphasized px-2">Category</h3></th>
                        <th><h3 class="emphasized px-2">Description</h3></th>
                        <th><h3 class="emphasized px-2">Price</h3></th>
                        <th class="last-column"><h3 class="emphasized px-2">Action</h3></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($productItems as $productItem) {
                    product_row($productItem['id'], $productItem['name'], $productItem['category_id'], $productItem['category_name'], $productItem['description'], $productItem['price']);
                } ?>
                </tbody>
            </table>
            <?php
        }
    }
?>

<?php
    // Function to render a variant row
    function variant_row($variantId, $variantName, $productId, $productName, $variantColor, $variantQuantity, $variantImage) {
        ?>
        <tr>
            <td class="hug-column">
                <p class="emphasized m-0"><?php echo htmlspecialchars($variantId); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($variantName); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($productName); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($variantColor); ?></p>
            </td>
            <td>
                <p class="emphasized m-0"><?php echo htmlspecialchars($variantQuantity); ?></p>
            </td>
            <td>
                <?php echo htmlspecialchars($variantImage); ?>
            </td>
            <td class="hug-column flex-row gap-1">
                <button class='btn btn-warning btn-sm' 
                    onclick="openEditModal('editVariantModal', this)" 
                    data-id="<?php echo htmlspecialchars($variantId); ?>" 
                    data-name="<?php echo htmlspecialchars($variantName); ?>" 
                    data-productId="<?php echo htmlspecialchars($productId); ?>"
                    data-variantColor="<?php echo htmlspecialchars($variantColor); ?>"
                    data-variantQuantity="<?php echo htmlspecialchars($variantQuantity); ?>"
                    data-variantImage="<?php echo htmlspecialchars($variantImage); ?>">Edit</button>
                <form class="m-0 p-0" action="../includes/scripts/delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    <input type="hidden" name="id" value="<?php echo $variantId; ?>">
                    <input type="hidden" name="action" value="deleteVariant">
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        <?php
    }

    // Function to render the variant table
    function variant_table($variantItems) {
        if (empty($variantItems)) {
            echo '<h4>There is no variant.</h4>';
        } else {
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <td colspan="6"></td>
                        <td><button class='btn btn-success btn-sm' onclick="openAddModal('addVariantModal')">Add Variant</button></td>
                    </tr>
                    <tr style="background-color: var(--secondary-background-color);">
                        <th><h3 class="emphasized px-2">ID</h3></th>
                        <th><h3 class="emphasized px-2">Name</h3></th>
                        <th><h3 class="emphasized px-2">Product</h3></th>
                        <th><h3 class="emphasized px-2">Color</h3></th>
                        <th><h3 class="emphasized px-2">Quantity</h3></th>
                        <th><h3 class="emphasized px-2">Image Url</h3></th>
                        <th class="last-column"><h3 class="emphasized px-2">Action</h3></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($variantItems as $variantItem) {
                    variant_row($variantItem['id'], $variantItem['name'], $variantItem['product_id'], $variantItem['product_name'], $variantItem['color'], $variantItem['quantity'],  $variantItem['image']);
                } ?>
                </tbody>
            </table>
            <?php
        }
    }
?>
<?php
    function renderOrderStatusSelect($orderStatuses,$orderId, $selectedStatusId) {
        ?>
       <form class="form-group p-0" action="../includes/scripts/update_order_status.php" method="POST">
            <input type="hidden" name="orderId" value="<?php echo htmlspecialchars($orderId); ?>" />
            <select name="statusId" onchange="this.form.submit()">
                <?php foreach ($orderStatuses as $statusId => $statusName): ?>
                    <option value="<?php echo htmlspecialchars($statusId); ?>" <?php echo ($statusId === $selectedStatusId) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($statusName); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <?php
    }    
?>
<?php
    // Function to render a variant row
    function order_row($orderStatuses, $orderId, $date, $statusId, $username, $billingAddress, $shippingAddress, $total) {
        ?>
        <tr>
            <td class="hug-column">
                <?php echo htmlspecialchars($orderId); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($date); ?>
            </td>
            <td>
                <?php renderOrderStatusSelect($orderStatuses,$orderId, $statusId); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($username); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($billingAddress); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($shippingAddress); ?>
            </td>
            <td>
                $<?php echo htmlspecialchars(number_format($total, 2)); ?>
            </td>
        </tr>
        <?php
    }

    // Function to render the variant table
    function order_table($orderStatuses, $orderItems) {
        if (empty($orderItems)) {
            echo '<h4>There is no order.</h4>';
        } else {
            ?>
            <table class="table">
                <thead style="background-color: var(--secondary-background-color);">
                    <tr>
                        <th><h3 class="emphasized px-2">Order Number</h3></th>
                        <th><h3 class="emphasized px-2">Date</h3></th>
                        <th><h3 class="emphasized px-2">Status</h3></th>
                        <th><h3 class="emphasized px-2">Customer</h3></th>
                        <th><h3 class="emphasized px-2">Billing Address</h3></th>
                        <th><h3 class="emphasized px-2">Shipping Address</h3></th>
                        <th class="last-column"><h3 class="emphasized px-2">Total</h3></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orderItems as $orderItem) {
                    order_row(
                        $orderStatuses,
                        $orderItem['id'],
                        $orderItem['date'],
                        $orderItem['statusId'],
                        $orderItem['name'],
                        $orderItem['shipping_address'],
                        $orderItem['shipping_address'],
                        $orderItem['total_amount']
                    );
                } ?>
                </tbody>
            </table>
            <?php
        }
    }
?>