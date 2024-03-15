<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileApp\AdminController;
use App\Http\Controllers\MobileApp\ProfController;
use App\Http\Controllers\MobileApp\PassportAuthController;
use App\Http\Controllers\MobileApp\StudentController;
/*
|--------------------------------------------------------------------------
| API Route
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);


Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('admin/standards', [AdminController::class, 'showAllStandards']);
    Route::post('admin/storeStandard', [AdminController::class, 'storeQualityStandard']);
    Route::put('admin/updateStandard/{id}', [AdminController::class, 'updateQualityStandard']);
    Route::delete('admin/deleteStandard/{id}', [AdminController::class, 'destroyQualityStandard']);
    Route::get('admin/reports', [AdminController::class, 'showAllReports']);
    Route::get('admin/showReport/{id}', [AdminController::class, 'showReport']);
    Route::get('admin/courses', [AdminController::class, 'showAllCourses']);
    Route::get('admin/showCourse/{id}', [AdminController::class, 'showCourse']);

});

Route::middleware(['auth:api', 'role:prof'])->group(function () {
    Route::get('prof/standards', [ProfController::class, 'showAllStandards']);
    Route::post('prof/storeReport', [ProfController::class, 'storeReport']);
    Route::put('prof/updateReport/{id}', [ProfController::class, 'updateReport']);
    Route::get('prof/showReport/{id}', [ProfController::class, 'showReport']);
    Route::post('prof/storeCourse', [ProfController::class, 'storeCourse']);
    Route::put('prof/updateCourse/{id}', [ProfController::class, 'updateCourse']);
    Route::get('prof/showCourse/{id}', [ProfController::class, 'showCourse']);


});

Route::middleware(['auth:api', 'role:student'])->group(function () {
    Route::get('student/standards', [StudentController::class, 'showAllStandards']);
    Route::get('student/showCourse/{id}', [StudentController::class, 'showCourse']);
    Route::get('student/courses', [StudentController::class, 'showAllCourses']);


});










