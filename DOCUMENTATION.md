# Technical Documentation

## 📋 Table of Contents

1. [Architecture Overview](#architecture-overview)
2. [Database Design](#database-design)
3. [Component Structure](#component-structure)
4. [Authentication & Authorization](#authentication--authorization)
5. [Livewire Components](#livewire-components)
6. [Export System](#export-system)
7. [Email System](#email-system)
8. [Middleware](#middleware)
9. [Testing Strategy](#testing-strategy)
10. [Deployment Guide](#deployment-guide)

## 🏗️ Architecture Overview

### Technology Stack
- **Framework**: Laravel 12 with Livewire 3
- **Database**: MySQL/SQLite with Eloquent ORM
- **Frontend**: Tailwind CSS 4, Alpine.js, Vite
- **Authentication**: Laravel Breeze with Livewire
- **Export**: Laravel Excel package
- **Testing**: Pest PHP

### Application Flow
1. **Authentication**: Users login through Livewire components
2. **Role-based Routing**: Middleware redirects based on user role
3. **Component-based UI**: Livewire handles real-time interactions
4. **Data Persistence**: Eloquent models with relationships
5. **Export/Email**: Automated reporting system

## 🗄️ Database Design

### Entity Relationship Diagram

```
users (1) -----> (many) students
users (1) -----> (many) grades (as admin)
grades (1) -----> (many) students
students (1) -----> (many) attendances
grades (1) -----> (many) attendances
```

### Table Structures

#### users
```sql
- id (primary key)
- name (string)
- email (unique)
- password (hashed)
- role (enum: 'teacher', 'admin')
- email_verified_at (timestamp)
- remember_token
- created_at, updated_at
```

#### students
```sql
- id (primary key)
- first_name (string)
- last_name (string)
- age (integer)
- grade_id (foreign key)
- created_at, updated_at
```

#### grades
```sql
- id (primary key)
- name (string)
- description (text, nullable)
- created_at, updated_at
```

#### attendances
```sql
- id (primary key)
- student_id (foreign key)
- grade_id (foreign key)
- date (date)
- status (enum: 'present', 'absent', 'sick', 'other')
- reason (text, nullable)
- created_at, updated_at
```

## 🧩 Component Structure

### Livewire Components Hierarchy

```
App\Livewire\
├── Auth\
│   ├── Login.php
│   ├── Register.php
│   ├── ForgotPassword.php
│   ├── ResetPassword.php
│   ├── ConfirmPassword.php
│   └── VerifyEmail.php
├── Admin\
│   ├── AdminDashboard.php
│   └── ExportReport.php
├── Teacher\
│   ├── Attendance\
│   │   └── AttendancePage.php
│   ├── Students\
│   │   ├── StudentList.php
│   │   ├── AddStudent.php
│   │   └── EditStudent.php
│   └── Grades\
│       ├── GradeList.php
│       ├── AddGrade.php
│       └── EditGrade.php
└── Settings\
    ├── Profile.php
    ├── Password.php
    ├── Appearance.php
    └── DeleteUserForm.php
```

### Key Component Details

#### AttendancePage Component
- **Purpose**: Main attendance tracking interface
- **Features**: 
  - Date range selection
  - Grade filtering
  - Real-time attendance marking
  - Bulk operations
  - Excel export
- **Methods**:
  - `fetchStudents()`: Load students for selected grade
  - `updateAttendance()`: Mark individual attendance
  - `markAll()`: Bulk mark all students
  - `exportToExcel()`: Generate Excel report

#### StudentList Component
- **Purpose**: Admin interface for student management
- **Features**:
  - Paginated student listing
  - Search and filter
  - CRUD operations
  - Grade assignments
- **Methods**:
  - `delete()`: Remove student
  - `previousPage()`: Pagination
  - `nextPage()`: Pagination
  - `gotoPage()`: Direct page navigation

## 🔐 Authentication & Authorization

### User Roles
- **Teacher**: Can mark attendance, view students, manage grades
- **Admin**: Full system access including user management

### Middleware Implementation

#### AdminMiddleware
```php
public function handle(Request $request, Closure $next): Response
{
    if (Auth::user() && Auth::user()->role != 'admin') {
        return redirect()->route('teacher.dashboard');
    }
    return $next($request);
}
```

#### TeacherMiddleware
```php
public function handle(Request $request, Closure $next): Response
{
    if (Auth::user() && Auth::user()->role != 'teacher') {
        return redirect()->route('admin.dashboard');
    }
    return $next($request);
}
```

### Route Protection
```php
// Admin routes
Route::middleware(['admin','auth'])->group(function(){
    Route::get('/admin/dashboard', AdminDashboard::class);
    Route::get('/student-list', StudentList::class);
    // ... other admin routes
});

// Teacher routes
Route::middleware(['auth', 'verified', 'teacher'])->group(function(){
    Route::get('/dashboard', 'dashboard');
    Route::get('/attendance', AttendancePage::class);
});
```

## 📊 Export System

### Excel Export Implementation

#### AttendanceExport Class
```php
class AttendanceExport implements FromCollection, WithMapping, WithHeadings
{
    protected $year, $month, $grade;

    public function collection()
    {
        return Attendance::whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->whereHas('student', function($query){
                $query->where('grade_id', $this->grade);
            })->get();
    }

    public function map($row): array
    {
        return [
            $row->student->first_name . ' ' . $row->student->last_name,
            $row->date,
            ucfirst($row->status),
            $row->reason
        ];
    }
}
```

### Automated Reporting

#### SendAttendanceReportCommand
```php
class SendAttendanceReportCommand extends Command
{
    protected $signature = 'attendance:send-report {type}';
    
    public function handle()
    {
        $type = $this->argument('type');
        // Generate report based on type (daily/weekly)
        // Export to Excel
        // Send via email
    }
}
```

## 📧 Email System

### Mail Classes

#### SendAttendanceReportMail
```php
class SendAttendanceReportMail extends Mailable
{
    public $period;
    public $filePath;

    public function build()
    {
        return $this->markdown('mail.reports.attendance-report')
                    ->with([
                        'period' => $this->period,
                        'downloadUrl' => asset('storage/' . $this->filePath),
                    ])
                    ->attach(asset('storage/' . $this->filePath));
    }
}
```

### Email Templates
- **Location**: `resources/views/mail/reports/attendance-report.blade.php`
- **Features**: Markdown formatting, file attachments
- **Content**: Attendance summary with download links

## 🔧 Middleware

### Custom Middleware

#### AdminMiddleware
- **Purpose**: Restrict access to admin-only routes
- **Logic**: Check user role and redirect if not admin
- **Usage**: Applied to admin dashboard and management routes

#### TeacherMiddleware
- **Purpose**: Restrict access to teacher-only routes
- **Logic**: Check user role and redirect if not teacher
- **Usage**: Applied to attendance and teacher dashboard routes

### Registration
```php
// app/Http/Kernel.php
protected $middlewareAliases = [
    'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'teacher' => \App\Http\Middleware\TeacherMiddleware::class,
];
```

## 🧪 Testing Strategy

### Test Structure
```
tests/
├── Feature/
│   ├── Auth/
│   │   ├── AuthenticationTest.php
│   │   ├── EmailVerificationTest.php
│   │   ├── PasswordConfirmationTest.php
│   │   ├── PasswordResetTest.php
│   │   └── RegistrationTest.php
│   ├── DashboardTest.php
│   └── Settings/
│       ├── PasswordUpdateTest.php
│       └── ProfileUpdateTest.php
└── Unit/
    └── ExampleTest.php
```

### Testing Commands
```bash
# Run all tests
php artisan test

# Run specific test file
php artisan test tests/Feature/Auth/AuthenticationTest.php

# Run with coverage
php artisan test --coverage
```

## 🚀 Deployment Guide

### Production Environment Setup

#### 1. Server Requirements
- PHP 8.2+
- MySQL 8.0+ or PostgreSQL
- Composer
- Node.js (for asset building)
- Web server (Apache/Nginx)

#### 2. Environment Configuration
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=attendance_db
DB_USERNAME=your_username
DB_PASSWORD=your_password

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
```

#### 3. Deployment Steps
```bash
# 1. Clone repository
git clone <repository-url>
cd student-attendance-tracking-app

# 2. Install dependencies
composer install --optimize-autoloader --no-dev
npm install
npm run build

# 3. Environment setup
cp .env.example .env
php artisan key:generate

# 4. Database setup
php artisan migrate --force
php artisan db:seed

# 5. Storage setup
php artisan storage:link

# 6. Cache optimization
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 7. Set permissions
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

#### 4. Cron Jobs
```bash
# Add to crontab
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

#### 5. Web Server Configuration

##### Apache (.htaccess)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

##### Nginx
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path-to-your-project/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 📈 Performance Optimizations

### Database Optimizations
- **Indexing**: Foreign keys and frequently queried columns
- **Eager Loading**: Prevent N+1 queries with relationships
- **Query Caching**: Cache frequently accessed data

### Application Optimizations
- **Route Caching**: `php artisan route:cache`
- **Config Caching**: `php artisan config:cache`
- **View Caching**: `php artisan view:cache`
- **Asset Optimization**: Vite build with minification

### Monitoring
- **Laravel Telescope**: Debug and monitor application
- **Laravel Horizon**: Monitor Redis queues
- **Log Analysis**: Monitor application logs

## 🔒 Security Considerations

### Input Validation
- **Form Requests**: Validate all user inputs
- **Sanitization**: Clean data before database storage
- **CSRF Protection**: All forms include CSRF tokens

### Authentication Security
- **Password Hashing**: Laravel's built-in hashing
- **Session Security**: Secure session configuration
- **Rate Limiting**: Prevent brute force attacks

### Database Security
- **SQL Injection Prevention**: Eloquent ORM protection
- **Prepared Statements**: Automatic parameter binding
- **Access Control**: Role-based database access

## 📚 Additional Resources

### Documentation Links
- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

### Development Tools
- **Laravel Pail**: Development and debugging
- **Laravel Pint**: Code styling
- **Pest PHP**: Testing framework

---

**Last Updated**: March 2025  
**Version**: 1.0.0 