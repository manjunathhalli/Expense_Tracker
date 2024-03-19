<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AnalyticsController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function(){

    Route::get('/expenses', [ExpenseController::class, 'index']);
    
    Route::resource('expenses', ExpenseController::class);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::resource('categories', CategoryController::class);

    Route::get('/expenses-by-category', [ExpenseController::class, 'expensesByCategory']);

});

require __DIR__.'/auth.php';