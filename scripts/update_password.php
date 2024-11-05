<?php 
    session_start();

    include "../includes/config/db_connect.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = filter_var($_SESSION['email'],FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        
        // Check if email format found in session is accurate.
        if ($email){
            $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/';
            $password_err = "";

            // Sanitise and validate current password
            $old_password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
            $old_password_bool = validate_password($password_regex, $old_password);
            if (!$old_password_bool){
                exit("Error: old password is invalid, please try again");
            }

            // Sanitise and validate new password
            $new_password = filter_var(trim($_POST['new_password']), FILTER_SANITIZE_STRING);
            $new_password_bool = validate_password($password_regex, $new_password);
            if (!$new_password_bool){
                exit("Error: new password is invalid, please try again");
            }

            // Sanitise and validate confirm new password
            $confirm_password = filter_var(trim($_POST['confirm_password']), FILTER_SANITIZE_STRING);
            $confirm_password_bool = (validate_password($password_regex, $confirm_password) && ($confirm_password === $new_password));
            if (!$confirm_password_bool){
                exit("Error: Please check if password match and try again");
            }
            
            // ONLY IF all values are valid
            if ($old_password_bool && $new_password_bool && $confirm_password_bool){ 
                $stmt = $conn -> prepare("SELECT password FROM users WHERE email = ? LIMIT 1");
                $stmt -> bind_param('s', $email);
                $stmt -> execute();
                $result = $stmt -> get_result();
                $stmt -> close();
                

                // Update this with TRY statement for error handling
                if ($result -> num_rows > 0) {
                    $user = $result -> fetch_assoc();

                    // Check and verify old password
                    if (password_verify($old_password, $user['password'])){
                        // Since we checked that new and confirm new passwords are valid and are the same
                        $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

                        $stmt = $conn -> prepare("UPDATE users SET password = ? WHERE email = ?");
                        $stmt -> bind_param('ss', $new_hashed_password, $email);
                        $stmt -> execute();
                        $stmt -> close();
                    }
                    else {
                        exit("Error: Old Password does not match database");
                    }
                }
                else {
                    exit('Error: Error retrieving user information');
                }
            }
        }
        else{
            exit("Error: Error getting email from session token");
        }
        header("Location: ../views/profile.php");
    }

    function validate_password($password_regex, $password){
        $password_error_message = "";
        if (empty($password)){ // empty password
            exit("Password Required");
            return false;
        }
        else if (!preg_match($password_regex, $password)){ // regex fail
            if (strlen(trim($password)) < 8){
                $password_error_message .= "- 8 or more characters<br>";
            }
            if (!preg_match("/(?=.*?[A-Z])/", $password)){
                $password_error_message .= '- One upper case English letter<br>';
            }
            if (!preg_match("/(?=.*?[a-z])/", $password)){
                $password_error_message .= '- One lower case English letter<br>';
            }
            if (!preg_match("/(?=.*?[0-9])/", $password)){
                $password_error_message .= '- One digit<br>';
            }
            if (!preg_match("/(?=.*?[#?!@$%^&*-.])/", $password)){
                $password_error_message .= '- One special character<br>';
            }
            exit("Password must contain the following:<br>$password_error_message");
            return false;
        }
        else {
            return true;   
        }
    }
?>