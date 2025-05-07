# Employee Leave Management System

A web-based system for managing employee leave requests and approvals.

## Features
- User Registration & Activation (admin approval required)
- Leave Request Management
- Leave Balance Tracking
- Leave History Reports
- Admin Dashboard for Approvals

## Technology Stack
- PHP 8.1+
- MySQL 5.7+
- HTML5, CSS3, JavaScript
- Bootstrap 5

## Installation Instructions

### Prerequisites
- XAMPP or similar web server with PHP and MySQL
- Web browser
- Composer (PHP dependency manager)
  - Download and install from [https://getcomposer.org/download](https://getcomposer.org/download)
  - After installation, open cmd and type `composer` to verify installation
  - Configure PHP: Open `C:\xampp\php\php.ini` and uncomment `;extension=intl` (it should look like `extension=intl`). This is usually found near line 934.
  - Verify intl extension: Open PowerShell and run `php -m | Select-String intl`. If properly configured, 'intl' will be displayed.
  - Note: A system reboot/restart is recommended after this configuration to ensure changes take effect.

### Database Setup
1. Start your MySQL server
2. Import the database schema from `database/leave_management_system.sql`
3. Update database credentials in the `.env` file if needed.

### Application Setup
1. Place all files in your web server's document root (e.g., `htdocs`)
2. Ensure the web server has write permissions for the application directory

### Default Admin Credentials
- Username: `admin@example.com`
- Password: `admin123`

### Some Users Credentials
- Username -      - Password -  - Status -

- test@gmail.com      `test123`       `Activated`
- test1@gmail.com     `test123`       `Activated`
- test2@gmail.com     `test123`       `Activated`
- test3@gmail.com     `test123`       `Activated` 
- test4@gmail.com     `test123`       `DeActivated` 
- test5@gmail.com     `test123`       `DeActivated` 
...
...


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
For any issues or questions, please contact the system administrator. 
