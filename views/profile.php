<?php
 include('../includes/components/navbar.php');
 include('../includes/components/form.php');
 include('../includes/components/footer.php');


 $userDetails = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
    'contact_number' => '1234567890',
    'address_line1' => '123 Main St',
    'address_line2' => 'Apt 4B',
    'country' => 'USA',
    'postal_code' => '10001'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body class="animated-gradient m-0">
    <?php
       navbar(false);
    ?>
    <div class="content">
        <div class="container">
            <?php
                profileForm($userDetails);
            ?>
        </div>
    </div>
    <?php
        footer(false);
    ?>
    <script type="module" src="../assets/js/main.js"></script>
</body>
</html>
