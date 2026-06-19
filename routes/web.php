<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

// ============ PUBLIC ROUTES ============
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/skills', [PublicController::class, 'skills'])->name('skills');
Route::get('/experience', [PublicController::class, 'experience'])->name('experience');
Route::get('/projects', [PublicController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [PublicController::class, 'projectDetail'])->name('projects.show');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'sendContact'])->name('contact.send');
// Sitemap
Route::get('/sitemap.xml', function () {
    $projects = \App\Models\Project::all();
    $content  = view('sitemap', compact('projects'))->render();
    return response($content, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');

// ============ ADMIN ROUTES ============
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Projects
    Route::resource('projects', ProjectController::class);

    // Skills
    Route::resource('skills', SkillController::class);

    // Experiences
    Route::resource('experiences', ExperienceController::class);

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::put('/messages/{id}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
});