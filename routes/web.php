<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin Dashboard & Management Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/users', [ReportController::class, 'users'])->name('reports.users');
    });
    
    // Products Management
    Route::resource('products', ProductController::class);
    Route::patch('products/{product}/stock', [ProductController::class, 'updateStock'])->name('products.updateStock');
    Route::patch('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');
    
    // Orders Management
    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
    Route::patch('orders/{order}/notes', [OrderController::class, 'addNotes'])->name('orders.addNotes');
    Route::post('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('orders/{order}/invoice', [OrderController::class, 'printInvoice'])->name('orders.invoice');
    Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
    
    // Articles Management
    Route::resource('articles', ArticleController::class);
    Route::post('articles/{article}/publish', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::post('articles/{article}/unpublish', [ArticleController::class, 'unpublish'])->name('articles.unpublish');
    
    // FAQ Management
    Route::resource('faqs', FaqController::class);
    Route::patch('faqs/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faqs.toggleStatus');
    Route::post('faqs/reorder', [FaqController::class, 'reorder'])->name('faqs.reorder');
    
    // Contact Messages Management
    Route::resource('messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    Route::post('messages/{message}/reply', [ContactMessageController::class, 'reply'])->name('messages.reply');
    Route::patch('messages/{message}/status', [ContactMessageController::class, 'updateStatus'])->name('messages.updateStatus');
    Route::patch('messages/{message}/priority', [ContactMessageController::class, 'updatePriority'])->name('messages.updatePriority');
    Route::patch('messages/{message}/notes', [ContactMessageController::class, 'addNotes'])->name('messages.addNotes');
    Route::post('messages/archive-selected', [ContactMessageController::class, 'archiveSelected'])->name('messages.archiveSelected');
    Route::post('messages/mark-read', [ContactMessageController::class, 'markAsRead'])->name('messages.markAsRead');
});

// Keep backward compatibility for old routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/users', [ReportController::class, 'users'])->name('reports.users');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
