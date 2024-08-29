<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\MailController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/menu', [Api\MenuController::class, 'index']);

Route::get('/news/{page}', [Api\NewsController::class, 'index']);
Route::get('/news-header', [Api\NewsController::class, 'newsHeader']);
Route::get('/news-item/{id}', [Api\NewsController::class, 'newsItem']);
Route::get('/announcements/{page}', [Api\AnnouncementsController::class, 'index']);
Route::get('/announcements-header', [Api\AnnouncementsController::class, 'AnnouncementsHeader']);
Route::get('/announcements-item/{id}', [Api\AnnouncementsController::class, 'AnnouncementsItem']);
Route::get('/DataAndReports/{page}', [Api\DataAndReportsController::class, 'index']);
Route::get('/DataAndReports-item/{id}', [Api\DataAndReportsController::class, 'DataAndReportsItem']);
Route::get('/LessonsAndTraining/{page}', [Api\LessonsAndTrainingController::class, 'index']);
Route::get('/LessonsAndTraining-item/{id}', [Api\LessonsAndTrainingController::class, 'DataAndReportsItem']);
Route::get('/MissionAndHistory', [Api\MissionAndHistoryController::class, 'index']);
Route::get('/Structure', [Api\StructureController::class, 'index']);
Route::get('/Partners', [Api\PartnersController::class, 'index']);
Route::get('/UsefulLink', [Api\UsefulLinksController::class, 'index']);

Route::post('/send-email', [MailController::class, 'sendEmail']);

