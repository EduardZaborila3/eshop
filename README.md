<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# 📦 Project Overview

The project has been developed to ensure an **easy, safe, and friendly process** between customers and companies.  

There are just two types of users:
- **Admins** → Absolute access across the platform.
- **Staff Members** → Responsible for manipulating data (products, recipients, and orders).

---

## 🛠️ Used Technologies
- **PHP** v8.4
- **Laravel** v12.28.1
- **Node.js** v22.19.0
- **MySQL** (for database)

---

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone 'project-url'
   cd project-folder
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Database setup**
   - Make sure you have **MySQL** installed and configured.
   - Update the `.env` file with your database credentials.

4. **Generate Laravel application key**
   This key is used for securely encrypting the data.
   ```bash
   php artisan key:generate
   ```

5. **Migrate and seed the database**
   ```bash
   php artisan migrate --seed
   ```

   ✅ Factories and seeders are available for:  
   - Users  
   - Companies  
   - Products  
   - Recipients  
   - Orders  

   This will generate useful **mock data** for testing.

---

## 📊 Database Relationships

- **Company → Products**  
  - Company has many Products  
  - Product belongs to Company  

- **Order ↔ Products**  
  - Order belongs to many Products  
  - Product belongs to many Orders  

- **Recipient → Orders**  
  - Recipient has many Orders  
  - Order belongs to Recipient  

- **User → Orders**  
  - User has many Orders  
  - Order belongs to User  

- **Company → Orders**  
  - Company has many Orders  
  - Order belongs to Company  
