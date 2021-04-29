<?php

use App\Http\Controllers\Adm\CompetitionController;
use App\Http\Controllers\Adm\CountryController;
use App\Http\Controllers\Adm\DashboardController;
use App\Http\Controllers\Adm\GameController;
use App\Http\Controllers\Adm\OfficialController;
use App\Http\Controllers\Adm\PlayerController;
use App\Http\Controllers\Adm\RankingController;
use App\Http\Controllers\Adm\StadiumController;
use App\Http\Controllers\Adm\TeamController;
use App\Http\Controllers\Adm\UserController;

use App\Http\Controllers\Gambler\DashboardController as GamblerDashboardController;
use App\Http\Controllers\Gambler\OfficialController as GamblerOfficialController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Gambler\RankingController as GamblerRankingController;
use App\Http\Controllers\Gambler\UserController as GamblerUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function (){

    Route::get('/dashboard', [GamblerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/official/competitions', [GamblerOfficialController::class, 'competitions'])->name('official.competitions');
    Route::get('/official/competition_games/{competition}', [GamblerOfficialController::class, 'competitionGames'])->name('official.competitionGames');
    Route::get('/official/game/{game}', [GamblerOfficialController::class, 'game'])->name('official.game');
    Route::post('/official/store_bet', [GamblerOfficialController::class, 'storeBet'])->name('official.store_bet');

    Route::get('/ranking', [GamblerRankingController::class, 'index'])->name('ranking.index');
    Route::get('/ranking/{competition}', [GamblerRankingController::class, 'competition'])->name('ranking.competition');

    Route::get('/user', [GamblerUserController::class, 'index'])->name('user.index');
    Route::get('/user/report/{competition}', [GamblerUserController::class, 'report'])->name('user.report');
    Route::get('/user/avatar', [GamblerUserController::class, 'avatar'])->name('user.avatar');
    Route::get('/user/update_avatar/{avatar}', [GamblerUserController::class, 'updateAvatar'])->name('user.update_avatar');

});

Route::prefix('adm')->name('adm.')->middleware(['auth', 'adm'])->group(function (){

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
    Route::get('/official/competition_games/{competition}', [OfficialController::class, 'competitionGames'])->name('official.competitionGames');
    Route::get('/official/game/{game}', [OfficialController::class, 'game'])->name('official.game');
    Route::post('/official/calculate_score', [OfficialController::class, 'calculateScore'])->name('official.calculate_score');

    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{user}', [UserController::class, 'info'])->name('user.info');
    Route::get('/user/report/{user}/{competition}', [UserController::class, 'report'])->name('user.report');
    Route::post('/user/update_competition', [UserController::class, 'updateCompetition'])->name('user.update_competition');

    Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
    Route::get('/ranking/{competition}', [RankingController::class, 'competition'])->name('ranking.competition');

});

Route::get('/', [LoginController::class, 'showForm']);
Route::get('/login', [LoginController::class, 'showForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [LoginController::class, 'showFormRegister']);
Route::post('/register', [LoginController::class, 'register'])->name('register');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
