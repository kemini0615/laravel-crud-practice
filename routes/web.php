<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// 리소스 컨트롤러에 새로운 라우트를 추가할 땐, resource() 메소드보다 먼저 호출해야 한다.
Route::get('customers/trash', [CustomerController::class, 'trash'])->name('customers.trash');
Route::get('customers/trash/{customer}', [CustomerController::class, 'restore'])->name('customers.trash.restore');
Route::delete('customers/trash/{customer}', [CustomerController::class, 'forceDestroy'])->name('customers.trash.destroy');
Route::resource('customers', CustomerController::class);
