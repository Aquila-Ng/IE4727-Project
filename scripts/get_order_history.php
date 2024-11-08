<?php 
    $allOrderItems = [];
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
            get_order_history($allOrderItems);
        }
        else if ($_SESSION['role'] === "admin"){
            header("Location: ./admin.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./login.php");
    }

    function get_order_history(&$allOrderItems){
        include '../includes/config/db_connect.php';

        $email = filter_var($_SESSION["email"], FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($email){
            $query = "
                SELECT
                    u.email,
                    o.id AS orderId,
                    o.date_time AS date,
                    o.total_amount AS totalAmt,
                    oi.id AS cartId,
                    p.name AS productName,
                    p.price,
                    p.id AS productId,
                    v.id AS variantId,
                    oi.quantity,
                    v.image,
                    v.name AS variantName,
                    v.color AS variantColor
                FROM 
                    orders o
                JOIN 
                    users u ON o.user_id = u.id  
                JOIN 
                    order_items oi ON o.id = oi.order_id
                JOIN 
                    variants v ON oi.variant_id = v.id
                JOIN 
                    products p ON v.product_id = p.id
                WHERE
                    email = ?   
                ORDER BY 
                    o.id DESC, oi.id;
            ";

            $stmt = $conn -> prepare($query);
            $stmt -> bind_param('s', $email);
            $stmt -> execute();

            $result = $stmt -> get_result();

            $currentOrderId = null;
            $orderIndex = -1;

            while ($row = $result->fetch_assoc()) {
                // Check if the current row's order ID is different from the previous one
                if ($currentOrderId !== $row['orderId']) {
                    // Create a new order entry
                    $currentOrderId = $row['orderId'];
                    $orderIndex++;
                    
                    $allOrderItems[$orderIndex] = [
                        'orderId' => $row['orderId'],
                        'date' => $row['date'],
                        'totalAmt' => $row['totalAmt'],
                        'items' => []
                    ];
                }

                // Add the current row's item details to the current order's 'items' array
                $allOrderItems[$orderIndex]['items'][] = [
                    'cartId' => $row['cartId'],
                    'name' => $row['productName'],
                    'price' => $row['price'],
                    'productId' => $row['productId'],
                    'variantId' => $row['variantId'],
                    'quantity' => $row['quantity'],
                    'image' => $row['image'],
                    'variantName' => $row['variantName']
                ];
            }
        }
    }
?>