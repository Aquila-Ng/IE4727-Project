<?php
 include('../includes/components/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/icons/serene-logo.svg">
    <title>SERENE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">  
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body class="m-0">
    <?php
       navbar(false);
    ?>
    <main>
        <div class="container-fluid p-0">
          
            </div>
        <div class="container pt-2">
        <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tables with Pagination and Actions</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- Category Table -->
  <h2>Category Table</h2>
  <table class="table" id="category-table">
    <thead>
      <tr>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows go here -->
    </tbody>
  </table>
  <button class="add-new">Add New Category</button>

  <!-- Product Table -->
  <h2>Product Table</h2>
  <table class="table" id="product-table">
    <thead>
      <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Category Name</th>
        <th>Product Description</th>
        <th>Price</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows go here -->
    </tbody>
  </table>
  <button class="add-new">Add New Product</button>

  <!-- Variant Table -->
  <h2>Variant Table</h2>
  <table class="table"  id="variant-table">
    <thead>
      <tr>
        <th>Variant ID</th>
        <th>Variant Name</th>
        <th>Variant Color</th>
        <th>Variant Quantity</th>
        <th>Product Name</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows go here -->
    </tbody>
  </table>
  <button class="add-new">Add New Variant</button>

  <!-- Order Table -->
  <h2>Order Table</h2>
  <table class="table" id="order-table">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Status</th>
        <th>Customer</th>
        <th>Billing Address</th>
        <th>Shipping Address</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      <!-- Table rows go here -->
    </tbody>
  </table>
  <button class="add-new">Add New Order</button>

  <script src="script.js"></script>
</body>
</html>

        </div>

    </main>
    <script type="module" src="../assets/js/pages/index.js"></script>
</body>
</html>

