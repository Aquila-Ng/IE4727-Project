<?php 
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        var_dump($_GET);
        echo "<br><hr>";
        $variant_id = $_GET['variantId'];
        
        var_dump($_SESSION['cart']);
        echo "<br><hr>";
        if ((int)$_GET['quantity'] == 0){
            remove_from_cart($variant_id);
        }
        else if ((int)$_GET['quantity'] <= (int)$_SESSION['cart'][$variant_id]){
            decrement_quantity($variant_id);
        }
        else {
            increment_quantity($variant_id);
        }
        // header("Location: ../views/cart.php");
    }

    // three options, 
    function remove_from_cart($variant_id) {
        // For removing an item
        unset($_SESSION['cart'][$variant_id]);
    }

    function increment_quantity($variant_id){
        echo $variant_id;
        // $new_value = (int)$_SESSION['cart'][$variant_id]['quantity'] + 1;
        // echo $new_value;
        // $_SESSION['cart'][$variant_id]['quantity'] = $new_value;
        // echo $_SESSION['cart'][$variant_id]['quantity'];
    }

    function decrement_quantity($variant_id){
        echo "Variant_id: $variant_id";
        $_SESSION['cart'][$variant_id]['quantity'] -= 1;
    }
?>