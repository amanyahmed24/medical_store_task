# Medical Store Task

A simple medical e-commerce application built with Laravel.  
Allows customers to browse products, add to cart, checkout without login, and view order confirmation.  
Includes admin panel for managing products and orders.

---

## Features

-   Display medical products with images, names, and prices
-   Add products to cart and manage cart items (update quantity/remove)
-   Checkout without login by providing customer info (name, phone, address)
-   Order confirmation page with summary
-   Admin area for managing products and viewing orders
-   Product change logging (created, updated, deleted)

---

## Installation

1.  Clone the repository

        ```bash
        git clone https://github.com/your-username/medical_store_task.git
        cd medical_store_task

    ============

2.  Install dependencies
    composer install
    npm install
    npm run dev

=============

3. Setup .env file
   cp .env.example .env
   php artisan key:generate
   =================

4. Migrate and seed the database
   php artisan migrate --seed

==================== 5. Run the application
php artisan serve
Visit http://localhost:8000 in your browser

=====================

## Admin Credentials

        'email' => 'admin@ncg.com',
        'password => "password"

======================

## License

This project is open-source and available under the MIT License.
