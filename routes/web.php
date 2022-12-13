<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PositionController;

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

//adduser
Route::post("/adduser",[UserController::class,"AddUser"]);

//deluser
Route::post("/deluser",[UserController::class,"DelUser"]);

//edituser
Route::post("/updateuser",[UserController::class,"UpdateUser"]);

//view
Route::get("admin/dept",[DeptController::class,"viewDept"]);

//add department
Route::post("/adddepart",[DeptController::class,"adddep"]);

//delete department
Route::post("/deldepart",[DeptController::class,"deldep"]);

//edit or update
Route::post("/updatedep",[DeptController::class,"updatedep"]);

//position rout

//view
Route::get("admin/position",[PositionController::class,"viewPosition"]);

//Route::get("admin/position",[PositionController::class,"viewPositionDe"]);

//add department
Route::post("/addposition",[PositionController::class,"addPosition"]);

//delete department
Route::post("/delposition",[PositionController::class,"delPosition"]);

//edit or update
Route::post("/updateposition",[PositionController::class,"updatePosition"]);

//member
Route::get("admin/member",[MemberController::class,"viewMember"]);