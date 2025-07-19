# Student Attendance Tracking Application

A modern, feature-rich Laravel Livewire application for managing student attendance, grades, and administrative tasks. Built with Laravel 12, Livewire 3, and Tailwind CSS.

## 🚀 Features

### Core Functionality
- **Student Management**: Add, edit, and delete student records with grade assignments
- **Attendance Tracking**: Real-time attendance marking with multiple status options (present, absent, sick, other)
- **Grade Management**: Comprehensive grade system with CRUD operations
- **Role-Based Access**: Separate interfaces for teachers and administrators
- **Export Capabilities**: Excel export for attendance reports
- **Automated Reporting**: Scheduled email reports (daily/weekly)
- **Modern UI**: Beautiful, responsive interface with Tailwind CSS

### User Roles
- **Teacher**: Mark attendance, view student lists, manage grades
- **Admin**: Full system access including student/grade management

## 🛠️ Technology Stack

### Backend
- **Laravel 12**: PHP framework
- **Livewire 3**: Real-time reactive components
- **MySQL/SQLite**: Database
- **Laravel Excel**: Excel export functionality
- **Carbon**: Date/time manipulation

### Frontend
- **Tailwind CSS 4**: Utility-first CSS framework
- **Alpine.js**: Lightweight JavaScript framework
- **Vite**: Build tool
- **Preline**: UI component library
- **Vanilla Calendar Pro**: Calendar component

### Additional Tools
- **Pest**: Testing framework
- **Laravel Pail**: Development tools
- **Laravel Pint**: Code styling

## 📁 Project Structure

```
student-attendance-tracking-app/
├── app/
│   ├── Console/Commands/          # Artisan commands
│   ├── Exports/                   # Excel export classes
│   ├── Http/
│   │   ├── Controllers/           # Traditional controllers
│   │   └── Middleware/            # Custom middleware
│   ├── Livewire/                  # Livewire components
│   │   ├── Admin/                 # Admin components
│   │   ├── Auth/                  # Authentication components
│   │   ├── Settings/              # User settings
│   │   └── Teacher/               # Teacher components
│   ├── Mail/                      # Email classes
│   └── Models/                    # Eloquent models
├── database/
│   ├── factories/                 # Model factories
│   ├── migrations/                # Database migrations
│   └── seeders/                   # Database seeders
├── resources/
│   └── views/
│       ├── components/            # Blade components
│       ├── livewire/              # Livewire views
│       └── mail/                  # Email templates
└── routes/                        # Application routes
```

## 🗄️ Database Schema

### Core Tables
- **users**: User authentication and roles
- **students**: Student information with grade relationships
- **grades**: Grade/class definitions
- **subjects**: Subject definitions
- **attendances**: Daily attendance records

### Key Relationships
- Students belong to Grades
- Attendances belong to Students and Grades
- Users have roles (teacher/admin)

## 🚀 Installation

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & npm
- MySQL/SQLite

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd student-attendance-tracking-app
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## 🔧 Configuration

### Environment Variables
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=attendance_db
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Scheduled Tasks
Add to your crontab for automated reports:
```bash
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## 📋 Usage

### Teacher Interface
1. **Login** with teacher credentials
2. **Navigate to Attendance** page
3. **Select** year, month, and grade
4. **Mark attendance** for each student
5. **Export reports** as needed

### Admin Interface
1. **Login** with admin credentials
2. **Manage students** (create, edit, delete)
3. **Manage grades** (create, edit, delete)
4. **View attendance reports**
5. **Access admin dashboard**

### Key Features

#### Attendance Marking
- Select date range and grade
- Mark individual student attendance
- Bulk mark all students
- Multiple status options (present, absent, sick, other)

#### Export Functionality
- Excel export with detailed formatting
- Automated email reports
- Custom date ranges

#### User Management
- Role-based access control
- Profile management
- Password updates

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📊 API Endpoints

### Authentication Routes
- `GET /login` - Login page
- `POST /login` - Authenticate user
- `GET /register` - Registration page
- `POST /register` - Create new account

### Teacher Routes
- `GET /attendance` - Attendance page
- `GET /dashboard` - Teacher dashboard

### Admin Routes
- `GET /admin/dashboard` - Admin dashboard
- `GET /student-list` - Student management
- `GET /create/student` - Add student
- `GET /edit/student/{id}` - Edit student
- `GET /grade/list` - Grade management
- `GET /grade/create` - Add grade
- `GET /grade/edit/{id}` - Edit grade

## 🔒 Security Features

- **Role-based middleware** for route protection
- **CSRF protection** on all forms
- **Input validation** on all user inputs
- **SQL injection prevention** through Eloquent ORM
- **XSS protection** through Blade templating

## 📈 Performance Optimizations

- **Laravel caching** for database queries
- **Eager loading** to prevent N+1 queries
- **Pagination** for large datasets
- **Asset optimization** with Vite
- **Database indexing** on foreign keys

## 🚀 Deployment

### Production Checklist
- [ ] Set `APP_ENV=production`
- [ ] Configure database credentials
- [ ] Set up email configuration
- [ ] Configure file storage
- [ ] Set up SSL certificate
- [ ] Configure web server (Apache/Nginx)
- [ ] Set up cron jobs for scheduled tasks

### Server Requirements
- PHP 8.2+
- MySQL 8.0+ or PostgreSQL
- Composer
- Node.js (for asset building)

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## 📝 License

This project is licensed under the MIT License.

## 👥 Authors

- **Your Name** - Initial work

## 🙏 Acknowledgments

- Laravel team for the excellent framework
- Livewire team for reactive components
- Tailwind CSS for the utility-first approach

## 📞 Support

For support, email support@example.com or create an issue in the repository.

---

**Version**: 1.0.0  
**Last Updated**: March 2025 