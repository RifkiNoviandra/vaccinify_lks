<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/v1/auth/login' , [\App\Http\Controllers\SocietyController::class , 'login']);

Route::prefix('v1')->group(function(){
    Route::post('/auth/logout' , [\App\Http\Controllers\SocietyController::class , 'logout']);

    Route::middleware('user')->group(function(){
        Route::get('/spots' , [\App\Http\Controllers\SpotController::class , 'getSpot']);
        Route::get('/spots/{spot_id}' , [\App\Http\Controllers\SpotController::class , 'getSpotById']);

        Route::post('/consultations' , [\App\Http\Controllers\ConsultationController::class , 'RequestConsultation']);
        Route::get('/consultations' , [\App\Http\Controllers\ConsultationController::class , 'getConsultation']);

        Route::post('/vaccinations', [\App\Http\Controllers\VaccinationController::class , 'RegisterVaccination']);
        Route::get('/vaccinations', [\App\Http\Controllers\VaccinationController::class , 'getVaccinationById']);
        Route::post('/vaccinations/{spot_id}', [\App\Http\Controllers\VaccinationController::class , 'getVaccinationBydate']);
    });

});

