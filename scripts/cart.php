<?php 
    // Initialising dummy cart;
    // Dummy data
    // $_SESSION['cart'] = [
    //     1 => ['variant_id' => 1, 'quantity' => 5],
    //     2 => ['variant_id' => 2, 'quantity' => 4]
    // ]; 

    $cartItems = [];
    $prices = [
        'item' => 0,
        'subtotal' => 0,
        'delivery' => 29.99,
        'gst' => 0,
        'total' => 0
    ];
    
    if (isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == true)){
        if ($_SESSION['role'] === "user"){
            
            get_items_and_prices($cartItems, $prices);
        }
        else if ($_SESSION['role'] === "admin"){
            header("Location: ./admin-order.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./login.php");
    }
    

    function get_items_and_prices(&$cartItems, &$prices){
        include '../includes/config/db_connect.php';
        
        if (!empty($_SESSION['cart'])) {
            $variant_ids = array_column($_SESSION['cart'], 'variant_id');
            $variant_id_count = implode(",", array_fill(0, count($variant_ids), "?"));
            
            if ($variant_id_count) {
                
                $query = "
                SELECT 
                    products.name, 
                    products.price, 
                    variants.id,
                    variants.quantity, 
                    variants.image, 
                    variants.name AS variant_name 
                FROM 
                    variants
                JOIN 
                    products
                ON 
                    products.id = variants.product_id 
                WHERE 
                    variants.id 
                IN ( $variant_id_count )";
                
                $stmt = $conn->prepare($query);
                $stmt-> execute($variant_ids);
                $result = $stmt->get_result();
                $stmt-> close();
                
                while($row = $result->fetch_assoc()) {
                    $variant_id = $row['id'];
                    $cart =  [
                        'cartId' => 2,
                        'name' => $row['name'],
                        'price' => (float)$row['price'],
                        'variantId' => $row['id'],
                        'quantity' => (int)$_SESSION['cart'][$variant_id]['quantity'],
                        'maxQuantity' => (int)$row['quantity'],
                        'image' => $row['image'],
                        'variantName' => $row['variant_name']
                    ];
                    
                    $prices['item'] += (int)$cart['quantity'];
                    $prices['subtotal'] += (float)($row['price'] * $cart['quantity']);
                    
                    // array_push($cartItems, $cart);
                    $cartItems[] = $cart;
                }
    
                $prices['gst'] = 0.09/1.09 * $prices['subtotal'];
                $prices['total'] = $prices['subtotal'] + $prices['delivery']; 
            }
        }
    }
?>