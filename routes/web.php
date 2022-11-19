<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeptController;

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
    return view('login');
});

Route::get('/test', function () {
    return view('login');
});

Route::get('admin/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin', function () {
    //return view('admin.dashboard');
    if(!session()->has('userid'))
    {
        return redirect("/");
    }
});




Route::get("admin/user",[UserController::class,"viewUser"]);
Route::post("/login",[UserController::class,"CheckLogin"]);
Route::get("/logout",[UserController::class,"UserLogout"]);

Route::get("admin/dept",[DeptController::class,"viewDept"]);

//add department
Route::post("/adddepart",[DeptController::class,"adddep"]);

//delete department
Route::post("/deldepart",[DeptController::class,"deldep"]);

//edit or update
Route::post("/updatedep",[DeptController::class,"updatedep"]);

