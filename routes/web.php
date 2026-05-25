<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;


Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::middleware(['auth'])->group(function () {

    
    Route::resource('tickets', TicketController::class);

    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::patch('/tickets/{ticket}/status', [TicketStatusController::class, 'update'])
        ->name('tickets.status');


    Route::get('/reports/pdf', [ReportController::class, 'pdf'])
        ->name('reports.pdf');
    Route::get('/reports', [ReportController::class, 'index'])
        ->name('reports.index');
    Route::post('/reports/send', [ReportController::class, 'send'])
        ->name('reports.send');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('settings', SettingController::class)->only(['index', 'update']);
});

require __DIR__.'/auth.php';