<?php
    // Function to render a category row
    function category_row($categoryId, $categoryName) {
        ?>
        <tr>
            <td class="hug-column">
                <?php echo htmlspecialchars($categoryId); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($categoryName); ?>
            </td>
            <td class="hug-column">
            <a href="admin.php?categoryId=<?php echo htmlspecialchars($categoryId); ?>&categoryName=<?php echo htmlspecialchars($categoryName); ?>">
                <button class='btn btn-warning btn-sm' onclick="openEditCategoryModal(<?php echo $categoryId; ?>, '<?php echo addslashes($categoryName); ?>')">Edit</button>
             </a>
                <button class='btn btn-danger btn-sm' onclick="deleteItem('deleteCategory', <?php echo $categoryId; ?>)">Delete</button>
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
                <thead style="background-color: var(--secondary-background-color);">
                    <tr>
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
                <?php echo htmlspecialchars($productId); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($productName); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($categoryName); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($productDescription); ?>
            </td>
            <td>
                $<?php echo htmlspecialchars(number_format($productPrice, 2)); ?> <!-- Corrected number_format function -->
            </td>
            <td class="hug-column">
                <a href="admin.php?productId=<?php echo htmlspecialchars($productId); ?>&productName=<?php echo htmlspecialchars($productName); ?>&productPrice=<?php echo htmlspecialchars($productPrice); ?>&productCategoryId=<?php echo htmlspecialchars($categoryId); ?>">
                    <button class='btn btn-warning btn-sm' onclick="openEditProductModal(<?php echo $productId; ?>, '<?php echo addslashes($productName); ?>', <?php echo $categoryId; ?>, '<?php echo addslashes($productDescription); ?>', <?php echo $productPrice; ?>)">Edit</button>
                 </a>
                <button class='btn btn-danger btn-sm' onclick="deleteItem('deleteProduct', <?php echo $productId; ?>)">Delete</button>
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
                <thead style="background-color: var(--secondary-background-color);">
                    <tr>
                        <th><h3 class="emphasized px-2">ID</h3></th>
                        <th><h3 class="emphasized px-2">Name</h3></th>
                        <th><h3 class="emphasized px-2">Category Name</h3></th>
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
                <?php echo htmlspecialchars($variantId); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($variantName); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($productName); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($variantColor); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($variantQuantity); ?>
            </td>
            <td>
                <?php echo htmlspecialchars($variantImage); ?>
            </td>
            <td class="hug-column">
                <a href="admin.php?variantId=<?php echo htmlspecialchars($variantId); ?>&variantName=<?php echo htmlspecialchars($variantName); ?>&variantColor=<?php echo htmlspecialchars($variantColor); ?>&variantQuantity=<?php echo (int)htmlspecialchars($variantQuantity); ?>&variantImage=<?php echo htmlspecialchars($variantImage); ?>&variantProductId=<?php echo htmlspecialchars($productId); ?>">
                    <button class='btn btn-warning btn-sm' onclick="openEditVariantModal(<?php echo $variantId; ?>, '<?php echo addslashes($variantName); ?>', <?php echo $productId; ?>, '<?php echo addslashes($variantColor); ?>', <?php echo $variantQuantity; ?>)">Edit</button>
                </a>
                <button class='btn btn-danger btn-sm' onclick="deleteItem('deleteVariant', <?php echo $variantId; ?>)">Delete</button>
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
                <thead style="background-color: var(--secondary-background-color);">
                    <tr>
                        <th><h3 class="emphasized px-2">ID</h3></th>
                        <th><h3 class="emphasized px-2">Name</h3></th>
                        <th><h3 class="emphasized px-2">Product Name</h3></th>
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