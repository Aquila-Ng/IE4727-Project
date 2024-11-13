<?php 
    session_start();
    
    include "../config/db_connect.php";
    $old_email = $_SESSION['email'];
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $email = strtolower(filter_var($email, FILTER_VALIDATE_EMAIL));
        
        if ($email){
            $first_name = ucwords(trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING)));
            $last_name = ucwords(trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING)));
            $contact_number = trim(filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING));
            $address_first_line = trim(filter_input(INPUT_POST, 'address_first_line', FILTER_SANITIZE_STRING));
            $address_second_line = trim(filter_input(INPUT_POST, 'address_second_line', FILTER_SANITIZE_STRING));
            $address = strtolower($address_first_line . " " . $address_second_line);
            $country = ucwords(trim(filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING)));
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
                $old_email
            );
            
            $stmt -> execute();
            $stmt -> close();
            $_SESSION['email'] = $email;
        }
    }      
    header('Location: ../../views/profile.php');
    // Might need to include messages to note the successful change in details.
    // Error Handling for this also need to be accounted for.
?>