<?php

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

Route::get('login', function () {
    return view('login');
})->name('login_page');

Route::get('auth', function () {
    return view('auth');
})->name('auth_page');

Route::get('login/send', function () {
    return view('dont_access');
});

Route::get('auth/send', function () {
    return view('dont_access');
});

Route::get('login/profile/sendApplication', function () {
    return view('dont_access');
});

Route::get('login/profile/{id}/edit/send', function () {
    return view('dont_access');
});

use App\Http\Controllers\userController;
Route::get('/', [ userController::class, 'index' ])->name('index_page');
Route::post('login/send', [ userController::class, 'login' ])->name('login_form');
Route::get('login/unlogin', [ userController::class, 'unlogin' ])->name('unlogin');
Route::get('login/profile', [ userController::class, 'getProfile' ])->name('profile_page');
Route::post('auth/send', [ userController::class, 'auth' ])->name('auth_form');
Route::post('login/profile/sendApplication', [ userController::class, 'sendApplication' ])->name('application_form');
Route::get('login/profile/{id}/edit', [ userController::class, 'editPage' ])->name('get_edit_page');
Route::get('login/profile/{id}/delete', [ userController::class, 'deleteApplication' ])->name('app_delete');
Route::post('login/profile/{id}/edit/send', [ userController::class, 'editApplication' ])->name('app_edit_form');
