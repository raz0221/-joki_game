<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JokiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/session-test', function() {
    try {
        // Cek tabel
        $tableExists = Schema::hasTable('sessions');
        
        // Coba insert data dummy
        if ($tableExists) {
            DB::table('sessions')->insert([
                'id' => 'test_session',
                'payload' => 'test',
                'last_activity' => time()
            ]);
        }
        
        // Output hasil
        return response()->json([
            'session_table_exists' => $tableExists,
            'session_count' => $tableExists ? DB::table('sessions')->count() : 0,
            'session_data' => $tableExists ? DB::table('sessions')->get() : []
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'error' => $e->getMessage(),
            'trace' => $e->getTrace()
        ], 500);
    }
});
// Authentication Routes Manual
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes Manual
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Public Routes
Route::get('/', [HomeController::class, 'welcome'])->name('welcome');
Route::get('/games', [GameController::class, 'index'])->name('games');

// Authenticated User Routes
Route::middleware(['auth'])->group(function () {
    // Profile Route untuk SEMUA USER (admin, joki, customer)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    
    // Order Routes
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
        Route::post('/{order}/confirm-payment', [OrderController::class, 'confirmPayment'])->name('orders.confirm-payment');
    });
    
    // Review Routes
    Route::get('/orders/{order}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/orders/{order}/review', [ReviewController::class, 'store'])->name('reviews.store');
    
    // Joki Dashboard Routes
    Route::prefix('joki')->group(function () {
    Route::get('dashboard', [JokiController::class, 'dashboard'])->name('joki.dashboard')->middleware(['auth',\App\Http\Middleware\RoleMiddleware::class.':joki']);
    Route::get('/orders', [JokiController::class, 'orders'])->name('joki.orders');
    Route::get('/orders/{order}', [JokiController::class, 'showOrder'])->name('joki.orders.show');
    Route::post('/orders/{order}/complete', [JokiController::class, 'completeOrder'])->name('joki.orders.complete');
});
    
    // Admin Dashboard Routes
    Route::prefix('admin')->middleware(['auth',\App\Http\Middleware\RoleMiddleware::class.':admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        // RUTE PROFILE DIHAPUS DARI SINI
        Route::get('/orders', [AdminController::class, 'manageOrders'])->name('admin.orders.index');
        Route::get('/orders/{order}', [AdminController::class, 'show'])->name('admin.orders.show');
        Route::post('/orders/{order}/assign-joki', [AdminController::class, 'assignJoki'])->name('admin.orders.assign-joki');
        Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users.index');
        Route::get('/games', [AdminController::class, 'manageGames'])->name('admin.games.index');
        Route::get('/games/create', [GameController::class, 'create'])->name('admin.games.create');
        Route::post('/games', [GameController::class, 'store'])->name('admin.games.store');
        Route::get('/games/{game}/edit', [GameController::class, 'edit'])->name('admin.games.edit');
        Route::put('/games/{game}', [GameController::class, 'update'])->name('admin.games.update');
        Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('admin.games.destroy');
    });
});

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home');