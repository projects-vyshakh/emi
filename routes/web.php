<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::any('loan/details', [App\Http\Controllers\LoansController::class , 'index'])->name('loans.details');
Route::any('loan/emi/details', [App\Http\Controllers\LoansController::class , 'showEMIDetails'])->name('loans.emi.details');
Route::any('loan/emi/details/create', [App\Http\Controllers\LoansController::class , 'createEMIDetails'])->name('loans.emi.details.create');
