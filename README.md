# Inventory Management System

<div align="center">
  <img src="ln.png" alt="logo" width="200" height="auto" />
  <h1>Inventory Management System</h1>
  <p>
    A powerful and efficient inventory management system built with Laravel 11.
  </p>

  <!-- Badges -->
  <p>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/graphs/contributors">
      <img src="https://img.shields.io/github/contributors/GiraldoNainggolan/inventory-laravel11" alt="contributors" />
    </a>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11">
      <img src="https://img.shields.io/github/last-commit/GiraldoNainggolan/inventory-laravel11" alt="last update" />
    </a>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/network/members">
      <img src="https://img.shields.io/github/forks/GiraldoNainggolan/inventory-laravel11" alt="forks" />
    </a>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/stargazers">
      <img src="https://img.shields.io/github/stars/GiraldoNainggolan/inventory-laravel11" alt="stars" />
    </a>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/issues/">
      <img src="https://img.shields.io/github/issues/GiraldoNainggolan/inventory-laravel11" alt="open issues" />
    </a>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/blob/main/LICENSE">
      <img src="https://img.shields.io/github/license/GiraldoNainggolan/inventory-laravel11.svg" alt="license" />
    </a>
  </p>
  
  <h4>
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11">View Demo</a> ·
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11">Documentation</a> ·
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/issues/">Report Bug</a> ·
    <a href="https://github.com/GiraldoNainggolan/inventory-laravel11/issues/">Request Feature</a>
  </h4>
</div>

---

## 📌 Overview
The **Inventory Management System** is a web-based application designed to help small businesses manage and track their inventory efficiently. Built using **Laravel 11** and **PostgreSQL**, this system includes features such as user authentication, role-based access control, inventory tracking, and more.

## ✨ Features
- 🔐 **User Authentication**: Secure login and registration system.
- 🏷️ **Role-Based Access Control**: Manage user permissions based on roles.
- 📦 **Inventory Management**: CRUD operations for inventory items.
- 📊 **Inventory Tracking**: Real-time stock monitoring with alerts.
- 🔍 **Dynamic Filtering**: AJAX-based search and filtering functionality.
- 📥 **Data Import/Export**: Import and export inventory data in CSV and Excel formats.
- 📑 **PDF Export**: Generate PDF documents for sales bills with dynamic file names.
- 🚨 **Stock Alerts**: Notifications when stock levels are low.

## 🔮 Future Enhancements
- 📜 **Quotation Management**: Manage and generate quotations.
- 📝 **Editable Purchase & Sale Records**.
- 📄 **Sale Bill PDF Generation**.

## 🛠️ Technology Stack
- **Backend**: Laravel 11, PostgreSQL
- **Frontend**: Blade Templating Engine, JavaScript, jQuery, AJAX
- **Version Control**: Git, GitHub
- **Environment**: Windows, Composer, PSR-4, nWidart package for modular development

## 🚀 Installation

1️⃣ **Clone the repository:**
```sh
git clone https://github.com/GiraldoNainggolan/inventory-laravel11.git
```

2️⃣ **Navigate to the project directory:**
```sh
cd inventory-laravel11
```

3️⃣ **Install dependencies:**
```sh
composer install
npm install
```

4️⃣ **Set up environment:**
```sh
cp .env.example .env
php artisan key:generate
```

5️⃣ **Configure `.env` file with database credentials (PostgreSQL):**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_test
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6️⃣ **Run database migrations:**
```sh
php artisan migrate
```

7️⃣ **Serve the application:**
```sh
php artisan serve
```

## ✅ Running Tests
To run application tests:
```sh
php artisan test
```

## 🤝 Contributing
Contributions are welcome! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Open a Pull Request.

## 📜 License
This project is licensed under the **MIT License**. See the [LICENSE](https://github.com/GiraldoNainggolan/inventory-laravel11/blob/main/LICENSE) file for details.

