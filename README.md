# 🚀 Short URL Service

A Laravel 11 based Short URL Management System with role-based access control.

---

# 📌 Technical Specifications

- **PHP**: 8.4
- **Laravel**: ^11.0
- **Composer**: 2.9
- **Database**: MySQL 9.1.0
- **Frontend**: Vite
- **Node.js**: Recommended (LTS)

---

# 📦 Project Setup

---

## ✅ 1. Clone Repository

```bash
git clone <repository_url>
cd project-folder
```

---

## ✅ 2. Create Database

Create database in MySQL:

```sql
CREATE DATABASE sembark;
```

---

## ✅ 3. Install Dependencies

```bash
composer install
```

---

## ✅ 4. Configure Environment File

```bash
cp .env.example .env
```

Update DB credentials:

```env
DB_DATABASE=sembark
DB_USERNAME=root
DB_PASSWORD=your_password
```

---

## ✅ 5. Generate Application Key

```bash
php artisan key:generate
```

---

## ✅ 6. Run Database Migrations

```bash
php artisan migrate --seed
```

---

## ✅ 7. Install Frontend Dependencies

```bash
npm install
```

---

## ✅ 8. Compile Assets (Vite)

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

---

## ✅ 9. Run Application

```bash
php artisan serve
```

Application URL:

```
http://127.0.0.1:8000
```

---

# 🔐 User Roles

| Role | Capabilities |
|----------|----------------|
| **Super Admin** | Manage companies & admins |
| **Admin** | Manage users & short URLs |
| **User** | Generate & track URLs |

---

# 📊 Features

✅ Company Management   

✅ Admin Invitation System  
✅ Short URL Generation  
✅ Click / Hits Tracking

---

# 🧰 Useful Commands

---

## 🔹 Clear Cache

```bash
php artisan optimize:clear
```

---

## 🔹 Refresh Database

```bash
php artisan migrate:fresh --seed
```

---

## 🔹 Rebuild Assets

```bash
npm run dev
```

---

## 🔹 Autoload Fix

```bash
composer dump-autoload
```

---

# ⚠ Common Issues & Fixes

| Problem | Solution |
|-------------|-------------|
| App key missing | `php artisan key:generate` |
| Env changes not reflected | `php artisan optimize:clear` |
| Assets not loading | `npm install && npm run dev` |
| Class not found | `composer dump-autoload` |
| Migration errors | `php artisan migrate:fresh` |

---

# 📧 Mail Setup (If Enabled)

For Gmail SMTP:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

⚠ Use **App Password**, not Gmail password.

---

---

# 👨‍💻 Author

Sanjay A. Gadakh

---

# 📜 License

This project is proprietary / internal use unless specified otherwise.

