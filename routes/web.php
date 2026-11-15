<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/* ---------- Publik ---------- */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/about', [HomeController::class, 'about']);
Route::get('/kontak', [HomeController::class, 'contact'])->name('contact');
Route::post('/kontak', [HomeController::class, 'contactSend'])->name('contact.send');
Route::get('/donation', [HomeController::class, 'donation'])->name('donation');
Route::get('/donasi', [HomeController::class, 'donation']);
Route::post('/donation', [HomeController::class, 'donationConfirm'])->name('donation.confirm');
Route::post('/donasi', [HomeController::class, 'donationConfirm']);

/* ---------- Event ---------- */
Route::get('/event', [EventController::class, 'index'])->name('events.index');
Route::get('/event/{slug}', [EventController::class, 'show'])->name('events.show');
Route::post('/event/{slug}/daftar', [EventController::class, 'register'])->middleware('auth')->name('events.register');
Route::post('/event/{slug}/batal', [EventController::class, 'unregister'])->middleware('auth')->name('events.unregister');

/* ---------- Artikel ---------- */
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

/* ---------- Galeri ---------- */
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery', [GalleryController::class, 'index']);

/* ---------- Forum ---------- */
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/buat', [ForumController::class, 'create'])->middleware('auth')->name('forum.create');
Route::post('/forum/buat', [ForumController::class, 'store'])->middleware('auth')->name('forum.store');
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/forum/{id}/komentar', [ForumController::class, 'comment'])->middleware('auth')->name('forum.comment');

/* ---------- Anggota ---------- */
Route::get('/anggota', [MemberController::class, 'index'])->name('members.index');
Route::get('/anggota/{id}', [MemberController::class, 'profile'])->name('members.profile');
Route::get('/akun', [MemberController::class, 'edit'])->middleware('auth')->name('account');
Route::post('/akun', [MemberController::class, 'update'])->middleware('auth')->name('account.update');

/* ---------- Autentikasi ---------- */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/daftar', [AuthController::class, 'showRegister'])->name('register');
Route::post('/daftar', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* ---------- Admin ---------- */
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/users/{id}/role', [AdminController::class, 'userRole'])->name('admin.users.role');
    Route::post('/users/{id}/hapus', [AdminController::class, 'userDelete'])->name('admin.users.delete');

    Route::get('/events', [AdminController::class, 'events'])->name('admin.events');
    Route::get('/events/buat', [AdminController::class, 'eventCreate'])->name('admin.events.create');
    Route::post('/events/buat', [AdminController::class, 'eventStore'])->name('admin.events.store');
    Route::get('/events/{id}/edit', [AdminController::class, 'eventEdit'])->name('admin.events.edit');
    Route::post('/events/{id}/edit', [AdminController::class, 'eventUpdate'])->name('admin.events.update');
    Route::post('/events/{id}/hapus', [AdminController::class, 'eventDelete'])->name('admin.events.delete');
    Route::get('/events/{id}/peserta', [AdminController::class, 'eventRegistrants'])->name('admin.events.registrants');

    Route::get('/artikel', [AdminController::class, 'articles'])->name('admin.articles');
    Route::get('/artikel/buat', [AdminController::class, 'articleCreate'])->name('admin.articles.create');
    Route::post('/artikel/buat', [AdminController::class, 'articleStore'])->name('admin.articles.store');
    Route::get('/artikel/{id}/edit', [AdminController::class, 'articleEdit'])->name('admin.articles.edit');
    Route::post('/artikel/{id}/edit', [AdminController::class, 'articleUpdate'])->name('admin.articles.update');
    Route::post('/artikel/{id}/hapus', [AdminController::class, 'articleDelete'])->name('admin.articles.delete');

    Route::get('/forum', [AdminController::class, 'forum'])->name('admin.forum');
    Route::post('/forum/{id}/hapus', [AdminController::class, 'forumDelete'])->name('admin.forum.delete');

    Route::get('/galeri', [AdminController::class, 'gallery'])->name('admin.gallery');
    Route::post('/galeri', [AdminController::class, 'galleryStore'])->name('admin.gallery.store');
    Route::post('/galeri/{id}/hapus', [AdminController::class, 'galleryDelete'])->name('admin.gallery.delete');

    Route::get('/pesan', [AdminController::class, 'messages'])->name('admin.messages');
});
