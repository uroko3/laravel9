<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use NunoMaduro\Collision\Adapters\Laravel\Commands\TestCommand;

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

Route::get('test', [TestController::class, 'index'])->name('test.index');
Route::get('test/input', [TestController::class, 'input'])->name('test.input');
Route::post('test/store', [TestController::class, 'store'])->name('test.store');
Route::get('test/edit/{test}', [TestController::class, 'edit'])->name('test.edit');
Route::post('test/update/{test}', [TestController::class, 'update'])->name('test.update');
