<?php
    session_start();
    require '../../php_mail/config.php';
    require '../../php_mail/script.php';
    include "../config/db_connect.php";
    
    $email = $_SESSION['email'];
    
    $sql = " 
        SELECT 
            orders.id, 
            users.email, 
            orders.date_time, 
            orders.total_amount, 
            order_items.order_id, 
            variants.name AS variant_name, 
            products.name AS product_name, 
            order_items.quantity AS order_items_quantity, 
            products.price
        FROM 
            order_items
        JOIN 
            variants ON order_items.variant_id = variants.id
        JOIN 
            products ON variants.product_id = products.id
        JOIN 
            orders ON order_items.order_id = orders.id
        JOIN 
            users ON orders.user_id = users.id
        WHERE 
            users.email = ?
            AND orders.id = (
                SELECT MAX(id) 
                FROM orders 
                WHERE user_id = users.id
            )";
            
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("s", $email);
    $stmt -> execute();
    $result = $stmt->get_result();
    $table_data = "";
    $order = [];
    while ($item = $result->fetch_assoc()) {
        $itemTotal = $item['order_items_quantity'] * $item['price'];
        $table_data .= "
          <tr>
            <td>" . $item['product_name'] . " (" . $item['variant_name'] . ")</td>
            <td>" . $item['order_items_quantity'] . "</td>
            <td>$" . number_format($item['price'], 2) . "</td>
            <td>$" . number_format($itemTotal, 2) . "</td>
          </tr>";
        $order = $item;
    }
    
    $to = "donutnle1999@gmail.com";
    $subject = "Order #Serene-" . $order['id']. " Confirmed";
    
    // Compose HTML email content
    $message = "
        <html>
        <head>
            <title>Your Order Receipt</title>
            <style>
                body { font-family: Arial, sans-serif; color: #333; }
                .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                h2 { color: #4CAF50; }
                .order-summary { margin-top: 20px; }
                .order-details, .order-items { width: 100%; border-collapse: collapse; }
                .order-details td, .order-items th, .order-items td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                .order-items th { background-color: #4CAF50; color: white; }
                .order-total { font-weight: bold; }
            </style>
        </head>
        <body>
            <div class='receipt-container'>
                <h2>Thank you for your order!</h2>
                <p>Your order has been successfully placed. Here are your order details:</p>
                
                <!-- Order Details -->
                <table class='order-details'>
                <tr>
                    <td><strong>Order ID:</strong></td>
                    <td>" . $order['id'] . "</td>
                </tr>
                <tr>
                    <td><strong>Date & Time:</strong></td>
                    <td>" . $order['date_time'] . "</td>
                </tr>
                </table>
                
                <!-- Order Items -->
                <h3 class='order-summary'>Order Summary</h3>
                <table class='order-items'>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>" . $table_data . "
                <tr class='order-total'>
                  <td colspan='3' style='text-align: right;'>Subtotal:</td>
                  <td>$" . number_format(((float)$order['total_amount'] - 29.99), 2) . "</td>
                </tr>
                <tr class='order-total'>
                  <td colspan='3' style='text-align: right;'>Shipping:</td>
                  <td>$29.99</td>
                </tr>
                <tr class='order-total'>
                  <td colspan='3' style='text-align: right;'><strong>Total:</strong></td>
                  <td>$" . number_format($order['total_amount'], 2) . "</td>
                </tr>
              </table>
              
              <!-- Footer Message -->
              <p style='margin-top: 20px;'>If you have any questions about your order, please contact our support team.</p>
              <p>Thank you for shopping with us!</p>
            </div>
          </body>
          </html>";

    // Send email
    if (sendMail($to, $subject, $message)) {
        echo "Receipt sent to $to.";
    } else {
        echo "Error sending receipt.";
    }

    $conn->close();
?>