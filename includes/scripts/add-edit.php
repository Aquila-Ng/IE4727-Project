<?php
include '../config/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add Category
        if ($action == 'addCategory') {
            $name = $_POST['name'];
            $add_query = "INSERT INTO categories (NAME) VALUES (?)";
            $stmt = $conn -> prepare($add_query);
            $stmt -> bind_param('s', $name);
            $stmt -> execute();
            $stmt -> close();
            header('Location: ../../views/admin-category.php');
        }

        // Edit Category
        if ($action == 'editCategory') {
            $name = $_POST['name'];
            $id = $_POST['id'];
            $update_query = "UPDATE categories SET name = ? WHERE id = ?";
            $stmt = $conn -> prepare($update_query);
            $stmt -> bind_param('si', $name, $id);
            $stmt -> execute();
            $stmt -> close();
            header('Location: ../../views/admin-category.php');
        }

        // Add Product
        if ($action == 'addProduct') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = (float)$_POST['price'];
            $stmt = $conn->prepare("INSERT INTO products (category_id, name, description, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issd", $category_id, $name, $description, $price); // Corrected binding types
            $stmt->execute();
            $stmt->close();
            header('Location: ../../views/admin-product.php');
        }

        // Edit Product
        if ($action == 'editProduct') {
            $id = $_POST['id'];
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stmt = $conn->prepare("UPDATE products SET category_id = ?, name = ?, description = ?, price = ? WHERE id = ?");
            $stmt->bind_param("issdi", $category_id, $name, $description, $price, $id); // Corrected binding types
            $stmt->execute();
            $stmt->close();
            header('Location: ../../views/admin-product.php');
        }

        // Add Variant
        if ($action == 'addVariant') {
            $name = $_POST['name'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            $image = $_POST['image'];
            $product_id = $_POST['product_id'];
            $stmt = $conn->prepare("INSERT INTO variants (product_id, name, color, quantity, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issis", $product_id, $name, $color, $quantity, $image); // Corrected binding types and added imageUrl as a string
            $stmt->execute();
            $stmt->close();
            header('Location: ../../views/admin-variant.php');
        }

        // Edit Variant
        if ($action == 'editVariant') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            $image = $_POST['image'];
            $product_id = $_POST['product_id'];
            $stmt = $conn->prepare("UPDATE variants SET product_id = ?, name = ?, color = ?, quantity = ?, image = ? WHERE id = ?");
            $stmt->bind_param("issisi", $product_id, $name, $color, $quantity, $image, $id); // Corrected binding types
            $stmt->execute();
            $stmt->close();
            header('Location: ../../views/admin-variant.php');
        }
        // header("Location: ../views.testdb.php");
    }
}

$conn->close();
?>
