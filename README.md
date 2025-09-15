# Flat renovation System

This project is a web-based management system designed to streamline and digitalize the process of apartment renovation. It enables system administrators, companies, and employees to manage renovation projects efficiently while providing customers with clear communication and tracking.


## 🚀 Features

### 1. User Roles
- System Administrator
    - Manage companies.
    - Manage subscription plans.
    - Monitor overall statistics and system health.
- Company
    - Manage its own employees.
    - Manage renovation projects.
    - Track evaluations and ratings.
- Employee
    - Access assigned tasks.
    - Update task progress.
- Customer
    - View project progress and status updates.

---

### 2. Functional Requirements
- Company management.
- Subscription plan management with limits (price, project limits, etc.).
- Project management (create projects, assign employees, monitor progress).
- Service types management (ceramic, parquet, marble, painting, plumbing, etc.).
- Authentication & authorization with role-based access control.
- Email verification is done via a verification code OTP.
- Dashboard with statistics (number of companies, projects, employees, customers).
- Profile pages for users, companies, and employees.
- File uploads (company logos, project images, service type icons).
- real-time notification system for important alerts using Firebase for mobile and web.
- real-time chat system using pusher.

## 🛠️ Tech Stack
- Backend: Laravel 10 (PHP Framework)
- Frontend: Blade, Filament (for admin dashboards)
- Database: MySQL
- Authentication: Laravel Breeze / Sanctum
- File Storage: Laravel Storage (public disk for logos & images)
- Laravel Spatie Role and Permission package
- ExportBulkAction for export excel files in filament

Documentation for APIS on Postman [LinKPostmanDoc](https://documenter.getpostman.com/view/45301413/2sB34oDdTX)

---
## ⚙️ Installation & Setup

1. Clone the repository:**`git clone https://github.com/amalfathieh/flat-renovation.git`**
2. Navigate to the project directory: **`cd flat-renovation-system`**
3. Run this command to download composer packages:
   **composer install`**
4. Run this command to update composer packages:
   **`composer update`**
5. Create a copy of your .env file: **`cp .env.example .env`**
6. Generate an app encryption key: **`php artisan key:generate`**

7. Create an empty database for our application in your DBMS
8. In the .env file, add database information to allow Laravel to connect to the database
9. Migrate the database: **`php artisan migrate`**
10. Seed the database : **`php artisan db:seed`**
11. Link storage for public assets:**`php artisan storage:link`**
12. Start schedule  : **`php artisan schedule:work`**
13. Start queue : **`php artisan queue:work`**
14. run: **`npm run dev`**
15. Start development server: **`php artisan serve`**
