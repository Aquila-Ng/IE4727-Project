<?php
    include('../includes/components/navbar.php');
    include('../includes/components/footer.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../assets/icons/serene-logo.svg">
    <title>SERENE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arsenal:ital,wght@0,400;0,700;1,400;1,700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="../assets/css/styles.css" />
</head>
<body class="m-0" >
    <?php
       navbar(false);
    ?>
    <main class="content d-flex items-center" style="background-image: url(../assets/images/banner/hero-banner-image-1.png); background-position:center; background-size:cover;">
        <div class="container d-flex flex-column pl-3" style="color: var(--background-color);">
            <h1 class="emphasized">Sorry</h1>
            <h2 class="emphasized">We couldn't find the page</h2>
            <p>Looks like a temporary error :/</p>
            <p class="mb-5">We will fix it soon we hope...</p>
            <a href="index.php">
                <button class="btn btn-primary">Return to Home</button>
            </a>
        </div>
    </main>
    <?php
        footer(false);
    ?>
    <script type="module" src="../assets/js/main.js"></script>
</body>
</html>

