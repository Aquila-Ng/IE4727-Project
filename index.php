<?php
include('includes/components/product-card.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/styles.css" />
</head>
<body class="m-0">
    <?php
    include('includes/components/navbar.php');
    ?>
    <div class="content">
        <div class="container d-flex flex-wrap justify-center">
            <?php
            product_card('1','Awesome Product 1','$19.99',['1', '2', '3'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('2','Awesome Product 2','$19.99',['4', '5', '6'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('3','Awesome Product 3','$19.99',['7', '8', '9'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('4','Awesome Product 4','$19.99',['10', '11', '12'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('5','Awesome Product 5','$19.99',['13', '14', '15'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('6','Awesome Product 6','$19.99',['16', '17', '18'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('7','Awesome Product 7','$19.99',['19', '20', '21'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
            <?php
            product_card('8','Awesome Product 8','$19.99',['22', '23', '24'],['#ff0000', '#00ff00', '#0000ff'], ['./assets/product-image.png', './assets/product-image-1.png', './assets/product-image-2.png'])
            ?>
        </div>
    </div>
    <?php
        include('includes/components/footer.php');
    ?>
    <script type="module" src="./assets/js/main.js"></script>
</body>
</html>

