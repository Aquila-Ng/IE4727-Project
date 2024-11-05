<?php
    session_start();

    include "../includes/config/db_connect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cartItems = [];
        $prices = [
            'item' => 0,
            'subtotal' => 0,
            'delivery' => 29.99,
            'gst' => 0,
            'total' => 0
        ];

        update_user_profile();
        get_items_and_prices($cartItems, $prices);
        new_order($cartItems, $prices);
    }
    
    function update_user_profile(){
        include "../includes/config/db_connect.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            
            if ($email){
                $first_name = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING));
                $last_name = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING));
                $contact_number = trim(filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING));
                $address_first_line = trim(filter_input(INPUT_POST, 'address_first_line', FILTER_SANITIZE_STRING));
                $address_second_line = trim(filter_input(INPUT_POST, 'address_second_line', FILTER_SANITIZE_STRING));
                $address = $address_first_line . " " . $address_second_line;
                $country = trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING));
                $postal_code = trim(filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_STRING));

                $update_query = "
                        UPDATE users SET 
                            first_name = ?,
                            last_name = ?,
                            email = ?,
                            phone_number = ?,
                            address = ?,
                            country = ?,
                            postal_code = ?
                        WHERE 
                            email = ?";
                
                $stmt = $conn -> prepare($update_query);
                
                $stmt -> bind_param("ssssssss",
                    $first_name,
                    $last_name,
                    $email,
                    $contact_number,
                    $address,
                    $country,
                    $postal_code,
                    $email
                );
                
                $stmt -> execute();
                $stmt -> close();
            }
        }      
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
                    
                    // array_push($cartItems, $cart);
                    $cartItems[] = $cart;
                }
    
                $prices['gst'] = 0.09/1.09 * $prices['subtotal'];
                $prices['total'] = $prices['subtotal'] + $prices['delivery']; 

            }
        }
    }

    function new_order(&$cartItems, &$prices){
        include '../includes/config/db_connect.php';

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($email){
            $get_email = "SELECT id, email, address, country, postal_code FROM users WHERE email = ?";
            $stmt = $conn -> prepare($get_email);
            $stmt -> bind_param("s", $email);
            $stmt -> execute();
            
            $result = $stmt -> get_result();
            $stmt -> close();
            
            if ($result -> num_rows > 0) {
                $user = $result -> fetch_assoc();

                $user_id = (int)$user["id"];
                $shipping_address = $user["address"];
                $country = $user["country"];
                $postal_code = $user["postal_code"];
                $total_amount = (float)$prices['total'];
                
                // Insert into `orders` table
                $orderQuery = "INSERT INTO orders (user_id, status, total_amount, shipping_address, country, postal_code) VALUES (?, 'processing', ?, ?, ?, ?)";
                $stmtOrder = $conn->prepare($orderQuery);
                $stmtOrder->bind_param("idsss", $user_id, $total_amount, $shipping_address, $country, $postal_code);

                if ($stmtOrder->execute()) {
                    
                    // Get the last inserted `order_id`
                    $order_id = $conn->insert_id;

                    // Prepare query to insert into `order_items`
                    $itemQuery = "INSERT INTO order_items (order_id, variant_id, quantity, price) VALUES (?, ?, ?, ?)";
                    $stmtItem = $conn->prepare($itemQuery);

                    // Prepare query to UPDATE quantity `order_items`
                    $updateQuantityQuery = "UPDATE variants SET quantity = quantity - ? WHERE id = ?";
                    $stmtStock = $conn->prepare($updateQuantityQuery);

                    foreach ($cartItems as $item){
                        $variant_id = $item['variant_id'];
                        $quantity = $item['quantity'];
                        $price = (float)$item['price'] * $quantity; 

                        // Bind parameters and execute the statement to insert into order_items
                        $stmtItem->bind_param("iiid", $order_id, $variant_id, $quantity, $price);
                        $stmtItem->execute();

                        // Bind parameters and execute the statement to update stock
                        $stmtStock->bind_param("ii", $quantity, $variant_id);
                        $stmtStock->execute();
                    }
                }

                echo "Order and items inserted successfully. <a href=../views/index.php>Return</a>";
                } 
            else {
                echo "Error inserting order: " . $stmtOrder->error;
            }
            
        }
            
    }
        
?>