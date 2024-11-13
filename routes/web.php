<?php

use App\Http\Controllers\TaskEmployeesController;
use App\Http\Controllers\TaskListController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', TaskListController::class.'@index');

Route::get('task/employees', TaskEmployeesController::class.'@index');
// Route::get('task/employees/upload_csv', TaskEmployeesController::class.'@upload_csv');

// Route::post('task/employees',TaskEmployeesController::class.'@upload');

// Route::get('task/employees', [TaskEmployeesController::class, 'index']);
Route::post('upload', [TaskEmployeesController::class, 'upload'])->name('upload');


