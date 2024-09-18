<?php

use App\Http\Controllers\ExamController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fibonacci', [ExamController::class, 'index'])->name('fibonacci.index');
Route::post('/fibonacci', [ExamController::class, 'calculate'])->name('fibonacci.calculate');

Route::get('/sort', [ExamController::class, 'sortIndex'])->name('exam.sort.index');
Route::post('/sort', [ExamController::class, 'sortIds'])->name('exam.sort');

Route::get('/form', [ExamController::class, 'form'])->name('form.index');
Route::post('/form', [ExamController::class, 'submitForm'])->name('form.submit');
