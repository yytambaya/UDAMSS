<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AnnouncementController;

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

Route::get('/',  function () { redirect( route('general.announcement') ); });

Route::prefix('announcement')->group( function() {

    Route::get('/', function () { redirect( route('general.announcement') ); });
    
    Route::get('/general', [AnnouncementController::class, 'general'])->name('general.announcement');
    Route::post('/general', [AnnouncementController::class, 'postGeneral'])->name('post.general.announcement');

    Route::get('/staff', [AnnouncementController::class, 'staff'])->name('staff.announcement');
    Route::post('/staff', [AnnouncementController::class, 'postStaff'])->name('post.staff.announcement');

    Route::get('/level4', [AnnouncementController::class, 'level4'])->name('level4.announcement');
    Route::post('/level4', [AnnouncementController::class, 'postLevel4'])->name('post.level4.announcement');
    
    Route::get('/level3', [AnnouncementController::class, 'level3'])->name('level3.announcement');
    Route::post('/level3', [AnnouncementController::class, 'postLevel3'])->name('post.level3.announcement');
    
    Route::get('/level2', [AnnouncementController::class, 'level2'])->name('level2.announcement');
    Route::post('/level2', [AnnouncementController::class, 'postLevel2'])->name('post.level2.announcement');
    
    Route::get('/level1', [AnnouncementController::class, 'level1'])->name('level1.announcement');
    Route::post('/level1', [AnnouncementController::class, 'postLevel1'])->name('post.level1.announcement');
    
});


Auth::routes(['register' => false,]);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [HomeController::class, 'index'])->name('home');