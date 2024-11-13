# Serene&Co Fashion E-Commerce Website

This project is a fashion e-commerce platform developed for the IE4727 Web Application Design course at NTU. The platform, Serene&Co, is a fictional online store offering a selection of fashion items, including bags and watches. The site is built using PHP, MySQL, HTML, CSS, and JavaScript to provide a dynamic and interactive shopping experience.

Table of Contents

	•	Project Overview
	•	Features
	•	Technologies Used
	•	Setup and Installation
	•	Database Structure
	•	Usage
	•	Project Structure
	•	Future Enhancements

Project Overview

Serene&Co is designed to simulate a real-world e-commerce platform, enabling users to:
	1.	Browse and search for products.
	2.	View detailed product information.
	3.	Add items to a shopping cart.
	4.	Proceed with a checkout process and receive an email receipt.
	5.	Manage orders, categories, product listings through an admin panel (admin access only).

Features

	•	Product Catalog: Browse a variety of fashion items.
	•	Search Functionality: Quickly search items by name or category.
	•	Shopping Cart: Add, view, and remove items in the cart.
	•	User Authentication: Registration and login features.
	•	Order Processing: Secure checkout and email receipt functionality.
	•	Admin Panel: Manage product listings and order statuses.

Technologies Used

	•	PHP: Server-side scripting for handling requests and managing sessions.
	•	MySQL: Database management for storing user, product, and order information.
	•	HTML/CSS: Frontend structure and styling.
	•	JavaScript: Dynamic interactions and form validation.
	•	PHP Mailer: To send email receipts upon successful order checkout.

Setup and Installation

	1.	Clone Repository: git clone [https://github.com/Aquila-Ng/IE4727-Project.git]
	2.	Configure Database:
	•	Import data.sql into your MySQL database to set up necessary tables.
	•	Update database credentials in ../includes/config/db_connect.php
	3.	Server Setup:
	•	Use a local server environment (e.g., XAMPP or MAMP) to run the PHP application.
	•	Place the project folder in the server’s root directory.

Database Structure

	•	Users: Stores user details.
	•	Products: Holds information on items available in the store.
	•	Variants: Holds information on variants (Eg. Blue, Bronze).
	•	Orders: Records completed orders.
	•	Order_items: Records items details for each individual order.

Usage

	1.	User Registration/Login: Create an account or log in to begin shopping.
	2.	Browse Products: Navigate through categories or use the search bar.
	3.	Shopping Cart: Add items to the cart and view the cart to proceed to checkout.
	4.	Checkout Process: Complete checkout and receive an email confirmation.

Future Enhancements

	•	Add payment gateway integration for real-world transactions.
	•	Implement user reviews and ratings on products.
	•	Add wish list functionality for logged-in users.
	•	Improve accessibility for a broader audience (SEO).