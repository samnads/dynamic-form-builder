<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PublicFormController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::prefix('forms')->name('forms.')->group(function () {
        Route::get('create', [FormController::class, 'createForm'])->name('create');
        Route::get('list', [FormController::class, 'listForms'])->name('list');
        Route::get('datatable', [FormController::class, 'datatable'])->name('datatable');
        Route::post('save', [FormController::class, 'save'])->name('save');
        Route::get('submissions', [FormController::class, 'submissionsList'])->name('submissions-list');
        Route::get('submissions-datatable', [FormController::class, 'submissionsListDatatable'])->name('submissions-datatable');
    });
});
Route::prefix('form')->name('form.')->group(function () {
    Route::get('{id}', [PublicFormController::class, 'viewForm'])->name('view');
    Route::post('{id}/save', [PublicFormController::class, 'save'])->name('save');
});