# TechStore Project Report

## 1. Project Overview
TechStore is a PHP-based e-commerce platform for selling consumer tech products (mobiles, laptops, cameras, TVs, peripherals). It supports two roles: regular users (buyers/sellers) and administrators, designed to run on XAMPP (Apache + MySQL + PHP).

## 2. Technology Stack
| Layer | Technologies |
|-------|--------------|
| Frontend | HTML5, CSS3, JavaScript, Bootstrap, html2pdf.js (PDF invoices) |
| Backend | PHP (procedural, no framework) |
| Database | MySQL (InnoDB) |
| Libraries | PHPMailer (email verification) |

## 3. Database Structure (techstorer.sql)
22 tables total, including:
- **User System**: `user` (4 sample users), `admin` (1 admin)
- **Catalog**: `category` (5), `brand` (23), `model` (25), `product` (33 sample listings), `images`
- **Transactions**: `cart`, `invoice` (13 order records), `status` (active/deactive), `condition` (new/used)
- **User Features**: `watchlist`, `recent` (view history), `feedback`, `chat`/`admin_chat`/`user_chat`
- **Location**: `province` (9), `district` (25), `city` (3), `user_has_address`

## 4. Key Features
### User Module
Authentication (signup, login, email verification), selling (add/update/delete products), shopping (category browse, search, cart, checkout, PDF invoices), account tools (watchlist, order history, feedback, admin chat).

### Admin Module
Manage users/products (block/delete), manage categories/brands/models, update order statuses, view sales history, respond to user chats.

## 5. Critical Issues
### Database Flaws
1. Reserved keyword `condition` used as table name (causes query errors without backticks)
2. `admin_chat`/`user_chat` foreign keys reference `user.email` for admin columns, but admin emails are stored in the `admin` table (invalid constraints)
3. Redundant `model_has_brand` table (already linked via `model.brand_id`)
4. `product.qty` stored as VARCHAR instead of INT

### Code Structure Flaws
1. No MVC pattern: 60+ PHP files in root directory
2. Typos in filenames: `addToWatchlistPocess.php`, `sendVerifivationCodeProcess.php`
3. Procedural code with no OOP/framework, hard to maintain
4. Unnecessary PhpStorm `.idea` config files included

## 6. File Structure
```
C:\xampp\htdocs\techstore\
├── .idea/ (IDE config, excluded from repo)
├── resource/ (images, icons, PDF library)
├── bootstrap.* (frontend framework)
├── SMTP.php, Exception.php (PHPMailer)
├── 60+ root PHP files (auth, products, cart, admin, chat)
└── style.css, script.js (custom assets)
```