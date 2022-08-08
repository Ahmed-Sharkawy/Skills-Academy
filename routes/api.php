<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\ExamController;
use App\Http\Controllers\Api\QuestionController;
use App\Http\Controllers\Api\SkillController;
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


Route::post('categories', [CatController::class, 'index']);
Route::post('category/show/{cat}', [CatController::class, 'show']);
Route::post('skill/show/{id}', [SkillController::class, 'show']);
Route::post('exam/show/{exam}', [ExamController::class, 'index']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

  Route::post('exam/show/question/{id}', [ExamController::class, 'show']);
  Route::post('exam/start/question/{id}', [QuestionController::class, 'start']);
  Route::post('exam/submit/question/{id}', [QuestionController::class, 'submit'])->middleware('can.enter.exam.api');


  Route::post('me', [AuthController::class, 'me']);
  Route::post('logout', [AuthController::class, 'logout']);

});
