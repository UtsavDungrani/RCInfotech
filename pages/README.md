# RCInfotech

RCInfotech is a web-based IT services and e-commerce platform that allows users to browse and purchase products, book IT services, and manage orders. The platform includes a user-facing storefront and a comprehensive admin panel for managing products, services, shops, users, and orders.

---

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [Folder Structure](#folder-structure)
- [Technologies Used](#technologies-used)
- [Installation & Setup](#installation--setup)
- [Usage Guide](#usage-guide)
- [Admin Panel](#admin-panel)
- [Database](#database)
- [FAQ](#faq)
- [Contact](#contact)

---

## Project Overview

RCInfotech provides a platform for users to:

- Register and log in
- Browse and purchase IT products
- Book a variety of IT services (e.g., data recovery, computer/mobile repair)
- Manage their cart and checkout
- Track orders and service requests

Admins can manage products, services, shops, users, and orders through a secure admin dashboard.

---

## Features

- **User Registration & Login**: Secure authentication for users and admins
- **Product Catalog**: Browse, search, and view product details
- **Service Booking**: Book IT services with quick response
- **Shopping Cart & Checkout**: Add products to cart, update quantities, and checkout
- **Order Management**: Users can view their orders; admins can manage and update order statuses
- **Admin Dashboard**: Manage products, services, shops, users, and orders
- **Email Notifications**: Order confirmations and status updates via email
- **Responsive Design**: Mobile-friendly UI using Bootstrap
- **FAQ & Feedback**: Users can view FAQs and submit feedback

---

## Folder Structure

```
RCInfotech/
  ├── admin/                # Admin panel files
  │   ├── insert_product/   # Product management (add, edit, delete)
  │   ├── insert_services/  # Service management (add, edit, delete)
  │   ├── insert_shop/      # Shop management (add, edit, delete)
  │   ├── ...
  ├── config/               # Configuration files (e.g., database connection)
  ├── css/                  # Stylesheets
  ├── js/                   # JavaScript files
  ├── images/               # Image assets
  ├── phpmailer/            # PHPMailer library for email
  ├── database/             # Database schema (rcinfotech.sql)
  ├── revolution/           # Slider assets
  ├── webfonts/             # Web fonts
  ├── about_us.php          # About page
  ├── cart.php              # Shopping cart
  ├── checkout.php          # Checkout process
  ├── contact.php           # Contact form
  ├── faq.php               # Frequently Asked Questions
  ├── feedback.php          # Feedback form
  ├── index.php             # Home page
  ├── login.php             # User login
  ├── logout.php            # User logout
  ├── make_appointment.php  # Book service appointment
  ├── order_success.php     # Order success page
  ├── product.php           # Product details
  ├── register.php          # User registration
  ├── service.php           # Service listing
  ├── service_display.php   # Service details
  ├── shop.php              # Shop listing
  ├── user_orders.php       # User's order history
  ├── user_service_requests.php # User's service requests
  └── ...
```

---

## Technologies Used

- **Backend**: PHP (PDO & MySQLi)
- **Frontend**: HTML5, CSS3, Bootstrap, JavaScript, jQuery
- **Database**: MySQL
- **Email**: PHPMailer
- **Other**: FontAwesome, Animate.css, Revolution Slider

---

## Installation & Setup

1. **Clone the repository** or copy the project files to your web server directory (e.g., `htdocs` for XAMPP).
2. **Database Setup**:
   - Import the `database/rcinfotech.sql` file into your MySQL server to create the required tables.
   - Update the database credentials in `config/config.php` if needed:
     ```php
     $host = 'localhost';
     $db = 'RCInfotech';
     $user = 'root';
     $pass = '';
     ```
3. **PHPMailer Setup**:
   - PHPMailer is included in the `phpmailer/` directory. No extra setup is needed unless you want to change SMTP settings.
4. **Start the server** (e.g., using XAMPP, WAMP, or LAMP) and navigate to `http://localhost/RCInfotech/` in your browser.

---

## Usage Guide

### For Users

- **Register**: Go to `register.php` to create a new account.
- **Login**: Use `login.php` to log in with your username/email and password.
- **Browse Products/Services**: Use the navigation menu to explore products and services.
- **Add to Cart**: Add products to your cart and proceed to checkout.
- **Book Services**: Book IT services and track your requests.
- **Order Tracking**: View your orders and service requests from your user dashboard.

### For Admins

- **Admin Login**: Go to `admin/login.php` and log in with admin credentials.
- **Dashboard**: Access statistics and quick links to manage products, services, shops, users, and orders.
- **Manage Products/Services/Shops**: Add, edit, or delete entries as needed.
- **Order & Service Management**: Approve/reject service requests, update order statuses, and notify users.

---

## Admin Panel

- **Location**: `/admin/`
- **Features**:
  - Dashboard overview (products, services, shops, users, orders, revenue)
  - Manage products, services, and shops (CRUD operations)
  - View and manage user accounts
  - Approve/reject service requests
  - Update order statuses (pending, processing, shipped, delivered)
  - Email notifications for order updates

---

## Database

- **Schema**: See `database/rcinfotech.sql` for full table definitions.
- **Main Tables**:
  - `users`: Stores user accounts
  - `admin_users`: Stores admin accounts
  - `product`: Product catalog
  - `services`: Service catalog
  - `shop`: Shop locations
  - `orders`: Order records
  - `bookser`: Service booking requests

---

## FAQ

See [`faq.php`](faq.php) for a list of frequently asked questions and troubleshooting tips for common IT issues.

---

## Contact

For support or inquiries, please use the [Contact Us](contact.php) page on the website.

---

**Note:**

- Do not share or commit sensitive credentials (such as SMTP passwords) to public repositories.
- For production, update all default credentials and review security best practices.
