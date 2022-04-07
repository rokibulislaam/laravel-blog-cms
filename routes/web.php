<?php

use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\handleDynamicRoute;
use App\Http\Livewire\Pages;
use App\Http\Livewire\Index;

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




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('/', Index::class)->name('home');

Route::get('page/{route}', Pages::class);

require __DIR__.'/auth.php';
