from pathlib import Path

# Restaurant Management System

A full stack web application for restaurant management that allows **customers** to browse the menu, place online orders, and book tables while providing an **admin dashboard** to manage all restaurant operations such as menu items, reservations, and orders.

---

## 🚀 Overview

This Restaurant Management System is designed to streamline restaurant operations and improve customer experience.  
It provides two interfaces:

- **User Website** for customers to:
  - View the restaurant’s menu with images and prices  
  - Order food online  
  - Book a table for dine in  
  - Receive booking/order confirmation  

- **Admin Dashboard** for restaurant staff to:
  - Perform full CRUD (Create, Read, Update, Delete) operations on menu items, orders, and bookings  
  - Monitor order statuses  
  - Manage table reservations and customer requests  

---

## ⚙️ Installation & Setup

Follow these steps to run the project locally:

# 1. Clone this repository
git clone https://github.com/arvinwira/restaurant-management-system.git
cd restaurant-management-system

# 2. Install PHP dependencies
composer install

# 3. Install frontend dependencies
npm install && npm run dev

# 4. Set up environment variables
cp .env.example .env

# 5. Generate application key
php artisan key:generate

# 6. Create database and update credentials in .env

# 7. Run migrations and seed initial data
php artisan migrate --seed

# 8. Start the local development server
php artisan serve
