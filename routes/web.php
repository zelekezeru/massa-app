<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesLocationController;
use App\Http\Controllers\SalesAgentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\NurseryController;
use App\Http\Controllers\CropController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CropCategoryController;
use App\Http\Controllers\SeedlingController;
use App\Http\Controllers\SupplierController;
use Illuminate\Foundation\Application;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\SeedController;
use App\Models\Company;

require __DIR__.'/auth.php';
require __DIR__.'/lang.php';

Route::get('/', function () {
    return Inertia::render('Index', [
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register.store');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest');

Route::resource('contacts', ContactController::class);

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes with permissions (example, adjust as needed)
    Route::resource('sales', SalesController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('customer-types', CustomerTypeController::class);
    Route::resource('products', ProductController::class);
    Route::resource('sales-locations', SalesLocationController::class);
    Route::resource('sales-agents', SalesAgentController::class);
    Route::resource('nurseries', NurseryController::class);
    Route::resource('crops', CropController::class);
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('crop-categories', CropCategoryController::class);
    Route::resource('seeds', SeedController::class);

    // Role/Permission assignment routes (optional, example)
    Route::get('/roles/{role}/permissions', [RoleController::class, 'assign'])->middleware('can:assign-permissions-roles')->name('roles.permissions');
    Route::put('/roles/{role}/permissions', [RoleController::class, 'attach'])->middleware('can:attach-permissions-roles')->name('roles.attach');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'detach'])->middleware('can:detach-permissions-roles')->name('roles.detach');
});
Route::post('/language/switch', function () {
    $lang = request('lang');
    session(['locale' => $lang]);
    app()->setLocale($lang);

    if(auth()->check()) {
        auth()->user()->update(['language' => $lang]);
    }

    return back();
});
