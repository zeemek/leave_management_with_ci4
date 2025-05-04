# Employee Leave Management System

A web-based system for managing employee leave requests and approvals.

## Features
- User Registration & Activation (admin approval required)
- Leave Request Management
- Leave Balance Tracking
- Leave History Reports
- Admin Dashboard for Approvals

## Technology Stack
- PHP 7.4+
- MySQL 5.7+
- HTML5, CSS3, JavaScript
- Bootstrap 5

## Installation Instructions

### Prerequisites
- XAMPP or similar web server with PHP and MySQL
- Web browser

### Database Setup
1. Start your MySQL server
<<<<<<< HEAD
2. Import the database schema from `database/leave_management.sql`
=======
2. Import the database schema from `database/leave_management_system.sql`
>>>>>>> ea9b2903bc8ff61d7fddf37c4f8bf75c67eb3099
3. Update database credentials in `config/database.php` if needed

### Application Setup
1. Place all files in your web server's document root (e.g., `htdocs`)
2. Ensure the web server has write permissions for the application directory

### Default Admin Credentials
- Username: `admin@example.com`
- Password: `admin123`

## Usage Instructions

### Employee Registration
- Access the application through your web browser
- Click on "Register as Employee" link
- Fill in the registration form
- Wait for admin approval

### Employee Features
- View leave balances
- Apply for leave
- View leave history
- Track application status

### Admin Features
- Approve/reject employee registrations
- Approve/reject leave requests
- View all employee leave records

## Security Features
- Password hashing
- Session management
- Input validation
- SQL injection prevention
- XSS protection

## File Structure
```
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Database/
│   ├── Models/
│   ├── Views/
├── public/
├── writable/
├── vendor/
├── README.md
```

## Support
<<<<<<< HEAD
For any issues or questions, please contact the system administrator. 
=======
For any issues or questions, please contact the system administrator. 
>>>>>>> ea9b2903bc8ff61d7fddf37c4f8bf75c67eb3099
