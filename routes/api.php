<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/category',[\App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
Route::post('/category-create',[\App\Http\Controllers\CategoryController::class,'store'])->name('category.create');
Route::delete('/category-delete/{id}',[\App\Http\Controllers\CategoryController::class,'destroy'])->name('category.destroy');
Route::post('/category-update/{id}',[\App\Http\Controllers\CategoryController::class,'update'])->name('category.update');
Route::get('/dress',[\App\Http\Controllers\DressController::class,'index'])->name('dress.index');
Route::post('/dress-create',[\App\Http\Controllers\DressController::class,'store'])->name('dress.create');
Route::delete('/dress-delete/{id}',[\App\Http\Controllers\DressController::class,'destroy'])->name('dress.destroy');
Route::post('/dress-update/{id}',[\App\Http\Controllers\DressController::class,'update'])->name('dress.update');
Route::get('/theme',[\App\Http\Controllers\Theme::class,'index'])->name('theme.index');
Route::post('/theme-create',[\App\Http\Controllers\Theme::class,'store'])->name('theme.create');
Route::delete('/theme-delete/{id}',[\App\Http\Controllers\Theme::class,'destroy'])->name('theme.delete');
Route::post('/theme-update/{id}',[\App\Http\Controllers\Theme::class,'update'])->name('theme.update');
Route::get('/package',[\App\Http\Controllers\PackageController::class,'index'])->name('package.index');
Route::post('/package-create',[\App\Http\Controllers\PackageController::class,'store'])->name('package.create');
Route::delete('/package-delete/{id}',[\App\Http\Controllers\PackageController::class,'destroy'])->name('package.delete');
Route::post('/package-update/{id}',[\App\Http\Controllers\PackageController::class,'update'])->name('package.update');
Route::get('/booking/status',[\App\Http\Controllers\BookingController::class,'index'])->name('booking.index');
Route::get('/booking',[\App\Http\Controllers\BookingController::class,'bookingList'])->name('booking.list');
Route::post('/booking-create',[\App\Http\Controllers\BookingController::class,'store'])->name('booking.create');
Route::post('/booking-update/{id}',[\App\Http\Controllers\BookingController::class,'update'])->name('booking.update');
Route::delete('/booking-delete/{id}',[\App\Http\Controllers\BookingController::class,'destroy'])->name('booking.delete');
Route::get('/employee',[\App\Http\Controllers\EmployeeController::class,'index'])->name('employee.index');
Route::post('/employee-create',[\App\Http\Controllers\EmployeeController::class,'store'])->name('employee.create');
Route::post('/employee-update/{id}',[\App\Http\Controllers\EmployeeController::class,'update'])->name('employee.update');
Route::delete('/employee-delete/{id}',[\App\Http\Controllers\EmployeeController::class,'destroy'])->name('employee.delete');
Route::get('/condition',[\App\Http\Controllers\ConditionController::class,'index'])->name('condition.index');
Route::post('/condition-create',[\App\Http\Controllers\ConditionController::class,'store'])->name('condition.create');
Route::post('/condition-update/{id}',[\App\Http\Controllers\ConditionController::class,'update'])->name('condition.update');
Route::delete('/condition-delete/{id}',[\App\Http\Controllers\ConditionController::class,'destroy'])->name('condition.delete');

