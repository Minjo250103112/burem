<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTicketController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::get('/adm', function () {
    return view('auth.login-admin');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', [CustomerTicketController::class, 'index'])->name('index');
    Route::post('/', [CustomerTicketController::class, 'store'])->name('store');
    Route::get('/create', [CustomerTicketController::class, 'create'])->name('create');
    Route::get('{code}', [CustomerTicketController::class, 'show'])->name('show');
    Route::get('priority/{id}/get/value', [CustomerTicketController::class, 'priority'])->name('priority');
    Route::get('/reply-ticket/{code}', [CustomerTicketController::class, 'reply'])->name('reply');
    Route::post('/reply-ticket', [CustomerTicketController::class, 'response'])->name('response');
    Route::get('/closed/{id}/finish', [CustomerTicketController::class, 'closed'])->name('closed');
});

Route::prefix('ticket-customer')->name('ticket-customer.')->group(function () {
    Route::get('/', [TicketController::class, 'index'])->name('index');
    Route::get('/new/{id}/create', [TicketController::class, 'create'])->name('create');
    Route::get('/detail/{id}', [TicketController::class, 'show'])->name('show');
    Route::get('/customer/ticket/{id}', [CustomerTicketController::class, 'show'])->name('customer.ticket.show');

});

Route::prefix('customer')->name('customer.')->group(function () {
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::post('package', [CustomerController::class, 'customerPackage'])->name('store-package');
    Route::get('package/detail/{id}', [CustomerController::class, 'custPackageShow'])->name('show-customer-package');
    Route::put('package/{id}', [CustomerController::class, 'custPackageUpdate'])->name('update-customer-package');
    Route::delete('package/{id}', [CustomerController::class, 'destroy'])->name('destroy');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::get('/detail/{id}', [CustomerController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CustomerController::class, 'edit'])->name('edit');
    Route::put('/{id}', [CustomerController::class, 'update'])->name('update');
    Route::get('reset/{id}/password/admin', [CustomerController::class, 'reset'])->name('reset');
});

Route::prefix('report')->name('report.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
});

Route::prefix('departement')->name('departement.')->group(function () {
    Route::get('/', [DepartementController::class, 'index'])->name('index');
    Route::post('/', [DepartementController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [DepartementController::class, 'show'])->name('show');
    Route::put('{id}', [DepartementController::class, 'update'])->name('update');
    Route::delete('{id}', [DepartementController::class, 'destroy'])->name('destroy');
});

Route::prefix('package')->name('package.')->group(function () {
    Route::get('/', [PackageController::class, 'index'])->name('index');
    Route::post('/', [PackageController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PackageController::class, 'show'])->name('show');
    Route::put('/{id}', [PackageController::class, 'update'])->name('update');
    Route::delete('/{id}', [PackageController::class, 'destroy'])->name('destroy');
});

Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
});

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/', [ProfileController::class, 'updateUser'])->name('user');
    Route::post('customer', [ProfileController::class, 'updateCustomer'])->name('customer');
    Route::post('update/password', [ProfileController::class, 'updatePassword'])->name('change-password');
});


require __DIR__.'/auth.php';
