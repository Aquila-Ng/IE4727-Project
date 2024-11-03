CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE variants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    color VARCHAR(7) NOT NULL, -- Assuming it's a hex color code
    quantity INT NOT NULL,
    image VARCHAR(255), -- Single image reference
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE variant_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    variant_id INT NOT NULL,
    image VARCHAR(255) NOT NULL,
    FOREIGN KEY (variant_id) REFERENCES variants(id)
);

INSERT INTO categories (name) VALUES ('Watches'), ('Bags');

INSERT INTO products (id, category_id, name, price, description) VALUES
(0, 'Legacy Lunar Heritage', 750, "Embrace the celestial beauty of the Legacy Lunar Majesty. This exquisite timepiece features a stunning moonphase complication, allowing you to track the moon\'s cycles as you navigate life\'s adventures. Its elegant design, complemented by refined details, makes it the perfect companion for those who appreciate the harmony of time and nature."),
(0, 'Legacy Noble Classic', 700, "The Legacy Noble Classic is a tribute to timeless elegance. With its clean lines and classic aesthetics, this watch seamlessly blends tradition and modernity. Whether dressed up for a formal occasion or enjoying a casual day out, this watch is a versatile staple that embodies sophistication and style."),
(0, 'Adventurer Explorer Time', 600, "Designed for those with a passion for exploration, the Adventurer Explorer\'s Time is a robust and reliable companion. Featuring a bold dial and durable materials, this watch is built to withstand the elements while providing precise timekeeping. Its adventurous spirit is perfect for anyone seeking to chart new paths and discover the world."),
(0, 'Adventurer Voyager Chrono', 675, "The Adventurer Voyager Chrono is engineered for the daring spirit. With its chronograph functionality and sporty design, this watch is perfect for those who embrace action and adventure. Whether timing your next challenge or enjoying a weekend getaway, this timepiece is as dynamic as your lifestyle."),
(0, 'Adventurer Chrono Celestial', 780, "Reach for the stars with the Adventurer Chrono Celestial. This exceptional watch combines a chronograph feature with a striking celestial design, making it ideal for dreamers and explorers alike. With its sturdy build and eye-catching aesthetics, it serves as a reminder to chase your aspirations and explore the unknown."),
(0, 'Elegance BellaVita', 520, "Experience the beauty of life with the Elegance BellaVita. This timepiece exudes grace and charm, featuring delicate details and a refined design. Ideal for the modern woman, it combines functionality with an effortlessly chic aesthetic, making it suitable for both day-to-night wear."),
(0, 'Elegance Virtuoso', 650, "The Elegance Virtuoso embodies the art of sophistication. This watch showcases meticulous craftsmanship and a harmonious design, perfect for the discerning individual. Its understated elegance makes it a timeless accessory that can elevate any outfit, whether at work or social events."),
(0, 'Elegance Sovereign', 580, "Command attention with the Elegance Sovereign. This luxurious timepiece reflects a perfect balance of strength and sophistication, making it suitable for both formal occasions and everyday wear. Its refined design and high-quality materials signify a legacy of excellence, positioning it as a must-have for the modern connoisseur."),
(1, 'Urban Odyssey Tote Bag', 325, "Built for the adventurer at heart, the Urban Odyssey Tote offers ample space and durability for your essentials. Crafted with sturdy materials and featuring structured handles, this tote is ideal for those who juggle daily life with style and practicality."),
(1, 'Urban Odyssey Hobo Bag', 285, "The Urban Odyssey Hobo is a versatile piece that transitions seamlessly from work to weekend. With its spacious main compartment and relaxed silhouette, it combines effortless elegance with functional design, perfect for city dwellers on the go."),
(1, 'Urban Odyssey Crossbody Bag', 250, "Designed to keep pace with your day, the Urban Odyssey Crossbody offers compact style with a smart organizational layout. Equipped with multiple compartments and a sleek, adjustable strap, this bag is a lightweight, hands-free solution for urban explorers."),
(1, 'Timeless Verve Shoulder Bag', 295, "The Timeless Verve Shoulder Bag radiates elegance with its classic shape and subtle design details. This bag offers a spacious interior and a refined silhouette, perfect for adding a touch of sophistication to both casual and formal attire."),
(1, 'Timeless Verve Quilted Backpack', 345, "The Timeless Verve Quilted Backpack is all about luxury and texture. With its delicate quilting and plush feel, this bag adds a modern twist to a vintage-inspired look. Its compact form makes it the ideal accessory for evening outings or special occasions."),
(1, 'Timeless Verve Pouch', 175, "Small yet statement-worthy, the Timeless Verve Pouch brings a touch of softness and elegance to your accessory lineup. Featuring pillow-like quilting, this pouch is crafted for minimal essentials and can easily fit into a larger bag or be carried solo."),
(1, 'Heritage Aura Shoulder Bag', 300, "The Heritage Aura Shoulder combines timeless style with practicality. With a roomy interior and sturdy design, this tote is perfect for carrying everything you need throughout the day. Its classic lines and high-quality finish make it a staple for those who value both form and function."),
(1, 'Heritage Aura Graphic Crossbody Bag', 200, "The Heritage Aura Graphic Crossbody stands out with its bold, signature graphic details. It’s a versatile piece that lets you make a stylish statement while keeping your essentials close. The bag’s compact size and adjustable strap make it ideal for those who appreciate fashion and functionality.");


