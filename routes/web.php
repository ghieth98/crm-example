<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::permanentRedirect('/', 'login');
Route::get('/login', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'termsAccepted'])->group(function () {
//HOME ROUTING
    Route::get('/home', [HomeController::class, 'index'])
        ->name('home');
//USERS ROUTING
    Route::resource('/user', UserController::class)
        ->middleware('role:admin');
//CLIENTS ROUTING
    Route::resource('/client', ClientController::class)
        ->except('show');
//PROJECTS ROUTING
    Route::resource('/project', ProjectController::class);
//TASKS ROUTING
    Route::resource('/task', TaskController::class);
});

//MEDIA ROUTING
Route::post('/media/{model}/{id}/upload', [MediaController::class])
    ->name('media.upload');
Route::get('/media/{mediaItem}/download', [MediaController::class])
    ->name('media.download');
Route::delete('media/{model}/{id}/{mediaItem}/delete', [MediaController::class])
    ->name('media.delete');

//NOTIFICATIONS ROUTING
Route::get('/notification', [NotificationController::class, 'index'])
    ->name('notification.index');
Route::put('/notification/{notification}', [NotificationController::class, 'update'])
    ->name('notification.update');
Route::delete('notification/destroy', [NotificationController::class, 'destroy'])
    ->name('notification.destroy');

//PROFILE ROUTING
Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index');
Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
Route::put('/profile/change-password', [ProfileController::class, 'changePassword'])
    ->name('profile.changePassword');

//TERMS ROUTING
Route::get('/terms', [TermsController::class, 'index'])->middleware('auth')
    ->name('terms.index');
Route::post('/terms', [TermsController::class, 'store'])->middleware('auth')
    ->name('terms.store');

//DASHBOARD ROUTING
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
