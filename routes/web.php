<?php

use App\Http\Controllers\Adm\CompetitionController;
use App\Http\Controllers\Adm\CountryController;
use App\Http\Controllers\Adm\DashboardController;
use App\Http\Controllers\Adm\GameController;
use App\Http\Controllers\Adm\OfficialController;
use App\Http\Controllers\Adm\PlayerController;
use App\Http\Controllers\Adm\StadiumController;
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
    Route::resource('player', PlayerController::class);
    Route::resource('stadium', StadiumController::class);
    Route::resource('competition', CompetitionController::class);
    Route::resource('game', GameController::class);

    Route::get('/official/competitions', [OfficialController::class, 'competitions'])->name('official.competitions');
    Route::get('/official/competitionGames/{competition}', [OfficialController::class, 'competitionGames'])->name('official.competitionGames');

});
