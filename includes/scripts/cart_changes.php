<?php 
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == "GET"){
        $variant_id = $_GET['variantId'];
        
        if ((int)$_GET['quantity'] == 0){
            unset($_SESSION['cart'][$variant_id]);
        }
        else if ((int)$_GET['quantity'] < (int)$_SESSION['cart'][$variant_id]['quantity']){
            $_SESSION['cart'][$variant_id]['quantity'] = (int)$_SESSION['cart'][$variant_id]['quantity'] - 1;
        }
        else if ((int)$_GET['quantity'] > (int)$_SESSION['cart'][$variant_id]['quantity']){
            $_SESSION['cart'][$variant_id]['quantity'] = (int)$_SESSION['cart'][$variant_id]['quantity'] + 1;
        }
        
        header("Location: ../../views/cart.php");
    }
?>