<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeditationController;
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

// Beranda
Route::get('/', [HomeController::class, 'index']);

// Articles
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'getById']);

// Meditations
Route::get('/meditations', [MeditationController::class, 'index']);

// Login
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'proceedLogin']);

// Register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register-user', [AuthController::class, 'postUser']);
Route::post('/register-psychologist', [AuthController::class, 'postPsychologist']);

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin ROUTES
Route::middleware(['role:admin'])->group(function () {
    // Admin - Approval
    Route::get('/approval-page', [AdminController::class, 'index']);
    Route::post('/approval-page/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');

    // Admin - Meditation Operation
    Route::get('/operate-meditation', [AdminController::class, 'showMeditation']);
    Route::post('/add-meditation', [AdminController::class, 'addMeditation'])->name('admin.addMeditation');
    Route::post('/edit-meditation', [AdminController::class, 'editMeditation'])->name('admin.editMeditation');
    Route::get('/delete-meditation/{id}', [AdminController::class, 'deleteMeditation'])->name('admin.deleteMeditation');
});

// Moms ROUTES
Route::middleware(['role:mom'])->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'showPsychologists'])->name('mom.showConsultation');
    Route::get('/consultations/{id}', [ConsultationController::class, 'showDialogMessage']);
    
});

// Moms & Doctor ROUTES
Route::middleware('multi_role:mom,psychologist')->group(function () {
    Route::get('/messages/{recipientId}', [ConsultationController::class, 'getMessages']);
    Route::post('/send', [ConsultationController::class, 'sendMessages']);
});

// Psychologist ROUTES
Route::middleware(['role:psychologist'])->group(function () {
    Route::get('/consultation-list', [ConsultationController::class, 'messagesWithMom'])->name('pyschologist.messageWithMom');
    Route::get('/consultation-list/{id}', [ConsultationController::class, 'showDialogMessageWithMom'])->name('pyschologist.dialogMessageWithMom');
});