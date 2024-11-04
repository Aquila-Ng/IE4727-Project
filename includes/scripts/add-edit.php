<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        // Add Category
        if ($action == 'addCategory') {
            $name = $_POST['name'];
            $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?)");
            $stmt->bind_param("s", $name); // Corrected from "ss" to "s" for a single string parameter
            $stmt->execute();
            $stmt->close();
        }

        // Edit Category
        if ($action == 'editCategory') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $stmt = $conn->prepare("UPDATE categories SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $name, $id); // Corrected to bind string and integer
            $stmt->execute();
            $stmt->close();
        }

        // Add Product
        if ($action == 'addProduct') {
            $category_id = $_POST['category_id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $stmt = $conn->prepare("INSERT INTO products (category_id, name, description, price) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("issd", $category_id, $name, $description, $price); // Corrected binding types
            $stmt->execute();
            $stmt->close();
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
        }

        // Add Variant
        if ($action == 'addVariant') {
            $name = $_POST['name'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            $product_id = $_POST['product_id'];
            $stmt = $conn->prepare("INSERT INTO variants (product_id, name, color, quantity, imageUrl) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issis", $product_id, $name, $color, $quantity, $imageUrl); // Corrected binding types and added imageUrl as a string
            $stmt->execute();
            $stmt->close();
        }

        // Edit Variant
        if ($action == 'editVariant') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $color = $_POST['color'];
            $quantity = $_POST['quantity'];
            $product_id = $_POST['product_id'];
            $stmt = $conn->prepare("UPDATE variants SET product_id = ?, name = ?, color = ?, quantity = ? WHERE id = ?");
            $stmt->bind_param("issii", $product_id, $name, $color, $quantity, $id); // Corrected binding types
            $stmt->execute();
            $stmt->close();
        }
        header("Location: ../views.testdb.php");
    }
}

$conn->close();
?>
