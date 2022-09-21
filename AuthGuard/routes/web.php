<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

Route::controller(AuthController::class)->group(function (){

    Route::get('login', 'index')->name('login');
    Route::post('post-login', 'postLogin')->name('login.post');

    Route::get('/profile', function () {
        if (session('lifeTime') + 60 <= Carbon::now()->timestamp) {
            return redirect()->route('login');
        }
        return view('auth.profile');
    })->name('profile');

});
