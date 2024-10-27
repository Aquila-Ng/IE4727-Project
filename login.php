<?php
 include('includes/components/navbar.php');
 include('includes/components/form.php');
 include('includes/components/footer.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/styles.css" />
</head>
<body class="animated-gradient m-0">
    <?php
       navbar(false);
    ?>
    <div class="content ">
        <div class="container">
        <?php 
            authForm('login');
        ?>
        </div>
    </div>
    <?php
        footer(false);
    ?>
    <script type="module" src="./assets/js/main.js"></script>
</body>
</html>

