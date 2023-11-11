<?php

use App\Http\Controllers\TagsController;
use App\Http\Controllers\TaskController;
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

Route::middleware('auth')->group(function () {
    
    Route::controller(TaskController::class)->group(function () { 
        Route::get('/tasks', 'index')->name('tasks.index');
        Route::get('/tasks/create', 'create')->name('tasks.create');
        Route::post('/tasks/store', 'store')->name('tasks.store');
        Route::get('/tasks/{task}/edit', 'edit')->name('tasks.edit');
        Route::put('/tasks/{task}', 'update')->name('tasks.update');
        Route::delete('/tasks/{task}', 'destroy')->name('tasks.destroy');
    });

    Route::controller(TagsController::class)->group(function () { 
        Route::get('/tags', 'index')->name('tags.index');
        Route::get('/tags/create', 'create')->name('tags.create');
        Route::post('/tags/store', 'store')->name('tags.store');
        Route::get('/tags/{tag}/edit', 'edit')->name('tags.edit');
        Route::put('/tags/{tag}', 'update')->name('tags.update');
        Route::delete('/tags/{tag}', 'destroy')->name('tags.destroy');
    });

});