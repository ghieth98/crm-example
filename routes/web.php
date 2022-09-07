<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});
//USERS ROUTING
Route::resource('/user', UserController::class)
    ->except('show');
//CLIENTS ROUTING
Route::resource('/client', ClientController::class)
    ->except('show');
//PROJECTS ROUTING
Route::resource('/project', ProjectController::class)
    ->except('show');
//TASKS ROUTING
Route::resource('/task', TaskController::class)
    ->except('show');
//MEDIA ROUTING
Route::post('/media/{model}/{id}/upload', [MediaController::class])
    ->name('media.upload');
Route::get('/media/{mediaItem}/download', [MediaController::class])
    ->name('media.download');
Route::delete('media/{model}/{id}/{mediaItem}/delete', [MediaController::class])
    ->name('media.delete');


Route::get('/notification', [NotificationController::class, 'index'])
    ->name('notification.index');
Route::put('/notification/{notification}', [NotificationController::class, 'update'])
    ->name('notification.update');
Route::delete('notification/destroy', [NotificationController::class, 'destroy'])
    ->name('notification.destroy');

//DASHBOARD ROUTING
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
