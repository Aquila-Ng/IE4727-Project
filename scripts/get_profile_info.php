<?php
    session_start();
    
    include "../includes/config/db_connect.php";

    if (isset($_SESSION['logged_in']) || ($_SESSION['logged_in'] == true)){

        if ($_SESSION['role'] === "user"){

            $email = filter_var($_SESSION["email"], FILTER_SANITIZE_EMAIL);
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);

            if ($email) {
                $query = "SELECT email, first_name, last_name, phone_number, address, country, postal_code  FROM users WHERE email = ? LIMIT 1";

                $stmt = $conn -> prepare($query);
                $stmt -> bind_param("s", $email);
                $stmt -> execute();
                
                $result = $stmt -> get_result();

                // Split the address into two lines based on a delimiter, e.g., a comma
                

                if ($result -> num_rows > 0) {
                    $user = $result -> fetch_assoc();
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
        else if ($_SESSION["role"] === "admin"){
            header("Location: ./admin.php"); // Redirect to admin page
        }
    }
    else {
        header("Location: ./index.php"); // Redirect to admin page
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
            $output = implode(',', $output);
    
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
    }
?>