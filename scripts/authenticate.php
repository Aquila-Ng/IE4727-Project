<?php 
    session_start();
    
    // Include database connection
    include '../includes/config/db_connect.php';

    // Check the login status and role
    if (isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] == true) {
        if ($_SESSION["role"] !== "admin"){
            // User is logged in but not an admin
            header("Location: ./index.php"); // Redirect to user index page
            exit;
        }
        else {
            // User is logged in as admin
            header("Location: ./admin.php"); // Redirect to admin page
            exit; // Stop further execution after redirect
        }
    } 

    $email = $password = "";
    $email_err = $password_err = "";

    $email_regex = "/^[\w.-]+@(?:[\w-]+\.){1,3}[a-zA-Z]{2,3}$/";
    $password_regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];
        
        $email_bool = validate($email, $email_regex, $email_err);
        $password_bool = validate($password, $password_regex, $password_err);

        if ($email_bool && $password_bool){
            $stmt = $conn -> prepare("SELECT email, password, role FROM users WHERE email = ?");
            $stmt -> bind_param("s", $email);
            $stmt -> execute();
            $result = $stmt->get_result();
            if ($result -> num_rows == 1) {
                $user = $result -> fetch_assoc();

                if (password_verify($password, $user["password"])){
                    session_start();

                    $_SESSION['logged_in'] = true;
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    if ($user["role"] === 'admin'){
                        header('Location: ./admin.php');
                    }
                    else {
                        header('Location: ./index.php');
                    }
                    exit;
                }
                else {
                    $general_err = "<div class='alert alert-danger' role='alert'>Error: Invalid password, please try again.</div>";
                }
            }
            else {
                // No user found with that email
                $general_err = "<div class='alert alert-danger' role='alert'>Error: Invalid Credentials, please try again</div>";
            }
        }
        else {
            $general_err = "<div class='alert alert-danger' role='alert'>Error: Invalid Credentials, please try again</div>;";
        }
    }

    function validate($value, $regex, &$err) {  // Pass error by reference
        if (empty($value)) { // empty email or password field
            $err = "Required";
            return false;
        } else if (!preg_match($regex, $value)) { // regex fail
            $err = "Invalid format";
            return false;
        } else {
            $err = "";  // Clear error if validation passes
            return true;
        } 
    }
?>