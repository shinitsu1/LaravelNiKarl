<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get();
// Route::post();
// Route::put();
// Route::patch();
// Route::delete();
// Route::options();


// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/', [StudentController::class, 'index']);

// Route::get('/users', [UserController::class, 'index']);

//common routes naming
//index - show all data or students
//show - show a single data or student
//create - show a form to a new user
//store - store a data
//edit - show form to a data
//update - update a data
//destroy - delete a data


// Route::get('/', [StudentController::class, 'index']);

Route::get('/', [StudentController::class, 'index'])->middleware('auth');
Route::get('/register', [UserController::class, 'register']);
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/process', [UserController::class, 'process']);

Route::post('/logout', [UserController::class, 'logout']);

Route::post('/store', [UserController::class, 'store']);

Route::get('/add/student', [StudentController::class, 'create']);
Route::post('/add/student', [StudentController::class, 'store']);
