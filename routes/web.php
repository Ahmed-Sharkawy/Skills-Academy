<?php

use App\Http\Controllers\Web\CatController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\SkillController;
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

Route::middleware('lang')->group(function () {
  Route::get('/', [HomeController::class, 'index'])->name("home");
  Route::get('categories/show/{id}', [CatController::class, 'show'])->name('categories.show');
  Route::get('skill/show/{id}', [SkillController::class, 'show'])->name('skill.show');
  Route::get('exam/show/{id}', [ExamController::class, 'show'])->name('exam.show');
  Route::get('exam/question/{id}', [ExamController::class, 'question'])->name('exam.question');
  Route::get('contact',[ContactController::class, 'create'])->name('contact.create')->middleware('verified');
  Route::post('contact/send',[ContactController::class,'store'])->name('contact.store');
});

Route::get('lang/{lang}', [LangController::class, 'set']);
