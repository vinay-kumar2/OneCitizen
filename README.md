<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">🏛️ OneCitizen Portal</h1>

<p align="center">
  <strong>A Laravel-based Citizen Management Portal with Pension Scheme Management and Assignment Tracking</strong>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Laravel Version"></a>
  <img src="https://img.shields.io/badge/PHP-8.1+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-purple.svg" alt="Bootstrap">
  <img src="https://img.shields.io/badge/Database-MySQL-orange.svg" alt="MySQL">
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License">
</p>

---

## 📖 About the Project

**OneCitizen Portal** is a comprehensive web-based application built for government agencies and authorized personnel to manage citizen records, pension schemes, and pension assignments — all from a single, unified dashboard.

Built using **Laravel 11** and **Bootstrap 5**, the portal delivers a clean, responsive UI with real-time statistics, global search, and automatic duplicate detection.

### ✨ Key Highlights

- 🗂️ Full **CRUD** for Citizens, Pension Schemes, and Pension Assignments
- 📊 Real-time **Dashboard** with statistics and quick actions
- 🔍 **Global Search** across all entities
- 🔁 **Duplicate Detection** system for citizen records
- 🔐 **Session-based Authentication** for secure admin access
- 📱 **Responsive UI** with Bootstrap 5

---

## 🛠️ Technology Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel 11 (PHP 8.1+) |
| Frontend Framework | Bootstrap 5 |
| Templating Engine | Blade |
| Primary Database | MySQL (via XAMPP / phpMyAdmin) |
| Optional Database | MongoDB |
| Authentication | Laravel Session-based Auth |

---

## 📁 Project Structure

```
app/
├── Http/
│   └── Controllers/
│       ├── Auth/LoginController.php
│       ├── CitizenController.php
│       ├── PensionSchemeController.php
│       ├── CitizenPensionController.php
│       ├── DashboardController.php
│       ├── SearchController.php
│       └── DuplicateDetectionController.php
├── Models/
│   ├── Citizen.php
│   ├── PensionScheme.php
│   ├── CitizenPension.php
│   ├── User.php
│   └── DuplicateLog.php
resources/
└── views/
    ├── layouts/admin.blade.php
    ├── citizens/
    ├── pension_schemes/
    ├── citizen_pensions/
    ├── search/
    └── dashboard.blade.php
```

---

## ⚙️ Installation & Setup

### Prerequisites

- PHP 8.1+
- Composer
- XAMPP (Apache + MySQL) or any MySQL server
- Node.js & npm (for frontend assets)

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/vinay-kumar2/OneCitizen
cd onecitizen-portal
```

**2. Install PHP dependencies**
```bash
composer install
```

**3. Install frontend dependencies**
```bash
npm install && npm run dev
```

**4. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

**5. Set up the database**

Open phpMyAdmin (`http://localhost/phpmyadmin`) and create a database named `onecitizen_portal`, then update your `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=onecitizen_portal
DB_USERNAME=root
DB_PASSWORD=
```

**6. Run migrations**
```bash
php artisan migrate
```

**7. (Optional) Seed the database**
```bash
php artisan db:seed
```

**8. Start the development server**
```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

---

## 🗄️ Database Schema

| Table | Description |
|---|---|
| `citizens` | Stores citizen info — name, Aadhaar, mobile, address, pension status |
| `pension_schemes` | Scheme details — name, code, type, benefit amount, status |
| `citizen_pensions` | Links citizens to schemes — enrollment, start date, status |
| `users` | Admin user management and authentication |
| `duplicate_logs` | Tracks automatically detected duplicate records |

---

## 🚀 Features

### 👤 Citizens Management
- Register citizens with Aadhaar, mobile, gender, DOB, state, address
- View paginated list with search and filters
- Edit personal details and pension status
- Delete records with confirmation
- <img width="1600" height="858" alt="WhatsApp Image 2026-05-16 at 8 41 53 PM" src="https://github.com/user-attachments/assets/c6ec3d90-ab51-4833-aca9-3ce8f939dc5d" />
- <img width="1600" height="860" alt="WhatsApp Image 2026-05-16 at 8 44 01 PM (2)" src="https://github.com/user-attachments/assets/3e37ddbc-7501-4d30-8350-62b60c6ec7e7" />


### 📋 Pension Schemes Management
- Create schemes with type, provider, eligibility, and benefit amount
- Filter by status (Active / Draft / Inactive)
- Update or archive schemes
<img width="1600" height="857" alt="WhatsApp Image 2026-05-16 at 8 48 45 PM (1)" src="https://github.com/user-attachments/assets/badeead7-dbdb-477c-bf67-418baa7fbba6" />


### 🔗 Pension Assignment Management
- Assign schemes to eligible citizens
- Track enrollment number, start date, monthly benefit
- Update or remove assignments

### 📊 Dashboard
- Total citizens, active schemes, assignments, and pending counts
- Recent citizen activity table
- Quick action buttons

### 🔍 Global Search
- Search citizens by name, Aadhaar, or mobile
- Search schemes by name or code
- Search assignments by enrollment number
- Results split into three columns


---

## 🗺️ Routes Overview

```php
// Dashboard
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// Citizens CRUD
Route::resource('citizens', CitizenController::class);

// Pension Schemes CRUD
Route::resource('pension-schemes', PensionSchemeController::class);

// Citizen Pensions CRUD
Route::resource('citizen-pensions', CitizenPensionController::class);

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

// Duplicate Detection
Route::get('/duplicate-detection', [DuplicateDetectionController::class, 'index'])
     ->name('duplicate-detection.index');
```

---

## 🔮 Roadmap / Future Features

- [ ] SMS & Email Notifications (Twilio + Laravel Mail)
- [ ] Document Upload (ID proof, address proof, medical certificates)
- [ ] Payment Gateway Integration for disbursement tracking
- [ ] Analytics & Reporting with charts
- [ ] Multi-language / i18n support
- [ ] Role-based Access Control (Super Admin, Scheme Manager, Data Entry)
- [ ] RESTful API for mobile app integration
- [ ] Audit Trail with full change history
- [ ] CSV / Excel data export
- [ ] Enhanced mobile responsiveness

---

## 📸 Screenshots

> *(Add your screenshots here)*

| Dashboard | Citizens List |
|---|---|
| ![Dashboard](screenshots/dashboard.png) | ![Citizens](screenshots/citizens.png) |

| Pension Schemes | Global Search |
|---|---|
| ![Schemes](screenshots/schemes.png) | ![Search](screenshots/search.png) |

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature`
3. Commit your changes: `git commit -m 'Add your feature'`
4. Push to the branch: `git push origin feature/your-feature`
5. Open a Pull Request

---

## 🔒 Security

If you discover any security vulnerabilities, please report them via email rather than opening a public issue.

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

**Shivam Anand**
Registration No: 12308901
**Priyanshu**
Registration No: 12307696
**Vinay Kumar**
Registration No: 1230
B.Tech Computer Science & Engineering
Lovely Professional University, Jalandhar, Punjab

> Guided by: **Pallavi Soni**

---

<p align="center">Made with ❤️ using Laravel 11 &nbsp;|&nbsp; LPU, May 2026</p>
