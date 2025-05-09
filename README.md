# Employee Leave Management System

A web-based system for managing employee leave requests, approvals and balances. It is built using CodeIgniter 4 (PHP framework), MySQL, Bootstrap 5, and standard web technologies.


## Features
- User Registration & Activation (admin approval required)
- Leave Request Management (admin controls leave approval/reject)
- Leave Balance Tracking
- Leave History Reports
- Admin Dashboard for Approvals
- View-Modify user profiles and password (controls only by admin)

## Technology Stack
- Framework: CodeIgniter 4
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
2. Import the database schema from `app/database/leave_management_system.sql`
3. Update database credentials in the `.env` file if needed.

### Application Setup / Usage Instructions
1. Place all files in your web server's document root (e.g., `htdocs`)
2. Ensure the web server has write permissions for the application directory
3. Run `composer install` in the project directory to install dependencies:
     ```bash
     composer install
     ```
4. Ensure the `writable/` directory has write permissions.
5. **Start the Web Server**:
   - Start Apache and MySQL from the XAMPP control panel.
   - Access the application in your browser at:
     ```
     http://localhost/leave-management-system-ci/public
     ```

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
- Edit employee details or reset new password

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
For any issues or questions, please contact Leishangthem Michael Meitei. 
