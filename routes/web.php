<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Web\CatController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\ProfileControler;
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
  Route::get('exam/show/{id}', [ExamController::class, 'show'])->name('exam.show')->middleware(['auth', 'verified', 'student']);
  Route::get('exam/question/{id}', [ExamController::class, 'question'])->name('exam.question')->middleware(['auth', 'verified', 'student']);
  Route::get('profile', [ProfileControler::class, 'index'])->name('profile.index')->middleware(['auth', 'verified', 'student']);
  Route::get('contact', [ContactController::class, 'create'])->name('contact.create');
  Route::post('contact/send', [ContactController::class, 'store'])->name('contact.store');
});

Route::post('exam/start/{id}', [ExamController::class, 'start'])->name('exam.start')->middleware(['auth', 'verified', 'student', 'can.enter.exam']);
Route::post('exam/submit/{id}', [ExamController::class, 'submit'])->name('exam.submit')->middleware(['auth', 'verified', 'student']);

Route::get('lang/{lang}', [LangController::class, 'set']);


Route::prefix('dashboard')->middleware(['auth', 'verified','can.enter.dashboard'])->group(function () {
  Route::get('/', [AdminHomeController::class, 'index'])->name('dashboard.home');
});
