# Posho Mill System - Laravel Edition

This is the Laravel migration of the Posho Mill Management System. It has been converted from a custom PHP framework to a professional Laravel framework.

## What's Changed

- **Custom Framework → Laravel 11**: Professional MVC framework with built-in features
- **Custom Router → Laravel Routing**: Cleaner, more maintainable routing
- **Custom ORM → Eloquent**: Powerful, expressive database query builder
- **Custom Middleware → Laravel Middleware**: Standard middleware stack
- **Database Migrations**: Version-controlled database changes
- **Authentication**: Built-in Laravel authentication system
- **Validation**: Powerful built-in validation
- **Error Handling**: Professional error and exception handling

## Installation

### Prerequisites
- PHP 8.2 or higher
- MySQL 5.7 or higher (or MariaDB equivalent)
- Composer

### Setup Steps

1. **Install Dependencies**
   ```bash
   cd posho_mill_laravel
   composer install
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   ```
   Edit `.env` and configure:
   - `APP_KEY` - Run: `php artisan key:generate`
   - `DB_DATABASE` - Set to `posho_mill`
   - `DB_USERNAME` - Your MySQL user (usually `root`)
   - `DB_PASSWORD` - Your MySQL password

3. **Create Database**
   ```bash
   mysql -u root -p
   CREATE DATABASE posho_mill CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   EXIT;
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```
   Access at: `http://localhost:8000`

## Default Credentials

| Username | Email | Password | Role |
|----------|-------|----------|------|
| admin | admin@poshomill.com | admin123 | admin |
| manager | manager@poshomill.com | admin123 | manager |
| operator | operator@poshomill.com | admin123 | operator |

⚠️ **Change these passwords immediately in production!**

## Key Features

- ✅ User Authentication & Authorization
- ✅ Role-Based Access Control (Admin, Manager, Operator)
- ✅ Sales Management
- ✅ Stock Management
- ✅ Customer Tracking
- ✅ Financial Reports
- ✅ Activity Logging
- ✅ Receipt Management
- ✅ System Settings
- ✅ Notifications

## Project Structure

```
posho_mill_laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Request handlers
│   │   └── Middleware/      # Route middleware
│   ├── Models/              # Eloquent models
│   └── Services/            # Business logic (optional)
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/             # Sample data
├── routes/
│   └── web.php              # Web routes
├── resources/
│   └── views/               # Blade templates
├── config/                  # Configuration files
├── storage/                 # Logs, cache, uploads
├── public/                  # Web root
└── composer.json            # Dependencies
```

## Common Commands

```bash
# Create new controller
php artisan make:controller ControllerName

# Create new model with migration
php artisan make:model ModelName -m

# Create migration
php artisan make:migration migration_name

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Fresh database
php artisan migrate:fresh

# Tinker (interactive shell)
php artisan tinker

# Clear cache
php artisan cache:clear
php artisan config:cache
```

## Migration Notes

The system has been migrated with the following mapping:

| Custom Framework | Laravel |
|------------------|---------|
| Custom Router | Laravel Router (`routes/web.php`) |
| Custom Model | Eloquent Models (`app/Models/`) |
| Custom Controller | Laravel Controllers (`app/Http/Controllers/`) |
| Custom Middleware | Laravel Middleware (`app/Http/Middleware/`) |
| Direct Database | Migrations + Seeders |

## Next Steps

1. Create Blade views in `resources/views/`
2. Configure mail/SMTP if needed
3. Set up file storage for receipts
4. Add API routes in `routes/api.php` (optional)
5. Configure queues for background jobs (optional)
6. Set up proper logging

## Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Templating](https://laravel.com/docs/blade)
- [Routing](https://laravel.com/docs/routing)

## Support

For issues or questions, refer to the Laravel documentation or check the migration guide in the parent directory.

---

**Last Updated**: February 2, 2026
**Framework Version**: Laravel 11.x
