<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $id = $_POST['id'];
        if ($action == 'deleteCategory') {
            // // First, delete all variants associated with products in the category
            // $stmt = $conn->prepare("DELETE FROM variants WHERE product_id IN (SELECT id FROM products WHERE category_id = ?)");
            // $stmt->bind_param("i", $id);
            // $stmt->execute();
            // $stmt->close();

            // // Then, delete all products associated with the category
            // $stmt2 = $conn->prepare("DELETE FROM products WHERE category_id = ?");
            // $stmt2->bind_param("i", $id);
            // $stmt2->execute();
            // $stmt2->close();

            // // Finally, delete the category itself
            // $stmt3 = $conn->prepare("DELETE FROM categories WHERE id = ?");
            // $stmt3->bind_param("i", $id);
            // $stmt3->execute();
            // $stmt3->close();
            echo "Category Id: " . $id;

        }
        if ($action == 'deleteProduct') {
            // // First, delete all variants associated with product
            // $stmt = $conn->prepare("DELETE FROM variants WHERE product_id =?");
            // $stmt->bind_param("i", $id);
            // $stmt->execute();
            // $stmt->close();

            // // Then, delete the product itself
            // $stmt2 = $conn->prepare("DELETE FROM products WHERE id = ?");
            // $stmt2->bind_param("i", $id);
            // $stmt2->execute();
            // $stmt2->close();

            echo "Product Id: " . $id;

        }

        if ($action == 'deleteVariant') {
            // // Delete variant
            // $stmt = $conn->prepare("DELETE FROM variants WHERE id =?");
            // $stmt->bind_param("i", $id);
            // $stmt->execute();
            // $stmt->close();

            echo "Variant Id: " . $id;

        }
    }
}
$conn->close();
?>
