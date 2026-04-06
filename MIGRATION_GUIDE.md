# Laravel Migration Guide

This document explains how to use the new Laravel version and how it differs from the old custom framework.

## Directory Structure Comparison

### Old Custom Framework
```
posho_mill_system/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Routes/
│   └── Core/
├── database/
│   └── migrations/
└── public/
```

### New Laravel Framework
```
posho_mill_laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
├── resources/views/
├── config/
└── public/
```

## Key Differences

### 1. Routing

**OLD WAY (Custom Framework)**
```php
// app/Routes/web.php
$router->get('/sales', 'SaleController@index');
$router->post('/sales', 'SaleController@store');
```

**NEW WAY (Laravel)**
```php
// routes/web.php
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

// With middleware
Route::middleware('auth')->group(function () {
    Route::get('/sales', [SaleController::class, 'index']);
});

// With role checks
Route::middleware('role:admin')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
});
```

### 2. Controllers

**OLD WAY**
```php
class SaleController extends Controller {
    public function index() {
        $sales = $this->queryBuilder->table('sales')->get();
        return $this->render('sales/index', ['sales' => $sales]);
    }
}
```

**NEW WAY (Laravel)**
```php
class SaleController extends Controller {
    public function index() {
        $sales = Sale::latest()->paginate(15);
        return view('sales.index', compact('sales'));
    }
}
```

### 3. Models & Database Queries

**OLD WAY (Custom ORM)**
```php
class Sale extends Model {
    public function getAll() {
        return $this->findAll();
    }
}

// Usage
$sales = (new Sale)->getAll();
```

**NEW WAY (Eloquent)**
```php
class Sale extends Model {
    // No methods needed - Eloquent provides them automatically
}

// Usage
$sales = Sale::all();
$sales = Sale::where('status', 'paid')->get();
$sales = Sale::latest()->paginate(15);
$sales = Sale::with('customer', 'processedBy')->get();
```

### 4. Authentication

**OLD WAY**
```php
// Custom auth check
if ($this->isAuthenticated()) {
    $user = $this->getAuthUser();
}
```

**NEW WAY (Laravel)**
```php
// Using Auth facade
if (Auth::check()) {
    $user = Auth::user();
    $username = Auth::user()->username;
}

// In middleware
Route::middleware('auth')->group(function () {
    // Only authenticated users
});

// In controllers
public function store(Request $request) {
    $userId = auth()->id();
}
```

### 5. Validation

**OLD WAY**
```php
if (empty($data['name'])) {
    $errors[] = 'Name is required';
}
if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email';
}
```

**NEW WAY (Laravel)**
```php
$validated = $request->validate([
    'name' => 'required|string|max:100',
    'email' => 'required|email',
    'quantity' => 'required|numeric|min:0.01',
]);

// Validation errors automatically returned as JSON or flash
```

### 6. Eloquent Relationships

**NEW WAY (Much cleaner!)**
```php
class Sale extends Model {
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
    
    public function processedBy() {
        return $this->belongsTo(User::class, 'processed_by');
    }
}

// Usage
$sale = Sale::with('customer', 'processedBy')->find(1);
echo $sale->customer->name;
echo $sale->processedBy->full_name;
```

### 7. Database Migrations

**NEW WAY (Version Control)**
```bash
# Create migration
php artisan make:migration create_sales_table

# Run all pending migrations
php artisan migrate

# Rollback last batch
php artisan migrate:rollback

# Reset everything
php artisan migrate:fresh
```

### 8. Views/Templates

**OLD WAY**
```php
// Manual view rendering
return $this->render('sales/index', ['data' => $sales]);
```

**NEW WAY (Laravel Blade)**
```php
// Simple and clean
return view('sales.index', compact('sales'));

// In Blade template (resources/views/sales/index.blade.php)
@foreach ($sales as $sale)
    <div>{{ $sale->customer_name }}</div>
@endforeach

@if (auth()->user()->isAdmin())
    <button>Delete</button>
@endif
```

### 9. Request Handling

**OLD WAY**
```php
$input = $this->request->input('email');
$post = $_POST['name'] ?? null;
```

**NEW WAY (Laravel)**
```php
$email = $request->input('email');
$email = $request->email; // Direct property access
$all = $request->all();
$only = $request->only(['name', 'email']);
$except = $request->except('_token');
```

### 10. Session/Redirect

**OLD WAY**
```php
$_SESSION['success'] = 'Sale saved';
header('Location: /sales');
```

