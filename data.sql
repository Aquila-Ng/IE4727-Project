CREATE DATABASE sereneDB;
USE sereneDB;

CREATE TABLE `users` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `password` varchar(300) NOT NULL,
  `phone_number` varchar(20),
  `address` varchar(400),
  `country` varchar(100),
  `postal_code` varchar(50),
  `role` varchar(255) NOT NULL
);

CREATE TABLE `orders` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `user_id` integer NOT NULL,
  `status` integer NOT NULL,
  `total_amount` varchar(60) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `date_time` datetime
);

CREATE TABLE `products` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` integer NOT NULL
);

CREATE TABLE `categories` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(200) NOT NULL
);

CREATE TABLE `order_items` (
  `id` integer PRIMARY KEY,
  `order_id` integer,
  `variant_id` integer,
  `quantity` integer,
  `price` decimal(10,2)
);

CREATE TABLE `shopping_cart` (
  `id` integer PRIMARY KEY,
  `user_id` integer
);

CREATE TABLE `cart_items` (
  `id` integer PRIMARY KEY,
  `cart_id` integer,
  `variant_id` integer,
  `quantity` integer,
  `price` decimal (10,2)
);

CREATE TABLE `variants` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `product_id` integer NOT NULL,
  `color` varchar(50) NOT NULL,
  `quantity` integer NOT NULL,
  `image` varchar(300),
  `name` varchar(255) NOT NULL 
);

CREATE TABLE `variant_images` (     
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `variant_id` integer NOT NULL,     
  `image` varchar(255) NOT NULL
);

-- Corrected foreign key constraints
ALTER TABLE `orders` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `products` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
ALTER TABLE `order_items` ADD FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
ALTER TABLE `order_items` ADD FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);
ALTER TABLE `shopping_cart` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
ALTER TABLE `cart_items` ADD FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`id`);
ALTER TABLE `cart_items` ADD FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);
ALTER TABLE `variants` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
ALTER TABLE `variant_images` ADD FOREIGN KEY (`variant_id`) REFERENCES `variants` (`id`);

-- Populate orders table with sample orders
INSERT INTO orders (id, user_id, status, total_amount, shipping_address, country, postal_code, date_time) VALUES
(1, 1, 4, '1425.00', '123 Main St, Apt 4B', 'USA', '10001', '2024-11-04 19:42:08'),
(2, 2, 2, '875.00', '456 Elm St, Suite 300', 'Canada', 'M5V 2T6', '2024-11-04 19:42:08'),
(3, 3, 5, '1350.00', '789 Oak Rd, Floor 2', 'UK', 'SW1A 1AA', '2024-11-04 19:42:08'),
(4, 1, 4, '925.00', '321 Pine Ave, Unit 5', 'USA', '94107', '2024-11-04 19:42:08'),
(5, 4, 2, '600.00', '654 Maple Dr, Room 12', 'Australia', '3000', '2024-11-04 19:42:08');

INSERT INTO categories (id, name) VALUES 
(1, 'Watches'), 
(2, 'Bags');

INSERT INTO products (id, category_id, name, price, description) VALUES
(1, 1, 'Legacy Lunar Heritage', 750, "Embrace the celestial beauty of the Legacy Lunar Majesty. This exquisite timepiece features a stunning moonphase complication, allowing you to track the moon\'s cycles as you navigate life\'s adventures. Its elegant design, complemented by refined details, makes it the perfect companion for those who appreciate the harmony of time and nature."),
(2, 1, 'Legacy Noble Classic', 700, "The Legacy Noble Classic is a tribute to timeless elegance. With its clean lines and classic aesthetics, this watch seamlessly blends tradition and modernity. Whether dressed up for a formal occasion or enjoying a casual day out, this watch is a versatile staple that embodies sophistication and style."),
(3, 1, 'Adventurer Explorer Time', 600, "Designed for those with a passion for exploration, the Adventurer Explorer\'s Time is a robust and reliable companion. Featuring a bold dial and durable materials, this watch is built to withstand the elements while providing precise timekeeping. Its adventurous spirit is perfect for anyone seeking to chart new paths and discover the world."),
(4, 1, 'Adventurer Voyager Chrono', 675, "The Adventurer Voyager Chrono is engineered for the daring spirit. With its chronograph functionality and sporty design, this watch is perfect for those who embrace action and adventure. Whether timing your next challenge or enjoying a weekend getaway, this timepiece is as dynamic as your lifestyle."),
(5, 1, 'Adventurer Chrono Celestial', 780, "Reach for the stars with the Adventurer Chrono Celestial. This exceptional watch combines a chronograph feature with a striking celestial design, making it ideal for dreamers and explorers alike. With its sturdy build and eye-catching aesthetics, it serves as a reminder to chase your aspirations and explore the unknown."),
(6, 1, 'Elegance BellaVita', 520, "Experience the beauty of life with the Elegance BellaVita. This timepiece exudes grace and charm, featuring delicate details and a refined design. Ideal for the modern woman, it combines functionality with an effortlessly chic aesthetic, making it suitable for both day-to-night wear."),
(7, 1, 'Elegance Virtuoso', 650, "The Elegance Virtuoso embodies the art of sophistication. This watch showcases meticulous craftsmanship and a harmonious design, perfect for the discerning individual. Its understated elegance makes it a timeless accessory that can elevate any outfit, whether at work or social events."),
(8, 1, 'Elegance Sovereign', 580, "Command attention with the Elegance Sovereign. This luxurious timepiece reflects a perfect balance of strength and sophistication, making it suitable for both formal occasions and everyday wear. Its refined design and high-quality materials signify a legacy of excellence, positioning it as a must-have for the modern connoisseur."),
(9, 2, 'Urban Odyssey Tote Bag', 325, "Built for the adventurer at heart, the Urban Odyssey Tote offers ample space and durability for your essentials. Crafted with sturdy materials and featuring structured handles, this tote is ideal for those who juggle daily life with style and practicality."),
(10, 2, 'Urban Odyssey Hobo Bag', 285, "The Urban Odyssey Hobo is a versatile piece that transitions seamlessly from work to weekend. With its spacious main compartment and relaxed silhouette, it combines effortless elegance with functional design, perfect for city dwellers on the go."),
(11, 2, 'Urban Odyssey Crossbody Bag', 250, "Designed to keep pace with your day, the Urban Odyssey Crossbody offers compact style with a smart organizational layout. Equipped with multiple compartments and a sleek, adjustable strap, this bag is a lightweight, hands-free solution for urban explorers."),
(12, 2, 'Timeless Verve Shoulder Bag', 295, "The Timeless Verve Shoulder Bag radiates elegance with its classic shape and subtle design details. This bag offers a spacious interior and a refined silhouette, perfect for adding a touch of sophistication to both casual and formal attire."),
(13, 2, 'Timeless Verve Quilted Backpack', 345, "The Timeless Verve Quilted Backpack is all about luxury and texture. With its delicate quilting and plush feel, this bag adds a modern twist to a vintage-inspired look. Its compact form makes it the ideal accessory for evening outings or special occasions."),
(14, 2, 'Timeless Verve Pouch', 175, "Small yet statement-worthy, the Timeless Verve Pouch brings a touch of softness and elegance to your accessory lineup. Featuring pillow-like quilting, this pouch is crafted for minimal essentials and can easily fit into a larger bag or be carried solo."),
(15, 2, 'Heritage Aura Shoulder Bag', 300, "The Heritage Aura Shoulder combines timeless style with practicality. With a roomy interior and sturdy design, this tote is perfect for carrying everything you need throughout the day. Its classic lines and high-quality finish make it a staple for those who value both form and function."),
(16, 2, 'Heritage Aura Graphic Crossbody Bag', 200, "The Heritage Aura Graphic Crossbody stands out with its bold, signature graphic details. It’s a versatile piece that lets you make a stylish statement while keeping your essentials close. The bag’s compact size and adjustable strap make it ideal for those who appreciate fashion and functionality.");

INSERT INTO variants (id, product_id, name, color, quantity, image) VALUES
(1, 1, 'Classic Elegance', '#dcd7d1', 15, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/main.png'),
(2, 1, 'Timeless White', '#e0e0e0', 25, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/main.png'),
(3, 1, 'Midnight Blue', '#004678', 0, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png'),  -- Quantity 0
(4, 1, 'Emerald Green', '#025a38', 10, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/main.png'),
(5, 1, 'Sleek Anthracite', '#9c9e9d', 0, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/main.png'),  -- Quantity 0
(6, 1, 'Bronze Charm', '#d9ad7c', 20, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/main.png'),
(7, 2, 'Classic Black', '#322f2e', 30, '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png'),
(8, 2, 'Elegant Charm', '#ece8e1', 0, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png'),  -- Quantity 0
(9, 3, 'Mahogany Black', '#C0C0C0', 40, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/main.png'),
(10, 3, 'Midnight Blue', '#1F3A93', 50, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/main.png'),
(11, 3, 'Ebony Classic', '#6D4C41', 0, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/main.png'),  -- Quantity 0
(12, 4, 'Eclipse', '#0A0A0A', 5, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/main.png'),
(13, 4, 'Solstice', '#1B3A5F', 60, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/main.png'),
(14, 4, 'Halo', '#C0C0C0', 0, '../assets/images/products/watch/adventurer-voyager-chrono/halo/main.png'),  -- Quantity 0
(15, 5, 'Galaxy Blue', '#0D1B42', 12, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/main.png'),
(16, 5, 'Celeste', '#FAF9F6', 18, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/main.png'),
(17, 5, 'Midnight Black', '#1A1A1A', 0, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/main.png'),  -- Quantity 0
(18, 6, 'Vintage', '#d5d3cf', 22, '../assets/images/products/watch/elegance-bellavita/vintage/main.png'),
(19, 6, 'Classic Brown', '#3a3a3a', 0, '../assets/images/products/watch/elegance-bellavita/classic-brown/main.png'),  -- Quantity 0
(20, 6, 'Emerald Green', '#2f6237', 45, '../assets/images/products/watch/elegance-bellavita/emerald-green/main.png'),
(21, 7, 'Argent', '#C0C0C0', 35, '../assets/images/products/watch/elegance-virtuoso/argent/main.png'),
(22, 7, 'Noir', '#1C1C1C', 0, '../assets/images/products/watch/elegance-virtuoso/noir/main.png'),  -- Quantity 0
(23, 7, 'Perle', '#ece8e1', 27, '../assets/images/products/watch/elegance-virtuoso/perle/main.png'),
(24, 7, 'Celeste', '#0D1B42', 55, '../assets/images/products/watch/elegance-virtuoso/celeste/main.png'),
(25, 8, 'Argent', '#C0C0C0', 29, '../assets/images/products/watch/elegance-sovereign/argent/main.png'),
(26, 8, 'Rose Elegance', '#b6967b', 0, '../assets/images/products/watch/elegance-sovereign/rose-elegance/main.png'),  -- Quantity 0
(27, 9, 'Black', '#000000', 0, '../assets/images/products/bag/urban-odyssey-tote-bag/black/main.png'),  -- Quantity 0
(28, 9, 'White', '#ece8e1', 10, '../assets/images/products/bag/urban-odyssey-tote-bag/white/main.png'),
(29, 10, 'Black', '#000000', 20, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/main.png'),
(30, 10, 'White', '#ece8e1', 30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/main.png'),
(31, 10, 'Green', '#2f6237', 0, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/main.png'),  -- Quantity 0
(32, 10, 'Pink', '#b6967b', 0, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/main.png'),  -- Quantity 0
(33, 11, 'Black', '#000000', 40, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/main.png'),
(34, 11, 'White', '#ece8e1', 50, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/main.png'),
(35, 11, 'Navy', '#004678', 0, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/main.png'),  -- Quantity 0
(36, 11, 'Ruby', '#973e3e', 0, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/main.png'),  -- Quantity 0
(37, 12, 'Black', '#000000', 15, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/main.png'),
(38, 12, 'White', '#ece8e1', 0, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/main.png'),  -- Quantity 0
(39, 13, 'Black', '#000000', 0, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/main.png'),  -- Quantity 0
(40, 13, 'White', '#ece8e1', 10, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/main.png'),
(41, 13, 'Brown', '#5a4036', 25, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/main.png'),
(42, 14, 'Black', '#000000', 30, '../assets/images/products/bag/timeless-verve-pouch/black/main.png'),
(43, 14, 'White', '#ece8e1', 0, '../assets/images/products/bag/timeless-verve-pouch/white/main.png'),  -- Quantity 0
(44, 14, 'Blueberry', '#2063a4', 20, '../assets/images/products/bag/timeless-verve-pouch/blueberry/main.png'),
(45, 15, 'Dark Stone', '#836e64', 0, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/main.png'),  -- Quantity 0
(46, 15, 'Light Brown', '#d4b799', 18, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/main.png'),
(47, 15, 'Dark Brown', '#5a4036', 25, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/main.png'),
(48, 16, 'Army Green', '#4a4532', 32, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/main.png'),
(49, 16, 'Grey Blue', '#85878e', 0, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/main.png'),  -- Quantity 0
(50, 16, 'Blueberry', '#2063a4', 20, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/main.png');

-- Populate order_items table with items for each order
INSERT INTO order_items (id, order_id, variant_id, quantity, price) VALUES
-- Order 1 items (John Doe's first order)
(1, 1, 1, 1, '750.00'),  -- Legacy Lunar Heritage - Classic Elegance
(2, 1, 42, 1, '175.00'), -- Timeless Verve Pouch - Black
(3, 1, 28, 1, '325.00'), -- Urban Odyssey Tote Bag - White

-- Order 2 items (Jane Smith's order)
(4, 2, 7, 1, '700.00'),  -- Legacy Noble Classic - Classic Black
(5, 2, 44, 1, '175.00'), -- Timeless Verve Pouch - Blueberry

-- Order 3 items (Mike Johnson's order)
(6, 3, 15, 1, '780.00'), -- Adventurer Chrono Celestial - Galaxy Blue
(7, 3, 37, 1, '295.00'), -- Timeless Verve Shoulder Bag - Black
(8, 3, 41, 1, '275.00'), -- Timeless Verve Quilted Backpack - Brown

-- Order 4 items (John Doe's second order)
(9, 4, 21, 1, '650.00'), -- Elegance Virtuoso - Argent
(10, 4, 33, 1, '275.00'), -- Urban Odyssey Crossbody Bag - Black

-- Order 5 items (Sarah Williams' order)
(11, 5, 9, 1, '600.00'); -- Adventurer Explorer Time - Mahogany Black

-- Populate shopping_cart table with active carts
INSERT INTO shopping_cart (id, user_id) VALUES
(1, 1), -- John Doe's cart
(2, 2), -- Jane Smith's cart
(3, 4); -- Sarah Williams' cart

INSERT INTO cart_items (id, cart_id, variant_id, quantity, price) VALUES
-- John Doe's cart items
(1, 1, 16, 1, '780.00'), -- Adventurer Chrono Celestial - Celeste
(2, 1, 46, 1, '300.00'), -- Heritage Aura Shoulder Bag - Light Brown

-- Jane Smith's cart items
(3, 2, 24, 1, '650.00'), -- Elegance Virtuoso - Celeste
(4, 2, 48, 1, '200.00'), -- Heritage Aura Graphic Crossbody Bag - Army Green

-- Sarah Williams' cart items
(5, 3, 20, 1, '520.00'), -- Elegance BellaVita - Emerald Green
(6, 3, 34, 1, '250.00'); -- Urban Odyssey Crossbody Bag - White

INSERT INTO variant_images (variant_id, image) VALUES
-- Variant 1: Classic Elegance - Legacy Lunar Heritage
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/main.png'),
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/front.png'),
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/back.png'),
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/front-face.png'),
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/back-face.png'),
(1, '../assets/images/products/watch/legacy-lunar-heritage/classic-elegance/strap.png'),

-- Variant 2: Timeless White - Legacy Lunar Heritage
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/main.png'),
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/front.png'),
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/back.png'),
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/portrait.png'),
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/front-face.png'),
(2, '../assets/images/products/watch/legacy-lunar-heritage/timeless-white/strap.png'),

-- Variant 3: Midnight Blue - Legacy Lunar Heritage
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/main.png'),
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/front.png'),
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/back.png'),
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/portrait.png'),
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/front-face.png'),
(3, '../assets/images/products/watch/legacy-lunar-heritage/midnight-blue/strap.png'),

-- Variant 4: Emerald Green - Legacy Lunar Heritage
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/main.png'),
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/front.png'),
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/back.png'),
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/front-face.png'),
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/back-face.png'),
(4, '../assets/images/products/watch/legacy-lunar-heritage/emerald-green/strap.png'),

-- Variant 5: Sleek Anthracite - Legacy Lunar Heritage
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/main.png'),
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/front.png'),
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/back.png'),
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/front-face.png'),
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/back-face.png'),
(5, '../assets/images/products/watch/legacy-lunar-heritage/sleek-anthracite/strap.png'),

-- Variant 6: Bronze Charm - Legacy Lunar Heritage
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/main.png'),
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/front.png'),
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/back.png'),
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/front-face.png'),
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/back-face.png'),
(6, '../assets/images/products/watch/legacy-lunar-heritage/bronze-charm/strap.png'),

-- Variant 7: Classic Black - Legacy Noble Classic
(7, '../assets/images/products/watch/legacy-noble-classic/classic-black/main.png'),
(7, '../assets/images/products/watch/legacy-noble-classic/classic-black/front.png'),
(7, '../assets/images/products/watch/legacy-noble-classic/classic-black/back.png'),
(7, '../assets/images/products/watch/legacy-noble-classic/classic-black/portrait.png'),
(7, '../assets/images/products/watch/legacy-noble-classic/classic-black/front-face.png'),

-- Variant 8: Elegant Charm - Legacy Noble Classic
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/main.png'),
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/front.png'),
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/back.png'),
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/portrait.png'),
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/front-face.png'),
(8, '../assets/images/products/watch/legacy-noble-classic/elegant-charm/back-face.png'),

-- Variant 9: Mahogony Black - Adventurer Explorer Time
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/main.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/front.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/back.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/portrait.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/front-face.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/back-face.png'),
(9, '../assets/images/products/watch/adventurer-explorer-time/mahogony-black/strap.png'),

-- Variant 10: Midnight Blue - Adventurer Explorer Time
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/main.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/front.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/back.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/portrait.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/front-face.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/back-face.png'),
(10, '../assets/images/products/watch/adventurer-explorer-time/midnight-blue/strap.png'),

-- Variant 11: Ebony Classic - Adventurer Explorer Time
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/main.png'),
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/front.png'),
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/back.png'),
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/portrait.png'),
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/front-face.png'),
(11, '../assets/images/products/watch/adventurer-explorer-time/ebony-classic/back-face.png'),

-- Variant 12: Eclipse - Adventurer Voyager Chrono
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/main.png'),
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/front.png'),
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/back.png'),
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/portrait.png'),
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/front-face.png'),
(12, '../assets/images/products/watch/adventurer-voyager-chrono/eclipse/back-face.png'),

-- Variant 13: Solistice - Adventurer Voyager Chrono
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/main.png'),
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/front.png'),
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/back.png'),
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/portrait.png'),
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/front-face.png'),
(13, '../assets/images/products/watch/adventurer-voyager-chrono/solistice/back-face.png'),

-- Variant 14: Halo - Adventurer Voyager Chrono
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/main.png'),
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/front.png'),
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/back.png'),
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/portrait.png'),
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/front-face.png'),
(14, '../assets/images/products/watch/adventurer-voyager-chrono/halo/back-face.png'),

-- Variant 15: Galaxy Blue - Adventurer Chrono Celestial
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/main.png'),
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/front.png'),
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/back.png'),
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/portrait.png'),
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/front-face.png'),
(15, '../assets/images/products/watch/adventurer-chrono-celestial/galaxy-blue/strap.png'),

-- Variant 16: Celeste - Adventurer Chrono Celestial
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/main.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/front.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/back.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/portrait.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/front-face.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/back-face.png'),
(16, '../assets/images/products/watch/adventurer-chrono-celestial/celeste/strap.png'),

-- Variant 17: Midnight Black - Adventurer Chrono Celestial
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/main.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/front.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/back.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/portrait.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/front-face.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/back-face.png'),
(17, '../assets/images/products/watch/adventurer-chrono-celestial/midnight-black/strap.png'),

-- Variant 18: Vintage - Elegance BellaVita
(18, '../assets/images/products/watch/elegance-bellavita/vintage/main.png'),
(18, '../assets/images/products/watch/elegance-bellavita/vintage/front.png'),
(18, '../assets/images/products/watch/elegance-bellavita/vintage/portrait.png'),
(18, '../assets/images/products/watch/elegance-bellavita/vintage/front-face.png'),
(18, '../assets/images/products/watch/elegance-bellavita/vintage/back-face.png'),
(18, '../assets/images/products/watch/elegance-bellavita/vintage/strap.png'),

-- Variant 19: Classic Brown - Elegance BellaVita
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/main.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/front.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/back.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/portrait.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/front-face.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/back-face.png'),
(19, '../assets/images/products/watch/elegance-bellavita/classic-brown/strap.png'),

-- Variant 20: Emerald Green - Elegance BellaVita
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/main.png'),
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/front.png'),
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/back.png'),
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/front-face.png'),
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/back-face.png'),
(20, '../assets/images/products/watch/elegance-bellavita/emerald-green/strap.png'),

-- Variant 21: Argent - Elegance Virtuoso
(21, '../assets/images/products/watch/elegance-virtuoso/argent/main.png'),
(21, '../assets/images/products/watch/elegance-virtuoso/argent/front.png'),
(21, '../assets/images/products/watch/elegance-virtuoso/argent/back.png'),
(21, '../assets/images/products/watch/elegance-virtuoso/argent/portrait.png'),
(21, '../assets/images/products/watch/elegance-virtuoso/argent/front-face.png'),
(21, '../assets/images/products/watch/elegance-virtuoso/argent/strap.png'),

-- Variant 22: Noir - Elegance Virtuoso
(22, '../assets/images/products/watch/elegance-virtuoso/noir/main.png'),
(22, '../assets/images/products/watch/elegance-virtuoso/noir/front.png'),
(22, '../assets/images/products/watch/elegance-virtuoso/noir/back.png'),
(22, '../assets/images/products/watch/elegance-virtuoso/noir/portrait.png'),
(22, '../assets/images/products/watch/elegance-virtuoso/noir/front-face.png'),
(22, '../assets/images/products/watch/elegance-virtuoso/noir/strap.png'),

-- Variant 23: Perle - Elegance Virtuoso
(23, '../assets/images/products/watch/elegance-virtuoso/perle/main.png'),
(23, '../assets/images/products/watch/elegance-virtuoso/perle/front.png'),
(23, '../assets/images/products/watch/elegance-virtuoso/perle/back.png'),
(23, '../assets/images/products/watch/elegance-virtuoso/perle/portrait.png'),
(23, '../assets/images/products/watch/elegance-virtuoso/perle/front-face.png'),
(23, '../assets/images/products/watch/elegance-virtuoso/perle/strap.png'),

-- Variant 24: Celeste - Elegance Virtuoso
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/main.png'),
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/front.png'),
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/back.png'),
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/portrait.png'),
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/front-face.png'),
(24, '../assets/images/products/watch/elegance-virtuoso/celeste/strap.png'),

-- Variant 25: Argent - Elegance Sovereign
(25, '../assets/images/products/watch/elegance-sovereign/argent/main.png'),
(25, '../assets/images/products/watch/elegance-sovereign/argent/front.png'),
(25, '../assets/images/products/watch/elegance-sovereign/argent/back.png'),
(25, '../assets/images/products/watch/elegance-sovereign/argent/portrait.png'),
(25, '../assets/images/products/watch/elegance-sovereign/argent/front-face.png'),
(25, '../assets/images/products/watch/elegance-sovereign/argent/back-face.png'),

-- Variant 26: Rose Elegance - Elegance Sovereign
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/main.png'),
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/front.png'),
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/back.png'),
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/portrait.png'),
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/front-face.png'),
(26, '../assets/images/products/watch/elegance-sovereign/rose-elegance/back-face.png'),

-- Urban Odyssey Tote Bag - Black
(27, '../assets/images/products/bag/urban-odyssey-tote-bag/black/main.png'),
(27, '../assets/images/products/bag/urban-odyssey-tote-bag/black/side.png'),
(27, '../assets/images/products/bag/urban-odyssey-tote-bag/black/top.png'),
(27, '../assets/images/products/bag/urban-odyssey-tote-bag/black/portrait.png'),

-- Urban Odyssey Tote Bag - White
(28, '../assets/images/products/bag/urban-odyssey-tote-bag/white/main.png'),
(28, '../assets/images/products/bag/urban-odyssey-tote-bag/white/side.png'),
(28, '../assets/images/products/bag/urban-odyssey-tote-bag/white/top.png'),
(28, '../assets/images/products/bag/urban-odyssey-tote-bag/white/portrait.png'),

-- Urban Odyssey Hobo Bag - Black
(29, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/main.png'),
(29, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/side.png'),
(29, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/top.png'),
(29, '../assets/images/products/bag/urban-odyssey-hobo-bag/black/portrait.png'),

-- Urban Odyssey Hobo Bag - White
(30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/main.png'),
(30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/side.png'),
(30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/top.png'),
(30, '../assets/images/products/bag/urban-odyssey-hobo-bag/white/portrait.png'),

-- Urban Odyssey Hobo Bag - Green
(31, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/main.png'),
(31, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/side.png'),
(31, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/top.png'),
(31, '../assets/images/products/bag/urban-odyssey-hobo-bag/green/portrait.png'),

-- Urban Odyssey Hobo Bag - Pink
(32, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/main.png'),
(32, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/side.png'),
(32, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/top.png'),
(32, '../assets/images/products/bag/urban-odyssey-hobo-bag/pink/portrait.png'),

-- Urban Odyssey Crossbody Bag - Black
(33, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/main.png'),
(33, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/side.png'),
(33, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/top.png'),
(33, '../assets/images/products/bag/urban-odyssey-crossbody-bag/black/portrait.png'),

-- Urban Odyssey Crossbody Bag - White
(34, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/main.png'),
(34, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/side.png'),
(34, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/top.png'),
(34, '../assets/images/products/bag/urban-odyssey-crossbody-bag/white/portrait.png'),

-- Urban Odyssey Crossbody Bag - Navy
(35, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/main.png'),
(35, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/side.png'),
(35, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/top.png'),
(35, '../assets/images/products/bag/urban-odyssey-crossbody-bag/navy/portrait.png'),

-- Urban Odyssey Crossbody Bag - Ruby
(36, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/main.png'),
(36, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/side.png'),
(36, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/top.png'),
(36, '../assets/images/products/bag/urban-odyssey-crossbody-bag/ruby/portrait.png'),

-- Timeless Verve Shoulder Bag - Black
(37, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/main.png'),
(37, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/side.png'),
(37, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/top.png'),
(37, '../assets/images/products/bag/timeless-verve-shoulder-bag/black/portrait.png'),

-- Timeless Verve Shoulder Bag - White
(38, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/main.png'),
(38, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/side.png'),
(38, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/top.png'),
(38, '../assets/images/products/bag/timeless-verve-shoulder-bag/white/portrait.png'),

-- Timeless Verve Quilted Backpack - Black
(39, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/main.png'),
(39, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/side.png'),
(39, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/top.png'),
(39, '../assets/images/products/bag/timeless-verve-quilted-backpack/black/portrait.png'),

-- Timeless Verve Quilted Backpack - White
(40, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/main.png'),
(40, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/side.png'),
(40, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/top.png'),
(40, '../assets/images/products/bag/timeless-verve-quilted-backpack/white/portrait.png'),

-- Timeless Verve Quilted Backpack - Brown
(41, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/main.png'),
(41, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/side.png'),
(41, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/top.png'),
(41, '../assets/images/products/bag/timeless-verve-quilted-backpack/brown/back.png'),

-- Timeless Verve Pouch - Black
(42, '../assets/images/products/bag/timeless-verve-pouch/black/main.png'),
(42, '../assets/images/products/bag/timeless-verve-pouch/black/side.png'),
(42, '../assets/images/products/bag/timeless-verve-pouch/black/top.png'),
(42, '../assets/images/products/bag/timeless-verve-pouch/black/portrait.png'),

-- Timeless Verve Pouch - White
(43, '../assets/images/products/bag/timeless-verve-pouch/white/main.png'),
(43, '../assets/images/products/bag/timeless-verve-pouch/white/side.png'),
(43, '../assets/images/products/bag/timeless-verve-pouch/white/top.png'),
(43, '../assets/images/products/bag/timeless-verve-pouch/white/portrait.png'),

-- Timeless Verve Pouch - Blueberry
(44, '../assets/images/products/bag/timeless-verve-pouch/blueberry/main.png'),
(44, '../assets/images/products/bag/timeless-verve-pouch/blueberry/side.png'),
(44, '../assets/images/products/bag/timeless-verve-pouch/blueberry/top.png'),
(44, '../assets/images/products/bag/timeless-verve-pouch/blueberry/portrait.png'),


-- Heritage Aura Shoulder Bag - Dark Stone
(45, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/main.png'),
(45, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/side.png'),
(45, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/top.png'),
(45, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-stone/portrait.png'),

-- Heritage Aura Shoulder Bag - Light Brown
(46, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/main.png'),
(46, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/side.png'),
(46, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/top.png'),
(46, '../assets/images/products/bag/heritage-aura-shoulder-bag/light-brown/portrait.png'),

-- Heritage Aura Shoulder Bag - Dark Brown
(47, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/main.png'),
(47, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/side.png'),
(47, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/top.png'),
(47, '../assets/images/products/bag/heritage-aura-shoulder-bag/dark-brown/portrait.png'),

-- Heritage Aura Graphic Crossbody Bag - Army Green
(48, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/main.png'),
(48, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/side.png'),
(48, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/top.png'),
(48, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/army-green/portrait.png'),

-- Heritage Aura Graphic Crossbody Bag - Grey Blue
(49, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/main.png'),
(49, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/side.png'),
(49, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/top.png'),
(49, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/grey-blue/portrait.png'),

-- Heritage Aura Graphic Crossbody Bag - Blueberry
(50, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/main.png'),
(50, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/side.png'),
(50, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/top.png'),
(50, '../assets/images/products/bag/heritage-aura-graphic-crossbody-bag/blueberry/portrait.png');
