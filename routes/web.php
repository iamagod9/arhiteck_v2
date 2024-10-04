<?php

use App\Http\Controllers\AvitoController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EstateController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "index"])->name("home");
Route::post("/feedback", [FeedbackController::class, "store"])->name("feedback.store");

Route::post("/consultation", [ConsultationController::class, "store"])->name("consultation");

Route::view("/personal-data", "personal-data")->name("personal-data");

Route::get("/estates", [EstateController::class, "index"])->name("estate");
Route::get("/estates/{estate}", [EstateController::class, "show"])->name("estate.show");
Route::post("/estate-viewing", [EstateController::class, "viewing"])->name("estate.viewing");

Route::get('/avito-new.xml', [AvitoController::class, 'newBuilding']);
