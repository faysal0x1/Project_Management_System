<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SiteSettingController;

defineRoleBasedRoutes(function ($role) {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->name('dashboard');
    Route::get('/site-settings', [SiteSettingController::class, 'index'])->name('sitesettings.index');
    Route::post('/site-settings/update', [SiteSettingController::class, 'update'])->name('settings.update');

    Route::resources([
        'user' => UserController::class,
        'post' => PostController::class,
    ]);

    route::post('/users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');

    Route::resource('employee', EmployeeController::class);
});

Route::get('/toggle-status/{model}/{id}', [AdminController::class, 'toggleStatus'])
    ->name('toggleStatus');
