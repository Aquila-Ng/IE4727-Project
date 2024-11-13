<?php
    // Start session
    session_start();
    
    // Include database connection
    include '../includes/config/db_connect.php';

    // Initialize variables
    $email = $password = $first_name = $last_name = "";
    $error_message = "";

    // Display success message if redirected
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        $general_err = "<div class='alert alert-success' role='alert'>Registration successful! Please <a href='login.php'>login</a>.</div>";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        // Get and sanitize input 
        $email = strtolower(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        $email_regex = "/^[\w.-]+@(?:[\w-]+\.){1,3}[a-zA-Z]{2,3}$/";

        $password = $_POST['password'];
        $password_regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/';

        $confirm_password = $_POST['confirm_password'];

        $first_name = ucwords(trim($_POST['first_name']));
        $last_name = ucwords(trim($_POST['last_name']));
        
        $email_bool = validate_email($email_regex, $email, $errorMessage);  
        $password_bool = validate_password($password_regex, $password, $password_err);  
        $confirm_password_bool = (validate_password($password_regex, $confirm_password, $confirm_password_err) && ($password == $confirm_password));  
        $first_name_bool = validate_name($first_name, $first_name_err, "First name");  
        $last_name_bool = validate_name($last_name, $last_name_err, "Last name");

        if($email_bool && $password_bool && $confirm_password_bool && $first_name_bool && $last_name_bool){
            // Check if email is used.
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
            
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $email_err = "Email already registered.";
            }
            else {
                
                $stmt = $conn->prepare("SELECT COUNT(*) FROM users");
                $stmt->execute();
                $stmt->bind_result($user_count); // Bind the result to a variable
                $stmt->fetch(); // Fetch the result
                $stmt->close();
                
                $role = ($user_count == 0) ? "admin" : "user"; // First user is "admin", others are "user"
                
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);

                try {
                    
                    // Prepare the SQL statement using mysqli
                    if(!($stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, role) VALUES (?, ?, ?, ?, ?)"))) {
                        $isInvalid  = true;
                        $isSuccessful= false;
                        $errorMessage = "Prepare failed: " . $stmt->error . $conn->error;
                    }
    
                    // Bind parameters using mysqli bind_param
                    if(!$stmt->bind_param("sssss", $email, $hashed_password, $first_name, $last_name, $role)) {
                        $isInvalid  = true;
                        $isSuccessful = false;
                        $errorMessage = "Binding parameters failed: " . $stmt->error . $conn->error;
                    }
                    
                    // Execute the statement with error checking
                    if (!$stmt->execute()) {
                        $isInvalid  = true;
                        $isSuccessful = false;
                        $errorMessage = "Execute failed: " . $stmt->error . $conn->error;
                    } else {
                        // Success! Redirect?
                        // Might need to think about messages and error messages
                        $isInvalid = false;
                        $isSuccessful = true;
                        $successMessage = "Account has been successfully registered. Please login <a href = 'login.php'>here</a>";
                        header('Location: login.php');
                    }
                    
                    $stmt->close();
                } catch (Exception $e) {
                    $isInvalid  = true;
                    $isSuccessful = false;
                    $errorMessage = "Database error: " . $e->getMessage();
                }
            }   
            $stmt->close();
        }
    }   
    
    function validate_email($email_regex, $email, $email_err){
        $email_err = "";
        if (empty($email)){ // empty email field
            $email_err = "Email Required";
            return false;
        }
        else if (!preg_match($email_regex, $email)){ // regex fail
            $email_err = "Invalid email";
            return false;
        }
        else {
            $email_err = "";
            return true;
        } 
    }

    function validate_password($password_regex, $password, $password_error){
        $password_error_message = "";
        if (empty($password)){ // empty password
            $password_err = "Password Required";
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
            $password_err = "Password must contain the following:<br>$password_error_message";
            return false;
        }
        else {
            $password_err = "";
            return true;   
        }
    }

    function validate_name($name, &$name_err, $field_name){
        if (empty($name)){
            $name_err = "$field_name is required";
            return false;
        }
        elseif (strlen($name) < 2){
            $name_err = "$field_name must be at least 2 characters long";
            return false;
        }
        else {
            return true;
        }
    }
?>