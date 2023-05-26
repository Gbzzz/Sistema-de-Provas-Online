<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ManageTestController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TestController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('docente')->group(function(){
    // Route::get('/questions', [QuestionController::class, 'index'])->name('questions');
    Route::get('/questions/list', [QuestionController::class, 'list'])->name('list_questions');
    Route::post('/questions/addOpen', [QuestionController::class, 'storeOpen'])->name('add_questionOpen');
    Route::post('/questions/addMark', [QuestionController::class, 'storeMark'])->name('add_questionMark');
    Route::post('/questions/edit/{id}', [QuestionController::class, 'edit'])->name('edit_question');
    Route::put('/questions/updateOpen/{id}', [QuestionController::class, 'updateQuestionOpen'])->name('update_questionOpen');
    Route::put('/questions/updateMark/{id}', [QuestionController::class, 'updateQuestionMark'])->name('update_questionMark');
    Route::get('/questions/view/{id}', [QuestionController::class, 'view'])->name('view_question');
    Route::delete('/questions/delete/{id}', [QuestionController::class, 'delete'])->name('delete_questions');
    Route::post('/test/add', [TestController::class, 'store'])->name('add_test');
    Route::delete('/tests/delete/{id}', [TestController::class, 'delete'])->name('delete_tests');
});

Route::get('/tests', [TestController::class, 'index'])->name('list_tests')->middleware('discente');

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/users', [AdminController::class, 'index'])->name('users')->middleware('auth');
Route::get('/register', [RegisterController::class, 'create'])->name('register')->middleware('admin');
Route::post('/register', [RegisterController::class, 'store'])->name('register.perform')->middleware('admin');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('/index-questions', [HomeController::class, 'index_questions'])->name('index-questions')->middleware('auth');
Route::get('/index-tests', [HomeController::class, 'index_tests'])->name('index-tests')->middleware('auth');
Route::get('/tests/start/{id}/', [ManageTestController::class, 'index'])->middleware('discente');

Route::get('/profile', [UserProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update')->middleware('auth');
Route::get('/{page}', [PageController::class, 'index'])->name('page')->middleware('auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/contador',[TestController::class, 'indexStart']);
Route::post('/contador', [TestController::class, 'start']);

// Route::get('/register', [RegisterController::class, 'create'])->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->name('register.perform');
