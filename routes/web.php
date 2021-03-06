<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\RoleController;
use App\Http\Controllers\Blade\PermissionController;
use App\Http\Controllers\Blade\HomeController;
use App\Http\Controllers\Blade\StatusController;
use App\Http\Controllers\Blade\FacultyController;
use App\Http\Controllers\Blade\GroupController;
use App\Http\Controllers\Blade\StudentController;

/*
|--------------------------------------------------------------------------
| Blade (front-end) Routes
|--------------------------------------------------------------------------
|
| Here is we write all routes which are related to web pages
| like UserManagement interfaces, Diagrams and others
|
*/

// Default laravel auth routes
Auth::routes();


// Welcome page
Route::get('/', function (){
    return redirect()->route('home');
})->name('welcome');

// Web pages
Route::group(['middleware' => 'auth'],function (){

    // there should be graphics, diagrams about total conditions
    Route::get('/home', [HomeController::class,'index'])->name('home');

    // Users
    Route::get('/users',[UserController::class,'index'])->name('userIndex');
    Route::get('/user/add',[UserController::class,'add'])->name('userAdd');
    Route::post('/user/create',[UserController::class,'create'])->name('userCreate');
    Route::get('/user/{id}/edit',[UserController::class,'edit'])->name('userEdit');
    Route::post('/user/update/{id}',[UserController::class,'update'])->name('userUpdate');
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('userDestroy');
    Route::get('/user/theme-set/{id}',[UserController::class,'setTheme'])->name('userSetTheme');

    // Permissions
    Route::get('/permissions',[PermissionController::class,'index'])->name('permissionIndex');
    Route::get('/permission/add',[PermissionController::class,'add'])->name('permissionAdd');
    Route::post('/permission/create',[PermissionController::class,'create'])->name('permissionCreate');
    Route::get('/permission/{id}/edit',[PermissionController::class,'edit'])->name('permissionEdit');
    Route::post('/permission/update/{id}',[PermissionController::class,'update'])->name('permissionUpdate');
    Route::delete('/permission/delete/{id}',[PermissionController::class,'destroy'])->name('permissionDestroy');

    // Roles
    Route::get('/roles',[RoleController::class,'index'])->name('roleIndex');
    Route::get('/role/add',[RoleController::class,'add'])->name('roleAdd');
    Route::post('/role/create',[RoleController::class,'create'])->name('roleCreate');
    Route::get('/role/{role_id}/edit',[RoleController::class,'edit'])->name('roleEdit');
    Route::post('/role/update/{role_id}',[RoleController::class,'update'])->name('roleUpdate');
    Route::delete('/role/delete/{id}',[RoleController::class,'destroy'])->name('roleDestroy');

    // Status
   Route::get('/status',[StatusController::class,'index'])->name('statusIndex');
   Route::get('/status/create',[StatusController::class,'create'])->name('statusCreate');
   Route::post('/status/create',[StatusController::class,'store'])->name('statusStore');
   Route::get('/status/edit/{id}',[StatusController::class,'edit'])->name('statusEdit');
   Route::post('/status/update/{id}',[StatusController::class,'update'])->name('statusUpdate');
   Route::delete('/status/destroy/{id}',[StatusController::class,'destroy'])->name('statusDelete');

    // Faculty
    Route::get('/faculty',[FacultyController::class,'index'])->name('facultyIndex');
    Route::get('/faculty/create',[FacultyController::class,'create'])->name('facultyCreate');
    Route::post('/faculty/create',[FacultyController::class,'store'])->name('facultyStore');
    Route::get('/faculty/edit/{id}',[FacultyController::class,'edit'])->name('facultyEdit');
    Route::post('/faculty/update/{id}',[FacultyController::class,'update'])->name('facultyUpdate');
    Route::delete('/faculty/destroy/{id}',[FacultyController::class,'destroy'])->name('facultyDelete');

    // Groups
    Route::get('/group',[GroupController::class,'index'])->name('groupIndex');
    Route::get('/group/create',[GroupController::class,'create'])->name('groupCreate');
    Route::post('/group/create',[GroupController::class,'store'])->name('groupStore');
    Route::get('/group/edit/{id}',[GroupController::class,'edit'])->name('groupEdit');
    Route::post('/group/update/{id}',[GroupController::class,'update'])->name('groupUpdate');
    Route::delete('/group/destroy/{id}',[GroupController::class,'destroy'])->name('groupDelete');

    // Students
    Route::get('/student',[StudentController::class,'index'])->name('studentIndex');
    Route::get('/student/create',[StudentController::class,'create'])->name('studentCreate');
    Route::post('/student/create',[StudentController::class,'store'])->name('studentStore');
    Route::get('/student/edit/{id}',[StudentController::class,'edit'])->name('studentEdit');
    Route::post('/student/update/{id}',[StudentController::class,'update'])->name('studentUpdate');
    Route::delete('/student/destroy/{id}',[StudentController::class,'destroy'])->name('studentDelete');


});

// Change language session condition
Route::get('/language/{lang}',function ($lang){
    $lang = strtolower($lang);
    if ($lang == 'ru' || $lang == 'uz')
    {
        session([
            'locale' => $lang
        ]);
    }
    return redirect()->back();
});

/*
|--------------------------------------------------------------------------
| This is the end of Blade (front-end) Routes
|-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\-\
*/
