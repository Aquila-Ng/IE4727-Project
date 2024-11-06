<?php 
    require '../php_mail/config.php';
    require '../php_mail/script.php';

    session_start();

    include "../includes/config/db_connect.php";
    
    $email = $_SESSION['email'];
    
    $sql = " 
        SELECT 
            orders.id, 
            users.email,  
            orders.date_time,
            orders.total_amount
        FROM 
            orders 
        JOIN 
            users 
        ON 
            orders.user_id = users.id
        WHERE
            users.email = '$email'
        ORDER BY
            orders.date_time, orders.id
        DESC LIMIT 1";
    $result = $conn -> query($sql);
    $order = $result -> fetch_assoc();
    
    $to = "donutnle1999@gmail.com";
    $subject = "Order Receipt - Order #" . $order['id'];
    
    // Compose HTML email content
    $message = "
    <html>
    <head>
        <title>Your Order Receipt</title>
    </head>
    <body>
        <h2>Thank you for your order!</h2>
        <p>Order ID: " . $order['id'] . "</p>
        <p>Date: " . $order['date_time'] . "</p>
        <table border='1' cellspacing='0' cellpadding='5'>
            <tr>
                <th>Item</th><th>Quantity</th><th>Price</th>
            </tr>";

    $orderItemsSql = "
    SELECT 
        order_items.order_id,
        variants.name AS variant_name,
        products.name AS product_name,
        order_items.quantity AS order_items_quantity,      
        products.price,
        orders.total_amount
    FROM      
        order_items 
    JOIN      
        variants ON order_items.variant_id = variants.id 
    JOIN     
        products ON variants.product_id = products.id 
    JOIN
        orders ON order_items.order_id = orders.id
    WHERE order_items.order_id = '" . $order['id'] . "'";
    
    $orderItemsResult = $conn->query($orderItemsSql);
    while ($item = $orderItemsResult->fetch_assoc()) {
        $message .= "
        <tr>
            <td>" . $item['product_name'] . " (" . $item['variant_name'] . ")</td>
            <td>" . $item['order_items_quantity'] . "</td>
            <td>" . $item['price'] . "</td>
        </tr>";
    }
    
    $message .= "
        </table>
        <br>
        <p>Total: $" . $order['total_amount'] . "</p>
    </body>
    </html>";

    // Set content-type for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: no-reply@localhost" . "\r\n";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Receipt sent to $to.";
    } else {
        echo "Error sending receipt.";
    }

    $conn->close();
?>