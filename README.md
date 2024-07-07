# E-Commerce Clothing Website

## Project Overview
This is a fully functional e-commerce clothing website built using PHP and MySQL. It includes features such as payment integration, cart management, discount application, and search filters.

## Features
- User Authentication (Login/Registration)
- Product Listing
- Product Search and Filters
- Shopping Cart
- Discount Codes
- Payment Gateway Integration
- Order Management

## Technologies Used
- PHP
- MySQL
- HTML/CSS
- JavaScript
- Bootstrap

## Setup Instructions

### Prerequisites
- PHP 7.x or higher
- MySQL 5.x or higher
- Apache/Nginx Server
- Composer (for dependency management)


## Features Description

### User Authentication
- **Registration**: Allows users to create an account by providing necessary information such as name, email, and password. This feature ensures user data is securely stored in the database and provides error handling for duplicate accounts and other common issues.
- **Login**: Allows users to log in to their accounts using their email and password. This feature includes session management to keep users logged in and secure their session information.

### Product Listing
- **Listing**: Displays a list of products with pagination to handle a large number of products efficiently. Each product is shown with a thumbnail image, name, price, and a brief description.
- **Details**: Provides detailed information about a specific product, including high-resolution images, full description, price, available sizes, and colors. Users can also see related products and reviews.

### Product Search and Filters
- **Search**: Allows users to search for products by entering keywords in the search bar. The search functionality includes live search suggestions and accurate matching of products based on the entered keywords.
- **Filters**: Enables users to filter products based on various attributes such as category, price range, brand, size, color, and other specifications. Filters can be applied simultaneously to refine the product search.

### Shopping Cart
- **Add to Cart**: Users can add products to their cart with a single click. The cart icon updates in real-time to reflect the number of items added.
- **View Cart**: Users can view items in their cart, including product names, quantities, prices, and subtotal. The cart page allows users to proceed to checkout.
- **Update Cart**: Users can update item quantities directly in the cart or remove items entirely. The cart totals update in real-time to reflect changes.

### Discount Codes
- **Apply Discount**: Users can apply discount codes during checkout to receive price reductions. The system validates discount codes for expiry, usage limits, and eligibility criteria before applying the discount.

### Payment Gateway Integration
- **Payment**: Integrates with popular payment gateways such as PayPal and Stripe to process payments securely. Users can enter their payment details and complete transactions with encryption and fraud prevention measures.

### Order Management
- **Order History**: Users can view their past orders, including order dates, product details, prices, and order status. This feature helps users keep track of their purchases.
- **Order Details**: Shows detailed information about a specific order, including shipping address, payment method, itemized product list, and tracking information if available.

