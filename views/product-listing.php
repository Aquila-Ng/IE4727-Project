<?php
 include('../includes/components/navbar.php');
include('../includes/components/product-card.php');
include('../includes/components/footer.php');
include('../includes/components/filter-and-sort.php');

$allProductItems = [
    [
        'id' => 0,
        'name' => 'Legacy Lunar Heritage',
        'price' => 750,
        'variants' => [
            [
                'variantId' => 0,
                'variantName' => 'Classic Elegance',
                'variantColor' => '#dcd7d1',
                'quantity' => 0,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/main.png',
            ],
            [
                'variantId' => 1,
                'variantName' => 'Timeless White',
                'variantColor' => '#e0e0e0',
                'quantity' => 5,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/main.png',
            ],
            [
                'variantId' => 2,
                'variantName' => 'Midnight Blue',
                'variantColor' => '#004678',
                'quantity' => 10,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png',
            ],
            [
                'variantId' => 3,
                'variantName' => 'Emerald Green',
                'variantColor' => '#025a38',
                'quantity' => 11,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/main.png',
            ],
            [
                'variantId' => 4,
                'variantName' => 'Sleek Anthracite',
                'variantColor' => '#9c9e9d',
                'quantity' => 12,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/main.png',
            ],
            [
                'variantId' => 5,
                'variantName' => 'Bronze Charm',
                'variantColor' => '#d9ad7c',
                'quantity' => 13,
                'image' => '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/main.png',
            ],
        ],
    ],
    [
        'id' => 1,
        'name' => 'Legacy Noble Classic',
        'price' => 700,
        'variants' => [
            [
                'variantId' => 6,
                'variantName' => 'Classic Black',
                'variantColor' => '#322f2e',
                'quantity' => 5,
                'image' => '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png',
            ],
            [
                'variantId' => 7,
                'variantName' => 'Elegant Charm',
                'variantColor' => '#ece8e1',
                'quantity' => 10,
                'image' => '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png',
            ],
        ],
    ],
    [
        'id' => 2,
        'name' => 'Adventurer Explorer Time',
        'price' => 600,
        'variants' => [
            [
                'variantId' => 8,
                'variantName' => 'Mahogany Black',
                'variantColor' => '#C0C0C0',
                'quantity' => 0,
                'image' => '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/main.png',
            ],
            [
                'variantId' => 9,
                'variantName' => 'Midnight Blue',
                'variantColor' => '#1F3A93',
                'quantity' => 5,
                'image' => '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/main.png',
            ],
            [
                'variantId' => 10,
                'variantName' => 'Ebony Classic',
                'variantColor' => '#6D4C41',
                'quantity' => 10,
                'image' => '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/main.png',
            ],
        ],
    ],
    [
        'id' => 3,
        'name' => 'Elegance BellaVita',
        'price' => 520,
        'variants' => [
            [
                'variantId' => 11,
                'variantName' => 'Vintage',
                'variantColor' => '#d5d3cf',
                'quantity' => 11,
                'image' => '../assets/images/products/watch/elegance-bellavita/vintage/main.png',
            ],
            [
                'variantId' => 12,
                'variantName' => 'Classic Brown',
                'variantColor' => '#3a3a3a',
                'quantity' => 12,
                'image' => '../assets/images/products/watch/elegance-bellavita/classic-brown/main.png',
            ],
            [
                'variantId' => 13,
                'variantName' => 'Emerald Green',
                'variantColor' => '#2f6237',
                'quantity' => 13,
                'image' => '../assets/images/products/watch/elegance-bellavita/emerald-green/main.png',
            ],
        ],
    ],
    [
        'id' => 4,
        'name' => "Adventurer Voyager Chrono",
        'description' => "The Adventurer Voyager Chrono is built for explorers seeking both functionality and style. This watch combines precision with a bold design, ready to accompany you on any journey.",
        'price' => 675,
        'variants' => [
            [
                'variantId' => 14,
                'variantName' => "Eclipse",
                'variantColor' => "#0A0A0A",
                'quantity' => 11,
                'image' => '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/main.png',
            ],
            [
                'variantId' => 15,
                'variantName' => "Solistice",
                'variantColor' => "#1B3A5F",
                'quantity' => 12,
                'image' => '../assets/images/products/watch/adventurer-voyager-chrono/solistice/main.png',
            ],
            [
                'variantId' => 16,
                'variantName' => "Halo",
                'variantColor' => "#C0C0C0",
                'quantity' => 13,
                'image' => '../assets/images/products/watch/adventurer-voyager-chrono/halo/main.png',
            ],
        ],
    ],
    [
        'id' => 5,
        'name' => "Adventurer Chrono Celestial",
        'description' => "The Adventurer Chrono Celestial offers a celestial-inspired design with high performance. A perfect companion for those who dream big and reach for the stars.",
        'price' => 780,
        'variants' => [
            [
                'variantId' => 17,
                'variantName' => "Galaxy Blue",
                'variantColor' => "#0D1B42",
                'quantity' => 11,
                'image' => '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/main.png',
            ],
            [
                'variantId' => 18,
                'variantName' => "Celeste",
                'variantColor' => "#FAF9F6",
                'quantity' => 12,
                'image' => '../assets/images/products/watch/adventurer-chrono-celestial/celeste/main.png',
            ],
            [
                'variantId' => 19,
                'variantName' => "Midnight Black",
                'variantColor' => "#1A1A1A",
                'quantity' => 13,
                'image' => '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/main.png',
            ],
        ],
    ],
    [
        'id' => 6,
        'name' => "Elegance Virtuoso",
        'description' => "The Elegance Virtuoso is a watch for those who appreciate subtle beauty and refined craftsmanship. This piece exudes sophistication and elegance.",
        'price' => 650,
        'variants' => [
            [
                'variantId' => 20,
                'variantName' => "Argent",
                'variantColor' => "#C0C0C0",
                'quantity' => 11,
                'image' => '../assets/images/products/watch/elegance-virtuoso/argent/main.png',
            ],
            [
                'variantId' => 21,
                'variantName' => "Noir",
                'variantColor' => "#1C1C1C",
                'quantity' => 0,
                'image' => '../assets/images/products/watch/elegance-virtuoso/noir/main.png',
            ],
            [
                'variantId' => 22,
                'variantName' => "Perle",
                'variantColor' => "#F2E6E0",
                'quantity' => 13,
                'image' => '../assets/images/products/watch/elegance-virtuoso/perle/main.png',
            ],
            [
                'variantId' => 23,
                'variantName' => "Celeste",
                'variantColor' => "#A4C8E1",
                'quantity' => 0,
                'image' => '../assets/images/products/watch/elegance-virtuoso/celeste/main.png',
            ],
        ],
    ],
    [
        'id' => 7,
        'name' => "Elegance Sovereign",
        'description' => "The Elegance Sovereign is a timeless piece with a classic charm, perfect for those who value tradition and elegance in their everyday style.",
        'price' => 580,
        'variants' => [
            [
                'variantId' => 24,
                'variantName' => "Argent",
                'variantColor' => "#C0C0C0",
                'quantity' => 11,
                'image' => '../assets/images/products/watch/elegance-sovereign/argent/main.png',
            ],
            [
                'variantId' => 25,
                'variantName' => "Rose Elegance",
                'variantColor' => "#B76E79",
                'quantity' => 0,
                'image' => '../assets/images/products/watch/elegance-sovereign/rose-elegance/main.png',
            ],
        ],
    ],
    [
        'id' => 8,
        'name' => "Urban Odyssey Tote Bag",
        'description' => "The Urban Odyssey Tote Bag is a stylish yet spacious accessory, perfect for carrying all essentials effortlessly.",
        'price' => 325,
        'variants' => [
            [
                'variantId' => 26,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/urban-odyssey-tote-bag/black/main.png',
            ],
            [
                'variantId' => 27,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/urban-odyssey-tote-bag/white/main.png',
            ],
        ],
    ],
    [
        'id' => 9,
        'name' => "Urban Odyssey Hobo Bag",
        'description' => "The Urban Odyssey Hobo Bag combines chic design with everyday functionality, making it a versatile addition to any outfit.",
        'price' => 285,
        'variants' => [
            [
                'variantId' => 28,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/urban-odyssey-hobo-bag/black/main.png',
            ],
            [
                'variantId' => 29,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/urban-odyssey-hobo-bag/white/main.png',
            ],
            [
                'variantId' => 30,
                'variantName' => "Forest Green",
                'variantColor' => "#2f6237",
                'quantity' => 13,
                'image' => '../assets/images/products/bag/urban-odyssey-hobo-bag/green/main.png',
            ],
            [
                'variantId' => 31,
                'variantName' => "Blush Pink",
                'variantColor' => "#B76E79",
                'quantity' => 14,
                'image' => '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/main.png',
            ],
        ],
    ],
    [
        'id' => 10,
        'name' => "Urban Odyssey Crossbody Bag",
        'description' => "Compact and convenient, the Urban Odyssey Crossbody Bag is ideal for on-the-go individuals who value both style and practicality.",
        'price' => 250,
        'variants' => [
            [
                'variantId' => 32,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/main.png',
            ],
            [
                'variantId' => 33,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/main.png',
            ],
            [
                'variantId' => 34,
                'variantName' => "Navy Blue",
                'variantColor' => "#004678",
                'quantity' => 10,
                'image' => '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/main.png',
            ],
            [
                'variantId' => 35,
                'variantName' => "Ruby Red",
                'variantColor' => "#973e3e",
                'quantity' => 0,
                'image' => '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/main.png',
            ],
        ],
    ],
    [
        'id' => 11,
        'name' => "Timeless Verve Shoulder Bag",
        'description' => "The Timeless Verve Shoulder Bag combines style and functionality, offering a versatile design that complements both casual and formal attire.",
        'price' => 295,
        'variants' => [
            [
                'variantId' => 36,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/timeless-verve-shoulder-bag/black/main.png',
            ],
            [
                'variantId' => 37,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/timeless-verve-shoulder-bag/white/main.png',
            ],
        ],
    ],
    [
        'id' => 12,
        'name' => "Timeless Verve Quilted Backpack",
        'description' => "The Timeless Verve Quilted Backpack combines elegance with practicality, offering ample space and a quilted design that stands out.",
        'price' => 345,
        'variants' => [
            [
                'variantId' => 38,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/black/main.png',
            ],
            [
                'variantId' => 39,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/white/main.png',
            ],
            [
                'variantId' => 40,
                'variantName' => "Vintage Brown",
                'variantColor' => "#5A4036",
                'quantity' => 13,
                'image' => '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/main.png',
            ],
        ],
    ],
    [
        'id' => 13,
        'name' => "Timeless Verve Pouch",
        'description' => "The Timeless Verve Pouch is a compact yet stylish accessory, ideal for keeping essentials within easy reach.",
        'price' => 175,
        'variants' => [
            [
                'variantId' => 41,
                'variantName' => "Classic Black",
                'variantColor' => "#000000",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/black/main.png',
            ],
            [
                'variantId' => 42,
                'variantName' => "Elegant White",
                'variantColor' => "#ece8e1",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/white/main.png',
            ],
            [
                'variantId' => 43,
                'variantName' => "Blueberry",
                'variantColor' => "#2063a4",
                'quantity' => 0,
                'image' => '../assets/images/products/bag/timeless-verve-pouch/blueberry/main.png',
            ],
        ],
    ],
    [
        'id' => 14,
        'name' => "Heritage Aura Shoulder Bag",
        'description' => "The Heritage Aura Shoulder Bag features timeless charm with its earthy tones and structured silhouette, perfect for any occasion.",
        'price' => 300,
        'variants' => [
            [
                'variantId' => 44,
                'variantName' => "Dark Stone",
                'variantColor' => "#836e64",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/main.png',
            ],
            [
                'variantId' => 45,
                'variantName' => "Light Brown",
                'variantColor' => "#d4b799",
                'quantity' => 0,
                'image' => '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/main.png',
            ],
            [
                'variantId' => 46,
                'variantName' => "Dark Brown",
                'variantColor' => "#5a4036",
                'quantity' => 13,
                'image' => '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/main.png',
            ],
        ],
    ],
    [
        'id' => 15,
        'name' => "Heritage Aura Graphic Crossbody Bag",
        'description' => "The Heritage Aura Graphic Crossbody Bag merges casual style with a graphic twist, making it a versatile and unique statement piece.",
        'price' => 200,
        'variants' => [
            [
                'variantId' => 47,
                'variantName' => "Army Green",
                'variantColor' => "#4a4532",
                'quantity' => 11,
                'image' => '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/main.png',
            ],
            [
                'variantId' => 48,
                'variantName' => "Grey Blue",
                'variantColor' => "#85878e",
                'quantity' => 12,
                'image' => '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/main.png',
            ],
            [
                'variantId' => 49,
                'variantName' => "Blueberry",
                'variantColor' => "#2063a4",
                'quantity' => 13,
                'image' => '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/main.png',
            ],
        ],
    ],
];


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
<body class="m-0">
    <?php
       navbar(true);
    ?>
    <main>
        <div id="overlay">
        </div>
        <div class="container pt-2">
            <h2 class="emphasized">Category</h2>
                <?php
                    filterAndSort(100,6000);
                ?>
        </div>
        <div id="product-container" class="container d-flex flex-wrap justify-start pb-2 ma">
            <?php
                all_product_cards(false, $allProductItems);
            ?>     
        </div>
    </main>
    <?php
        footer(true);
    ?>
    <script type="module" src="../assets/js/pages/product-listing.js"></script>
    <script>

        </script>
</body>
</html>

