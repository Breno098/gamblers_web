<?php

use App\Http\Controllers\Adm\CountryController;
use App\Http\Controllers\Adm\DashboardController;
use App\Http\Controllers\Adm\TeamController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [LoginController::class, 'showForm']);
Route::get('/login', [LoginController::class, 'showForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/login', [LoginController::class, 'showFormRegister']);
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('adm')->name('adm.')->middleware('auth')->group(function (){

    Route::get('/error/{error}', function($error) {
        return view('adm.errors', [ 'error' => $error ]);
    })->name('error');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('country', CountryController::class);
    Route::resource('team', TeamController::class);

    // Route::get('/adm/country', [CountryController::class, 'index'])->name('adm.country.index');
    // Route::get('/adm/country/createOrEdit/{country?}', [CountryController::class, 'createOrEdit'])->name('adm.country.createOrEdit');

    // Route::post('/adm/country/store', [CountryController::class, 'store'])->name('adm.country.store');
    // Route::post('/adm/country/delete/{country}', [CountryController::class, 'destroy'])->name('adm.country.delete');

});
