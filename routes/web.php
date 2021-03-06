<?php

use App\Http\Controllers\Web\CatController;
use App\Http\Controllers\Web\ContactController;
use App\Http\Controllers\Web\ExamController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\ProfileControler;
use App\Http\Controllers\Web\SkillController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\QuestionsController as AdminQuestionsController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;


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


####################################################################
###################         language         #######################
####################################################################

Route::get('lang/{lang}', [LangController::class, 'set']);


####################################################################
#####################         Website         ######################
####################################################################

Route::middleware('lang')->group(function () {
  Route::get('/', [HomeController::class, 'index'])->name("home");
  Route::get('categories/show/{cat}', [CatController::class, 'show'])->name('categories.show');
  Route::get('skill/show/{id}', [SkillController::class, 'show'])->name('skill.show');
  Route::get('exam/show/{id}', [ExamController::class, 'show'])->name('exam.show')->middleware(['auth', 'verified', 'student']);
  Route::get('exam/question/{id}', [ExamController::class, 'question'])->name('exam.question')->middleware(['auth', 'verified', 'student']);
  Route::get('profile', [ProfileControler::class, 'index'])->name('profile.index')->middleware(['auth', 'verified', 'student']);
  Route::get('contact', [ContactController::class, 'create'])->name('contact.create');
  Route::post('contact/send', [ContactController::class, 'store'])->name('contact.store');
});

Route::post('exam/start/{id}', [ExamController::class, 'start'])->name('exam.start')->middleware(['auth', 'verified', 'student', 'can.enter.exam']);
Route::post('exam/submit/{id}', [ExamController::class, 'submit'])->name('exam.submit')->middleware(['auth', 'verified', 'student']);


####################################################################
###################         Dashboard         ######################
####################################################################


Route::prefix('dashboard')->middleware(['auth', 'verified', 'can.enter.dashboard'])->group(function () {


  Route::get('home', [AdminHomeController::class, 'index'])->name('dashboard.home');
  Route::get('category', [AdminCatController::class, 'index'])->name('dashboard.category.index');
  Route::post('category/store', [AdminCatController::class, 'store'])->name('dashboard.category.store');
  Route::get('category/destroy/{cat}', [AdminCatController::class, 'destroy'])->name('dashboard.category.destroy');
  Route::get('category/toggle/{cat}', [AdminCatController::class, 'toggle'])->name('dashboard.category.toggle');
  Route::post('category/update', [AdminCatController::class, 'update'])->name('dashboard.category.update');


  Route::get('skill', [AdminSkillController::class, 'index'])->name('dashboard.skill.index');
  Route::post('skill/store', [AdminSkillController::class, 'store'])->name('dashboard.skill.store');
  Route::get('skill/destroy/{skill}', [AdminSkillController::class, 'destroy'])->name('dashboard.skill.destroy');
  Route::get('skill/toggle/{skill}', [AdminSkillController::class, 'toggle'])->name('dashboard.skill.toggle');
  Route::post('skill/update', [AdminSkillController::class, 'update'])->name('dashboard.skill.update');


  Route::get('exam', [AdminExamController::class, 'index'])->name('dashboard.exam.index');
  Route::get('exam/show/{exam}', [AdminExamController::class, 'show'])->name('dashboard.exam.show');
  Route::get('exam/create', [AdminExamController::class, 'create'])->name('dashboard.exam.create');
  Route::post('exam/store', [AdminExamController::class, 'store'])->name('dashboard.exam.store');
  Route::get('exam/edit/{exam}', [AdminExamController::class, 'edit'])->name('dashboard.exam.edit');
  Route::post('exam/update/{exam}', [AdminExamController::class, 'update'])->name('dashboard.exam.update');
  Route::get('exam/destroy/{exam}', [AdminExamController::class, 'destroy'])->name('dashboard.exam.destroy');
  Route::get('exam/toggle/{exam}', [AdminExamController::class, 'toggle'])->name('dashboard.exam.toggle');


  Route::get('exam/question/create/{exam}', [AdminQuestionsController::class, 'create'])->name('dashboard.question.create');
  Route::post('exam/question/store/{exam}', [AdminQuestionsController::class, 'store'])->name('dashboard.question.store');
  Route::get('exam/question/edit/{exam}/{question}', [AdminQuestionsController::class, 'edit'])->name('dashboard.question.edit');
  Route::post('exam/question/update/{exam}/{question}', [AdminQuestionsController::class, 'update'])->name('dashboard.question.update');
  Route::get('exam/question/show/{exam}', [AdminQuestionsController::class, 'show'])->name('dashboard.question.show');


  Route::get('student', [AdminStudentController::class, 'index'])->name('dashboard.student.index');
  Route::get('student/show/{user}', [AdminStudentController::class, 'show'])->name('dashboard.student.show');
  Route::get('student/open-exam/{user}/{exam}', [AdminStudentController::class, 'openExam'])->name('dashboard.student.open.exam');
  Route::get('student/closed-exam/{user}/{exam}', [AdminStudentController::class, 'closedExam'])->name('dashboard.student.closed.exam');


  Route::middleware('super.admin')->group(function () {
    Route::get('admins', [AdminAdminController::class, 'index'])->name('dashboard.admin.index');
    Route::get('admin/create', [AdminAdminController::class, 'create'])->name('dashboard.admin.create');
    Route::post('admin/store', [AdminAdminController::class, 'store'])->name('dashboard.admin.store');
    Route::get('admin/promotion/{id}', [AdminAdminController::class, 'promotion'])->name('dashboard.admin.promotion');
    Route::get('admin/rebate/{id}', [AdminAdminController::class, 'rebate'])->name('dashboard.admin.rebate');
  });


  Route::get('messages', [AdminMessageController::class, 'index'])->name('dashboard.messages.index');
  Route::get('message/show/{message}', [AdminMessageController::class, 'show'])->name('dashboard.message.show');
  Route::post('message/store/{message}', [AdminMessageController::class, 'store'])->name('dashboard.message.store');
});
