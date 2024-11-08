<?php
    session_start();
    require '../../php_mail/config.php';
    require '../../php_mail/script.php';
    include '../config/db_connect.php';
    
    
    if (isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == true)){
        if ($_SESSION['role'] === "admin"){
            $query = "UPDATE orders SET status = ? WHERE id = ?";
            // Check if the form is submitted via POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Get the order ID and status ID from the form submission
                $orderId = isset($_POST['orderId']) ? (int)$_POST['orderId'] : 0;
                $statusId = isset($_POST['statusId']) ? (int)$_POST['statusId'] : 0;
                // $to = ""  INSERT EMAIL ADDRESS HERE
                $to = "donutnle1999@gmail.com";
                // Output the values for debugging
                $stmt = $conn -> prepare($query);
                $stmt -> bind_param('ii', $statusId, $orderId);
                $stmt -> execute();
                
                if ($stmt -> affected_rows > 0){
                    send_email($to, $statusId, $orderId);
                    $stmt -> close();
                    header('Location: ../../views/admin-order.php');
                }
                else {
                    echo "Error: Error updating order Status";
                }
            }
        }
        else {
            header("Location: ./index.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./login.php");
    }
    
    function send_email($to, $message_type, $orderId){
        include '../config/db_connect.php';
        $order_query = "
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
            orders.id = ?";
        $stmt = $conn -> prepare($order_query);
        $stmt -> bind_param('i', $orderId);
        $stmt -> execute();
        $result = $stmt -> get_result();

        switch ((int)$message_type){
            case 4: // Completed Order
                $order = $result -> fetch_assoc();
                $subject = "Order  Completed - Thank You for Shopping with Us!";
                $message = "
                    <html>
                    <head>
                        <title>Order Completed</title>
                        <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                            h2 { color: #4CAF50; }
                        </style>
                    </head>
                    <body>
                        <div class='receipt-container'>
                            <h2>Your Order is Completed!</h2>
                            <p>Thank you for shopping with us! Your order is now complete, and we hope you enjoy your purchase.</p>
                            
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
                            
                            <p>If you have any questions, please contact our support team. We hope to serve you again soon!</p>
                        </div>
                    </body>
                    </html>";
                sendMail($to, $subject, $message);
                break;
            case 5: // Shipped Order
                $subject = "Your Order Has Been Shipped! 📦";
                $order = [];
                $table_data = "";
                $hasItems = false; // Track if items are found

                while ($item = $result->fetch_assoc()) {
                    $itemTotal = $item['order_items_quantity'] * $item['price'];
                    $table_data .= "
                    <tr>
                        <td>" . htmlspecialchars($item['product_name']) . " (" . htmlspecialchars($item['variant_name']) . ")</td>
                        <td>" . htmlspecialchars($item['order_items_quantity']) . "</td>
                        <td>$" . number_format($item['price'], 2) . "</td>
                        <td>$" . number_format($itemTotal, 2) . "</td>
                    </tr>";
                    $order = $item;
                    $hasItems = true;
                }

                if ($hasItems) { // Only send email if items were fetched
                    $message = "
                        <html>
                        <head>
                            <title>Your Order Has Shipped</title>
                            <style>
                                body { font-family: Arial, sans-serif; color: #333; }
                                .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                                h2 { color: #4CAF50; }
                                .order-summary { margin-top: 20px; }
                                .order-details, .order-items { width: 100%; border-collapse: collapse; }
                                .order-details td, .order-items th, .order-items td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                                .order-items th { background-color: #4CAF50; color: white; }
                                .tracking-info { font-size: 14px; color: #555; margin-top: 15px; }
                            </style>
                        </head>
                        <body>
                            <div class='receipt-container'>
                                <h2>Your Order Has Shipped!</h2>
                                <p>Good news! Your order is on its way. Here are your order details:</p>
                                
                                <table class='order-details'>
                                    <tr>
                                        <td><strong>Order ID:</strong></td>
                                        <td>" . htmlspecialchars($order['id']) . "</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Date & Time:</strong></td>
                                        <td>" . htmlspecialchars($order['date_time']) . "</td>
                                    </tr>
                                </table>
                                
                                <h3 class='order-summary'>Order Summary</h3>
                                <table class='order-items'>
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>" . $table_data . "
                                    <tr class='order-total'>
                                        <td colspan='3' style='text-align: right;'>Shipping:</td>
                                        <td>$29.99</td>
                                    </tr>
                                    <tr class='order-total'>
                                        <td colspan='3' style='text-align: right;'><strong>Total:</strong></td>
                                        <td>$" . number_format($order['total_amount'], 2) . "</td>
                                    </tr>
                                </table>
                                
                                <p class='tracking-info'>You can track your shipment using the tracking number provided in a separate email.</p>
                                <p>Thank you for shopping with us!</p>
                            </div>
                        </body>
                        </html>";
                    sendMail($to, $subject, $message);
                }
                break;
            case 6: // Cancelled Order
                $subject = "Your Order Has Been Cancelled";
                $order = $result -> fetch_assoc();
                $message = "
                    <html>
                    <head>
                        <title>Order Cancelled</title>
                        <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                            h2 { color: #FF5733; }
                        </style>
                    </head>
                    <body>
                        <div class='receipt-container'>
                            <h2>Your Order Has Been Cancelled</h2>
                            <p>We regret to inform you that your order has been cancelled. Here are your order details:</p>
                            
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
                            
                            <p>If payment has already been made, a refund will be processed shortly. If you have any questions, please contact our support team.</p>
                        </div>
                    </body>
                    </html>";
                sendMail($to, $subject, $message);
                break;
            case 7: // Refunded Order
                $subject = "Your Order Has Been Refunded";
                $order = $result -> fetch_assoc();
                $message = "
                    <html>
                    <head>
                        <title>Order Refunded</title>
                        <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                            h2 { color: #FF5733; }
                        </style>
                    </head>
                    <body>
                        <div class='receipt-container'>
                            <h2>Your Order Has Been Refunded</h2>
                            <p>Your order has been refunded. Here are the details of your refund:</p>
                            
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
                            
                            <p>The refund has been processed, and the amount should be credited back to your account shortly. If you have questions, please reach out to our support team.</p>
                        </div>
                    </body>
                    </html>";
                sendMail($to, $subject, $message);
                break;
            case 8: // Failed Order
                $subject = "Order Failed - Action Needed to Complete Your Purchase";
                $order = $result -> fetch_assoc();
                $message = "
                    <html>
                    <head>
                        <title>Order Failed</title>
                        <style>
                            body { font-family: Arial, sans-serif; color: #333; }
                            .receipt-container { width: 100%; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; background-color: #f9f9f9; }
                            h2 { color: #E74C3C; }
                            .order-details { width: 100%; margin-top: 20px; border-collapse: collapse; }
                            .order-details td { padding: 10px; border: 1px solid #ddd; text-align: left; }
                        </style>
                    </head>
                    <body>
                        <div class='receipt-container'>
                            <h2>Order Failed</h2>
                            <p>Unfortunately, we were unable to process your order due to a technical issue or a payment error.</p>
                            
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
                            
                            <p>If you’d like to retry your order, please return to our website and try again. Alternatively, feel free to contact our support team for assistance.</p>
                            
                            <p>We apologize for any inconvenience caused and appreciate your patience.</p>
                        </div>
                    </body>
                    </html>";
                sendMail($to, $subject, $message);
                break;
            default:
                return;
        }
        $stmt -> close();
    }
?>

