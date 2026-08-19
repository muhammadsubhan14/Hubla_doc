<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentationController;
use App\Http\Controllers\Admin\DocumentationImageController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\PublicDocumentationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicDocumentationController::class, 'index'])->name('home');
Route::get('/documentations/{documentation}', [PublicDocumentationController::class, 'show'])->name('documentations.show');

Route::redirect('/login', '/admin/login')->name('login.redirect');
Route::get('/admin/login', [AuthController::class, 'create'])->name('login');
Route::post('/admin/login', [AuthController::class, 'store'])->name('admin.login.store');
Route::get('/admin/register', [AuthController::class, 'createRegistration'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'storeRegistration'])->name('admin.register.store');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('documentations', DocumentationController::class)->except('show');
    Route::post('documentations/{documentation}/images', [DocumentationImageController::class, 'store'])->name('documentations.images.store');
    Route::patch('documentations/{documentation}/images/{image}', [DocumentationImageController::class, 'update'])->name('documentations.images.update');
    Route::delete('documentations/{documentation}/images/{image}', [DocumentationImageController::class, 'destroy'])->name('documentations.images.destroy');
    Route::patch('documentations/{documentation}/cover/{image}', [DocumentationImageController::class, 'cover'])->name('documentations.cover');
    Route::resource('persons', PersonController::class)->except('show');
});
