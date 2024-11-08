<?php
    session_start();
    
    if (isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == true)){
        if ($_SESSION['role'] === "admin"){
            $orderItems = get_orders();
        }
        else {
            header("Location: ./index.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./login.php");
    }

    function get_orders(){
        include '../includes/config/db_connect.php';
        $orderItems = [];
        $query = "
            SELECT 
                orders.id,
                orders.date_time,
                orders.status,
                users.first_name,
                users.last_name,
                users.email,
                orders.shipping_address,
                orders.total_amount
            FROM
                orders
            JOIN
                users ON orders.user_id = users.id
            ORDER BY 
                orders.id DESC, orders.date_time DESC
            LIMIT 50";

        $stmt = $conn -> prepare($query);
        $stmt -> execute();
        $result = $stmt -> get_result();
        
        while ($order = $result->fetch_assoc()) {
            $name = $order['first_name'] . " " . $order['last_name'];
            array_push($orderItems, [
                'id' => $order['id'],
                'date' => $order['date_time'],
                'statusId' => (int)$order['status'],
                'name' => $name,
                'billing_address' => $order['shipping_address'],
                'shipping_address' => $order['shipping_address'],
                'total_amount' => $order['total_amount']
            ]);
        }

        return $orderItems;
    }
?>