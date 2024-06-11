<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\EmotionalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeditationController;
use App\Http\Controllers\PasswordController;
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
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'proceedLogin']);

// Register
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register-user', [AuthController::class, 'postUser']);
Route::post('/register-psychologist', [AuthController::class, 'postPsychologist']);

// Profile
Route::get('/profile', [AuthController::class, 'showProfile']);
Route::post('/profile-update', [AuthController::class, 'updateProfile'])->name('updateProfile');

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
    Route::delete('/delete-meditation/{id}', [AdminController::class, 'deleteMeditation'])->name('admin.deleteMeditation');
});

// Moms ROUTES
Route::middleware(['role:mom'])->group(function () {
    Route::get('/emotional-notes', [EmotionalController::class, 'index']);
    Route::post('/emotional-notes', [EmotionalController::class, 'submit'])->name('mom.emotionalSubmit');
});

// Moms & Doctor & Family ROUTES
Route::middleware('multi_role:mom,psychologist,family')->group(function () {
    Route::get('/messages/{recipientId}', [ConsultationController::class, 'getMessages']);
    Route::post('/send', [ConsultationController::class, 'sendMessages']);
});

Route::middleware('multi_role:mom,family')->group(function () {
    Route::get('/consultations', [ConsultationController::class, 'showPsychologists'])->name('mom.showConsultation');
    Route::get('/consultations/{id}', [ConsultationController::class, 'showDialogMessage']);
});

// Reset Password
Route::get('password/reset', [PasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [PasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordController::class, 'reset'])->name('password.update');

// Psychologist ROUTES
Route::middleware(['role:psychologist'])->group(function () {
    Route::get('/consultation-list', [ConsultationController::class, 'messagesWithMom'])->name('pyschologist.messageWithMom');
    Route::get('/consultation-list/{id}', [ConsultationController::class, 'showDialogMessageWithMom'])->name('pyschologist.dialogMessageWithMom');
    Route::get('/operate-articles', [ArticleController::class, 'showListArticles'])->name('psychologist.showListArticles');
    Route::post('/create-article', [ArticleController::class, 'createArticle'])->name('psychologist.createArticle');
    Route::post('/edit-article', [ArticleController::class, 'editArticle'])->name('psychologist.editArticle');
    Route::get('/delete-article/{id}', [ArticleController::class, 'deleteArticle'])->name('psychologist.deleteArticle');
});

// Family ROUTES
Route::middleware(['role:family'])->group(function () {
    Route::get('/discussion-forum', [ConsultationController::class, 'showDiscussionForum'])->name('family.discussionForum');
    Route::get('/messages-forum', [ConsultationController::class, 'getMessagesDiscussionForum']);
    Route::post('/send-forum', [ConsultationController::class, 'sendMessageDiscussion']);
});