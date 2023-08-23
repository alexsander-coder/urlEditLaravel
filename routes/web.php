<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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

// Route::get('/', function () {
//     return view('create');clicode
// });

// Route::get('/', [LinkController::class, 'index'])->name('links.index');
Route::post('/store', [LinkController::class, 'store'])->name('links.store');
Route::get('/links', [LinkController::class, 'create'])->name('links.create');
Route::get('/links/{id}/edit', [LinkController::class, 'edit'])->name('links.edit');
Route::put('/links/{id}', [LinkController::class, 'update'])->name('links.update');
Route::get('/links/{link}', [LinkController::class, 'show'])->name('links.show');
Route::delete('/links/{link}', [LinkController::class, 'destroy'])->name('links.destroy');
Route::get('{shortLink}', [LinkController::class, 'redirect'])->name('links.redirect');

