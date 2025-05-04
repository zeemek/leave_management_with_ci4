# Employee Leave Management System - Project Architecture & Explanation

## Overview
This is a web-based application for managing employee leave requests, approvals, and balances. It is built using CodeIgniter 4 (PHP framework), MySQL, Bootstrap 5, and standard web technologies.

---

## Main Components

### 1. **Models**
- **UserModel**: Handles user data, registration, authentication, and activation status.
- **LeaveTypeModel**: Manages leave types (e.g., Casual, Earned) and their properties.
- **LeaveRequestModel**: Handles leave request creation, status updates, and history.
- **LeaveBalanceModel**: Tracks leave balances for each user and leave type.

### 2. **Controllers**
- **Auth**: Handles login, registration, and logout.
- **Dashboard**: Main landing page after login; loads user/admin data.
- **Admin**: Handles user activation/deactivation and user management.
- **LeaveType**: CRUD for leave types (admin only).
- **LeaveRequest**: Handles leave request submission, approval, and rejection.

### 3. **Views**
- **dashboard.php**: Main dashboard for both employees and admins. Admins see extra tables for user management and pending approvals.
- **admin/users.php**: (Optional) Standalone user management table for admins.
- **leave_types/**: Views for managing leave types (list, create, edit).
- **auth/**: Login and registration forms.

---

## Routing & Linking
- All routes are defined in `app/Config/Routes.php`.
- Example routes:
  - `/login`, `/register`, `/logout` (Auth)
  - `/dashboard` (Dashboard)
  - `/leave-request/create`, `/leave-request/store` (LeaveRequest)
  - `/leave-types` (LeaveType management)
  - `/admin/activate/{id}`, `/admin/deactivate/{id}` (Admin user management)

### How Routing Works
- Each route maps to a controller method.
- Example: `/admin/activate/3` calls `Admin::activate(3)`.
- AJAX is used for Activate/Deactivate buttons on the dashboard for instant updates.

---

## How Everything Connects
- **Registration**: Employee registers → `is_active` is set to 0 → Admin sees pending user on dashboard → Admin clicks Activate → `is_active` set to 1 → Employee can now log in.
- **Leave Requests**: Employee submits leave request → Admin sees pending requests → Admin approves/rejects → Status updates in real time.
- **Leave Balances**: Automatically initialized for each user and leave type; updated as leave is approved.
- **Admin Dashboard**: Central place for all approvals, user management, and leave tracking.

---

## Application Flow
1. **User registers** (inactive by default)
2. **Admin logs in** and sees pending users and leave requests
3. **Admin activates users** and approves/rejects leave
4. **Employees** can log in, view balances, request leave, and see history

---

## Security & Best Practices
- Passwords are hashed using PHP's `password_hash`.
- All forms use CSRF protection.
- Input validation is enforced in controllers.
- SQL injection and XSS are prevented by CodeIgniter's query builder and escaping functions.

---

## Directory Structure
```
app/
  Config/         # Configuration files (routes, database, etc.)
  Controllers/    # All controller logic
  Database/       # Migrations and seeders
  Models/         # Data models
  Views/          # HTML/PHP views
public/           # Public web root (index.php)
writable/         # Cache, logs, and session files
vendor/           # Composer dependencies
```

---

## How to Run
1. Clone or copy the project to your web server's document root.
2. Import the database schema.
3. Update database credentials in `app/Config/Database.php`.
4. Make sure `writable/` is writable by the web server.
5. Access `/login` in your browser.

---

## How Linking Works
- Navigation links use `base_url()` for portability.
- Admin-only links are shown using `session()->get('isAdmin')`.
- AJAX is used for instant activation/deactivation of users.

---

## Questions?
Contact the system administrator or check the code comments for more details. 