<?php 
    session_start();

    // Initialise cart array in session (Dummy Data)
    // $_SESSION['cart'] = [
    //     1 => ['variant_id' => 1, 'quantity' => 5],
    //     2 => ['variant_id' => 2, 'quantity' => 4]
    // ]; 

    $userDetails = [];
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
            get_profile_details($userDetails);
            get_price($cartItems, $prices);
        }
        else if ($_SESSION['role'] === "admin"){
            header("Location: ./admin-order.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./login.php");
    }
    
    function get_profile_details(&$userDetails){
        include '../includes/config/db_connect.php';
        
        $email = filter_var($_SESSION["email"], FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($email) {
            $query = "SELECT email, first_name, last_name, phone_number, address, country, postal_code  FROM users WHERE email = ? LIMIT 1";

            $stmt = $conn -> prepare($query);
            $stmt -> bind_param("s", $email);
            $stmt -> execute();
            
            $result = $stmt -> get_result();
            
            if ($result -> num_rows > 0) {
                $user = $result -> fetch_assoc();
                // Split the address into two lines based on a delimiter, e.g., a comma
                $address_parts = explode(' ', $user['address'], 2);

                // Handle cases where address might have only one part
                $address_line1 = trim($address_parts[0]);
                $address_line2 = isset($address_parts[1]) ? trim($address_parts[1]) : '';
                $userDetails = [
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'contact_number' => $user['phone_number'],
                    'address_line1' => $address_line1,
                    'address_line2' => $address_line2,
                    'country' => $user['country'],
                    'postal_code' => $user['postal_code']
                ];
            }
            $stmt -> close();   
        }
    }

    function get_price(&$cartItems, &$prices){
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
                    variants.color 
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
                        'cart_id' => 0,
                        'name' => $row['name'],
                        'price' => $row['price'],
                        'variant_id' => $row['id'],
                        'quantity' => $_SESSION['cart'][$variant_id]['quantity'],
                        'max_quantity' => $row['quantity'],
                        'image' => $row['image'],
                        'variant_name' => $row['color']
                    ];
    
                    $prices['item'] += (int)$cart['quantity'];
                    $prices['subtotal'] += (float)($row['price'] * $cart['quantity']);
                    
                    $cartItems[] = $cart;
                }
    
                $prices['gst'] = 0.09/1.09 * $prices['subtotal'];
                $prices['total'] = $prices['subtotal'] + $prices['delivery']; 
            }
        }
    }
?>