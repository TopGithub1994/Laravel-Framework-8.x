<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
// use App\Models\User;
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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    // Department
    Route::get('/department/all',[DepartmentController::class,'index'])->name('department');
    Route::post('/department/add',[DepartmentController::class,'store'])->name('addDepartment');
    Route::get('/department/edit/{id}',[DepartmentController::class,'edit']);  
    Route::post('/department/update/{id}',[DepartmentController::class,'update']);
    
    //SoftDelete
    Route::get('/department/softdelete/{id}',[DepartmentController::class,'softdelete']); 
    Route::get('/department/restore/{id}',[DepartmentController::class,'restore']);
    Route::get('/department/destroy/{id}',[DepartmentController::class,'destroy']); 

    //Service
    Route::get('/service/all',[ServiceController::class,'index'])->name('services');
    Route::post('/service/add',[ServiceController::class,'store'])->name('addService');
    Route::get('/service/edit/{id}',[ServiceController::class,'edit']); 
    Route::post('/service/update/{id}',[ServiceController::class,'update']);
    Route::get('/service/destroy/{id}',[ServiceController::class,'destroy']);
});
