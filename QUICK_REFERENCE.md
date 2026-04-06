# Laravel Migration - Quick Reference

## 🚀 Quick Start (5 Minutes)

```bash
# 1. Navigate to project
cd "c:\xampp\htdocs\posho mili project\posho_mill_laravel"

# 2. Install dependencies (first time only)
C:\xampp\php\php.exe composer.phar install

# 3. Setup environment
copy .env.example .env
C:\xampp\php\php.exe artisan key:generate

# 4. Configure database in .env
# Set: DB_DATABASE=posho_mill, DB_USERNAME=root, DB_PASSWORD=

# 5. Run migrations
C:\xampp\php\php.exe artisan migrate

# 6. Start server
C:\xampp\php\php.exe artisan serve

# 7. Open browser
# http://localhost:8000
# Login: admin@poshomill.com / admin123
```

---

## 📁 File Organization

| Task | Location |
|------|----------|
| Add route | `routes/web.php` |
| Create controller | `app/Http/Controllers/` |
| Add model | `app/Models/` |
| Create view | `resources/views/` |
| Add migration | `database/migrations/` |
| Configure app | `config/` |

---

## 🔑 Most Used Commands

```bash
# Start server
php artisan serve

# Database operations
php artisan migrate               # Run migrations
php artisan migrate:rollback      # Undo last migration
php artisan migrate:fresh         # Reset database

# Generate files
php artisan make:controller NameController
php artisan make:model ModelName -m  # With migration
php artisan make:migration table_name

# Debugging
php artisan route:list            # Show all routes
php artisan tinker                # Interactive shell
php artisan cache:clear           # Clear cache
```

---

## 💻 Code Examples

### Controller (Create)
```php
// app/Http/Controllers/SaleController.php
public function store(Request $request) {
    $validated = $request->validate([
        'quantity' => 'required|numeric',
        'customer_name' => 'required|string',
    ]);

    $sale = Sale::create($validated);
    return redirect()->route('sales.show', $sale);
}
```

### Model (Query)
```php
// Get all with relationships
$sales = Sale::with('customer', 'processedBy')->get();

// Search and filter
$sales = Sale::where('status', 'paid')
    ->latest()
    ->paginate(15);

// Aggregates
$total = Sale::sum('final_amount');
$count = Sale::count();
```

### Route
```php
// routes/web.php
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

// With middleware
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
});

// Admin only
Route::middleware('role:admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});
```

### View (Blade)
```blade
<!-- resources/views/sales/index.blade.php -->
@extends('layouts.app')

@section('content')
<h2>Sales</h2>

@forelse ($sales as $sale)
    <div class="card">
        <p>{{ $sale->customer_name }}</p>
        <p>KSh {{ number_format($sale->final_amount, 2) }}</p>
    </div>
@empty
    <p>No sales found</p>
@endforelse
@endsection
```

### Migration (Schema)
```php
// database/migrations/2024_01_01_000005_create_sales_table.php
Schema::create('sales', function (Blueprint $table) {
    $table->id();
    $table->string('sale_number')->unique();
    $table->foreignId('customer_id')->constrained();
    $table->decimal('final_amount', 10, 2);
    $table->timestamps();
});
```

---

## 🔐 Authentication

### Check if logged in
```php
if (Auth::check()) {
    echo Auth::user()->email;
}

// In routes
Route::middleware('auth')->group(function () { ... });
```

### Check role
```php
if (Auth::user()->isAdmin()) { ... }
if (Auth::user()->hasRole('manager')) { ... }
```

### In Blade template
```blade
@if (Auth::check())
    Welcome, {{ Auth::user()->full_name }}
@else
    Please login
@endif

@admin
    <!-- Only admins see this -->
@endadmin
```

---

## 🗄️ Eloquent Relationships

### Define (in Model)
```php
// One-to-Many
class User extends Model {
    public function sales() {
        return $this->hasMany(Sale::class);
    }
}

// Belongs-To
class Sale extends Model {
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
```

### Query (in Controller)
```php
$user = User::with('sales')->find(1);      // Load relations
$sales = $user->sales;                      // Access relation
$customer = $sale->customer->name;          // Access related data
```

---

## ✅ Validation

```php
$validated = $request->validate([
    'email' => 'required|email|unique:users',
    'password' => 'required|string|min:8|confirmed',
    'quantity' => 'required|numeric|min:0.01|max:1000',
    'date' => 'required|date|after:today',
    'status' => 'required|in:active,inactive,pending',
]);
```

Common rules:
- `required` - Field is required
- `email` - Valid email format
- `numeric` - Number value
- `min:X` - Minimum value/length
- `max:X` - Maximum value/length
- `unique:table` - Unique in database
- `exists:table,column` - Must exist in database
- `confirmed` - Matches `{field}_confirmation`
- `in:value1,value2` - One of values
- `date` - Valid date format

---

## 🎯 Helpful Functions

```php
// URLs
route('sales.show', $sale)           // Generate route URL
url('/dashboard')                     // Generate URL
redirect()->route('sales.index')      // Redirect to route
redirect('/dashboard')                // Redirect to path
back()                                // Redirect to previous

// Auth
auth()->user()                        // Get logged-in user
auth()->id()                          // Get user ID
auth()->check()                       // Is logged in?

// Request
$request->input('name')               // Get input
$request->all()                       // Get all inputs
$request->only(['name', 'email'])     // Get specific
$request->except('_token')            // Exclude some

// DateTime
now()                                 // Current datetime
today()                               // Current date
now()->addDays(7)                     // Add time

// Collections
collect([1, 2, 3])->map()             // Transform
collect($array)->where('id', 1)       // Filter
collect($array)->sortBy('name')       // Sort
```

---

## 🐛 Debugging

```php
// In controller/model
dd($variable);                    // Dump and die
var_dump($variable);              // Print variable
logger()->info('message');        // Write to log

// In Blade
@dump($variable)                  // Dump in view
```

View logs:
```bash
# Watch logs in real-time
tail -f storage/logs/laravel.log
```

---

## 📊 Key Files to Modify

1. **Add routes** → `routes/web.php`
2. **Create controllers** → `app/Http/Controllers/*.php`
3. **Add models** → `app/Models/*.php`
4. **Create views** → `resources/views/*.blade.php`
5. **Database changes** → `database/migrations/*.php`
6. **Configuration** → `config/*.php`

---

## 🔗 Useful Links

- **Laravel Docs**: https://laravel.com/docs
- **Eloquent Guide**: https://laravel.com/docs/eloquent
- **Blade Syntax**: https://laravel.com/docs/blade
- **Validation Rules**: https://laravel.com/docs/validation
- **Routing Guide**: https://laravel.com/docs/routing

---

## 🚨 Common Mistakes

❌ Hardcoding URLs → Use `route('name')`
❌ Manual SQL → Use Eloquent models
❌ Skipping validation → Always validate user input
❌ Not using migrations → Database changes must be versioned
❌ Mixing business logic in controllers → Use services/models

---

## 📝 Project Details

- **Framework**: Laravel 11
- **PHP Version**: 8.2+
- **Database**: MySQL
- **Authentication**: Built-in Laravel Auth
- **Styling**: Bootstrap 5

---

Last Updated: February 2, 2026