INSERT INTO variants (id, product_id, name, color, quantity, image) VALUES
(0, 0, 'Classic Elegance', '#dcd7d1', 15, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/main.png'),
(1, 0, 'Timeless White', '#e0e0e0', 25, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/main.png'),
(2, 0, 'Midnight Blue', '#004678', 0, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png'),  -- Quantity 0
(3, 0, 'Emerald Green', '#025a38', 10, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/main.png'),
(4, 0, 'Sleek Anthracite', '#9c9e9d', 0, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/main.png'),  -- Quantity 0
(5, 0, 'Bronze Charm', '#d9ad7c', 20, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/main.png'),
(6, 1, 'Classic Black', '#322f2e', 30, '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png'),
(7, 1, 'Elegant Charm', '#ece8e1', 0, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png'),  -- Quantity 0
(8, 2, 'Mahogany Black', '#C0C0C0', 40, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/main.png'),
(9, 2, 'Midnight Blue', '#1F3A93', 50, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/main.png'),
(10, 2, 'Ebony Classic', '#6D4C41', 0, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/main.png'),  -- Quantity 0
(11, 3, 'Eclipse', '#0A0A0A', 5, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/main.png'),
(12, 3, 'Solstice', '#1B3A5F', 60, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/main.png'),
(13, 3, 'Halo', '#C0C0C0', 0, '../assets/images/products/watch/adventurer-voyager-chrono/halo/main.png'),  -- Quantity 0
(14, 4, 'Galaxy Blue', '#0D1B42', 12, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/main.png'),
(15, 4, 'Celeste', '#FAF9F6', 18, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/main.png'),
(16, 4, 'Midnight Black', '#1A1A1A', 0, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/main.png'),  -- Quantity 0
(17, 5, 'Vintage', '#d5d3cf', 22, '../assets/images/products/watch/elegance-bellavita/vintage/main.png'),
(18, 5, 'Classic Brown', '#3a3a3a', 0, '../assets/images/products/watch/elegance-bellavita/classic-brown/main.png'),  -- Quantity 0
(19, 5, 'Emerald Green', '#2f6237', 45, '../assets/images/products/watch/elegance-bellavita/emerald-green/main.png'),
(20, 6, 'Argent', '#C0C0C0', 35, '../assets/images/products/watch/elegance-virtuoso/argent/main.png'),
(21, 6, 'Noir', '#1C1C1C', 0, '../assets/images/products/watch/elegance-virtuoso/noir/main.png'),  -- Quantity 0
(22, 6, 'Perle', '#ece8e1', 27, '../assets/images/products/watch/elegance-virtuoso/perle/main.png'),
(23, 6, 'Celeste', '#0D1B42', 55, '../assets/images/products/watch/elegance-virtuoso/celeste/main.png'),
(24, 7, 'Argent', '#C0C0C0', 29, '../assets/images/products/watch/elegance-sovereign/argent/main.png'),
(25, 7, 'Rose Elegance', '#b6967b', 0, '../assets/images/products/watch/elegance-sovereign/rose-elegance/main.png'),  -- Quantity 0
(26, 8, 'Black', '#000000', 0, '../assets/images/products/bag/urban-odyssey-tote-bag/black/main.png'),  -- Quantity 0
(27, 8, 'White', '#ece8e1', 10, '../assets/images/products/bag/urban-odyssey-tote-bag/white/main.png'),
(28, 9, 'Black', '#000000', 20, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/main.png'),
(29, 9, 'White', '#ece8e1', 30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/main.png'),
(30, 9, 'Green', '#2f6237', 0, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/main.png'),  -- Quantity 0
(31, 9, 'Pink', '#b6967b', 0, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/main.png'),  -- Quantity 0
(32, 10, 'Black', '#000000', 40, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/main.png'),
(33, 10, 'White', '#ece8e1', 50, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/main.png'),
(34, 10, 'Navy', '#004678', 0, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/main.png'),  -- Quantity 0
(35, 10, 'Ruby', '#973e3e', 0, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/main.png'),  -- Quantity 0
(36, 11, 'Black', '#000000', 15, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/main.png'),
(37, 11, 'White', '#ece8e1', 0, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/main.png'),  -- Quantity 0
(38, 12, 'Black', '#000000', 0, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/main.png'),  -- Quantity 0
(39, 12, 'White', '#ece8e1', 10, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/main.png'),
(40, 12, 'Brown', '#5a4036', 25, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/main.png'),
(41, 13, 'Black', '#000000', 30, '../assets/images/products/bag/timeless-verve-pouch/black/main.png'),
(42, 13, 'White', '#ece8e1', 0, '../assets/images/products/bag/timeless-verve-pouch/white/main.png'),  -- Quantity 0
(43, 13, 'Blueberry', '#2063a4', 20, '../assets/images/products/bag/timeless-verve-pouch/blueberry/main.png'),
(44, 14, 'Dark Stone', '#836e64', 0, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/main.png'),  -- Quantity 0
(45, 14, 'Light Brown', '#d4b799', 18, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/main.png'),
(46, 14, 'Dark Brown', '#5a4036', 25, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/main.png'),
(47, 15, 'Army Green', '#4a4532', 32, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/main.png'),
(48, 15, 'Grey Blue', '#85878e', 0, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/main.png'),  -- Quantity 0
(49, 15, 'Navy Blue', '#004678', 20, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/navy-blue/main.png');


