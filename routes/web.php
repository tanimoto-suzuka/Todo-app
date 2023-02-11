<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ClassnamesController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::group([
    'where' => ['id' => '[0-9]+'],
    'middleware' => 'auth'
], function () {
    Route::get('/', [TasksController::class, 'index'])->name('tasks.index');
    Route::get('/{id}', [TasksController::class, 'show'])->name('tasks.show');
    Route::get('/tasks/add/{id}', [TasksController::class, 'add'])->name('tasks.add');
    Route::post('/tasks/add', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/edit/{id}', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::post('tasks/edit/{id}', [TasksController::class, 'update'])->name('tasks.update');
    Route::post('tasks/delete/{id}', [TasksController::class, 'delete'])->name('tasks.delete');
    Route::get('class/edit', [ClassnamesController::class, 'edit'])->name('class.edit');
    Route::post('class/edit', [ClassnamesController::class, 'update'])->name('class.update');
    Route::get('users/show', [TasksController::class, 'users'])->name('users.show');
    Route::get('users/date/{id}', [TasksController::class, 'date'])->name('users.date');
    Route::get('users/edit', [TasksController::class, 'useredit'])->name('users.edit');
    Route::post('users/edit', [TasksController::class, 'userupdate'])->name('users.update');
    Route::get('class/new', [ClassnamesController::class, 'new'])->name('class.new');
    Route::post('class/new', [ClassnamesController::class, 'store'])->name('class.store');
});
require __DIR__ . '/auth.php';
