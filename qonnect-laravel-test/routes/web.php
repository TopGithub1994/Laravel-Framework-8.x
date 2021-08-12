<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
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

// Route::get('/about', 'AboutController@index'); v7
// Route::get('/about', [AboutController::class,'index']);
Route::get('/about/longlonglonglonglonglong', [AboutController::class,'index'])->name('about');

Route::get('/admin/{user}', [AdminController::class,'index'])->name('admin')->middleware('check');
/*
Route::get('/member', function () {
    return view('member.index');
});*/

/*
Route::get('/user/{fname}/{lname}', function ($fname,$lname) {
    echo "<h1>Hi name : $fname...</h1>" ;
    echo "<h1>Last name : $lname...</h1>" ;
});*/