**NEW WAY (Laravel)**
```php
return redirect()->route('sales.index')->with('success', 'Sale saved');
return back()->withErrors(['email' => 'Invalid']);
return redirect('/dashboard')->with(['success' => 'Done', 'warning' => 'Low stock']);
```

## URL Generation

**OLD WAY**
```php
<a href="/sales/<?php echo $sale->id; ?>">View</a>
```

**NEW WAY (Laravel Named Routes)**
```php
<a href="{{ route('sales.show', $sale) }}">View</a>
<a href="{{ route('customers.edit', ['customer' => $customer->id]) }}">Edit</a>
<form action="{{ route('sales.store') }}" method="POST">
    @csrf
    <!-- form fields -->
</form>
```

## Helper Functions

**NEW WAY (Laravel)**
```php
// Route URL generation
route('sales.show', $sale)
url('/dashboard')
redirect()->route('sales.index')

// Authentication
auth() or auth()->user()
Auth::check()

// View helpers
view('sales.index')
redirect()->back()
session()->put('key', 'value')

// Request helpers
request()->input('name')
request()->all()

// DateTime
now() or Carbon::now()
today()

// String helpers
str('hello')->upper() // HELLO
Str::slug('Hello World') // hello-world

// Array helpers
collect($array)->map() // Collection
```

## Database Query Examples

```php
// Fetch
$sales = Sale::all();
$sale = Sale::find(1);
$sales = Sale::where('status', 'paid')->get();

// Relations
$sales = Sale::with('customer', 'processedBy')->get();
$sales = Sale::where('sale_date', today())->with('receipt')->get();

// Aggregates
$total = Sale::sum('final_amount');
$count = Sale::count();
$avg = Sale::avg('final_amount');

// Pagination
$sales = Sale::paginate(15); // Shows next/prev links automatically
$sales = Sale::simplePaginate(15); // Simple prev/next

// Create
$sale = Sale::create([
    'sale_number' => 'SAL-001',
    'customer_name' => 'John',
    'final_amount' => 1000,
]);

// Update
$sale->update(['status' => 'completed']);
Sale::where('status', 'pending')->update(['status' => 'completed']);

// Delete
$sale->delete();
Sale::where('status', 'cancelled')->delete();
```

## File Organization

### Controllers
Place in `app/Http/Controllers/`
- DashboardController
- SaleController
- StockController
- CustomerController
- etc.

### Models
Place in `app/Models/`
- User
- Sale
- Customer
- Stock
- etc.

### Views
Place in `resources/views/`
```
resources/views/
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
├── sales/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── show.blade.php
├── customers/
└── stock/
```

### Migrations
Place in `database/migrations/`
- 2024_01_01_000001_create_users_table.php
- 2024_01_01_000002_create_customers_table.php
- etc.

## Common Artisan Commands

```bash
# Generators
php artisan make:controller UserController
php artisan make:model Sale -m  # with migration
php artisan make:middleware RoleMiddleware
php artisan make:request StoreUserRequest

# Database
php artisan migrate
php artisan migrate:rollback
php artisan migrate:fresh
php artisan tinker

# Cache/Config
php artisan cache:clear
php artisan config:cache
php artisan route:list

# Server
php artisan serve
php artisan serve --port=8001
```

## Benefits of Laravel

1. ✅ **Eloquent ORM** - No more manual SQL queries
2. ✅ **Built-in Authentication** - Secure, tested auth system
3. ✅ **Validation** - Powerful, reusable validation rules
4. ✅ **Migrations** - Database version control
5. ✅ **Routing** - Named routes, route groups, middleware
6. ✅ **Blade Templates** - Cleaner, more secure templating
7. ✅ **Middleware** - Request/response filtering
8. ✅ **Services** - Dependency injection, service container
9. ✅ **Testing** - Built-in testing framework
10. ✅ **Community** - Huge ecosystem of packages

## Next Steps

1. Start viewing Blade templates in `resources/views/`
2. Run `php artisan migrate` to create database tables
3. Start the server with `php artisan serve`
4. Learn about Eloquent relationships (very powerful!)
5. Explore Laravel's testing capabilities

## Troubleshooting

**Migrations not running?**
```bash
php artisan migrate --path=database/migrations
php artisan migrate:fresh # Reset everything
```

**Controllers not found?**
```bash
composer dump-autoload
```

**Database connection error?**
```bash
# Check .env file
DB_HOST=127.0.0.1
DB_DATABASE=posho_mill
DB_USERNAME=root
```

---

For more detailed information, visit [laravel.com/docs](https://laravel.com/docs)
