<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CommentAdminController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectCategoryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicController;
use App\Models\Article;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

// ============ PUBLIC ROUTES ============
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/skills', [PublicController::class, 'skills'])->name('skills');
Route::get('/experience', [PublicController::class, 'experience'])->name('experience');
Route::get('/projects', [PublicController::class, 'projects'])->name('projects.index');
Route::get('/projects/{slug}', [PublicController::class, 'projectDetail'])->name('projects.show');
Route::get('/services', [PublicController::class, 'services'])->name('services');
Route::get('/insights', [PublicController::class, 'articles'])->name('articles.index');
Route::get('/insights/{slug}', [PublicController::class, 'articleDetail'])->name('articles.show');
Route::get('/contact', [PublicController::class, 'contact'])->name('contact');
Route::post('/contact', [PublicController::class, 'sendContact'])->name('contact.send');
Route::get('/download-cv', [AnalyticsController::class, 'downloadCv'])->name('cv.download');
Route::get('/go/project/{project}', [AnalyticsController::class, 'projectDemo'])->name('analytics.project-demo');
// Sitemap
Route::get('/sitemap.xml', function () {
    $projects = Project::where('is_published', true)->get();
    $articles = Article::where('is_published', true)->get();
    $content = view('sitemap', compact('projects', 'articles'))->render();

    return response($content, 200)->header('Content-Type', 'application/xml');
})->name('sitemap');
// Comments
Route::get('/comments', fn () => redirect()->route('home', [], 302)->withFragment('comments'));
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

// ============ ADMIN ROUTES ============
Route::get('/admin/login', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Comments Admin
    Route::get('/comments', [CommentAdminController::class, 'index'])->name('comments.index');
    Route::post('/comments/{id}/reply', [CommentAdminController::class, 'reply'])->name('comments.reply');
    Route::put('/comments/{id}/approve', [CommentAdminController::class, 'approve'])->name('comments.approve');
    Route::put('/comments/{id}/pin', [CommentAdminController::class, 'pin'])->name('comments.pin');
    Route::delete('/comments/{id}', [CommentAdminController::class, 'destroy'])->name('comments.destroy');
    Route::post('/comments/store-admin', [CommentAdminController::class, 'store'])->name('comments.store.admin');

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Projects
    Route::get('/projects/{project}/preview', [ProjectController::class, 'preview'])->name('projects.preview');
    Route::delete('/projects/images/{image}', [ProjectController::class, 'destroyImage'])->name('projects.images.destroy');
    Route::resource('projects', ProjectController::class)->except('show');
    Route::resource('project-categories', ProjectCategoryController::class)->except('show');
    Route::resource('articles', ArticleController::class)->except('show');

    // Skills
    Route::resource('skills', SkillController::class)->except('show');

    // Experiences
    Route::resource('experiences', ExperienceController::class)->except('show');

    // Messages
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::put('/messages/{id}/read', [MessageController::class, 'markRead'])->name('messages.read');
    Route::put('/messages/{id}/archive', [MessageController::class, 'archive'])->name('messages.archive');
    Route::delete('/messages/{id}', [MessageController::class, 'destroy'])->name('messages.destroy');
});
