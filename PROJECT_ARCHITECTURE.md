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
Contact Leishangthem Michael Meitei or check the code comments for more details. 

### Evaluation Parameters
# 1. System Design
- Modular Structure:
The project follows the MVC (Model-View-Controller) pattern, which is a strong architectural choice for maintainability and scalability.
- Separation of Concerns:
Controllers handle logic, models handle data, and views handle presentation. This separation is clear in your directory structure and code organization.
- Routing:
All routes are defined in app/Config/Routes.php, making navigation and endpoint management centralized and easy to update.
- User Flow:
The application flow is logical: registration, admin approval, login, leave requests, and admin actions are all clearly mapped out.
- Extensibility:
The modular approach allows for easy addition of new features (e.g., more leave types, additional user roles).
- Overall:
System design is robust, modular, and follows best practices for web applications.

# 2. Database Design
- Normalization:
The use of separate models for users, leave types, leave requests, and leave balances suggests a normalized database structure, reducing redundancy.
- Relationships:
Leave requests and balances are linked to users and leave types, which is appropriate for this domain.
- Scalability:
The design supports multiple users, leave types, and requests, making it scalable for larger organizations.
- Migrations/Seeders:
The presence of a Database/ directory for migrations and seeders is a good practice for versioning and deploying database changes.
- Overall:
Database design appears normalized, relational, and scalable.

# 3. Web Application Security
- Password Hashing:
Passwords are hashed using PHP’s password_hash, which is secure and recommended.
- CSRF Protection:
All forms use CSRF protection, reducing the risk of cross-site request forgery attacks.
- Input Validation:
Input validation is enforced in controllers, helping prevent invalid or malicious data.
- SQL Injection & XSS:
CodeIgniter’s query builder and escaping functions are used, protecting against SQL injection and XSS.
- Session Management:
Sessions are used for authentication and authorization, and admin-only actions are protected.
- Overall:
The application demonstrates strong security practices for a web application.

# 4. Coding Standards
- Code Organization:
Files and directories are well-organized according to CodeIgniter conventions.
- Naming Conventions:
Classes, methods, and variables follow clear and consistent naming conventions.
- Documentation:
The project includes a detailed README.md and PROJECT_ARCHITECTURE.md, aiding maintainability and onboarding.
- Best Practices:
Use of MVC, centralized routing, and configuration files shows adherence to modern PHP and CodeIgniter standards.
- Comments:
Comments and docblocks are present, making the code easier to understand.
- Overall:
Coding standards are high, with clear organization, naming, and documentation.

# Summary Table
| Summary         | Evaluation                                                                     |
|-----------------|--------------------------------------------------------------------------------|
| System Design   | Modular, MVC, extensible, clear user flow                                      |
| Database Design | Normalized, relational, scalable, migration support                            |
| Web App Security| Password hashing, CSRF, input validation, SQLi/XSS protection, sessions        |
| Coding Standards| Organized, consistent naming, documented, follows best practices               |

