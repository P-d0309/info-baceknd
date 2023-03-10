<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GeneralController;
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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('students', [GeneralController::class, 'getStudents'])->name('getStudents');
Route::get('get-result', [GeneralController::class, 'getResult'])->name('getResult');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
Route::get('pdf/{id}', [GeneralController::class, 'getMarksPdf'])->name('getMarksPdf');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('get-excel', [GeneralController::class, 'getExcel'])->name('getExcel');
    Route::get('get-pdf/{id}', [GeneralController::class, 'getMarksPdf'])->name('getMarksPdf');
    Route::post('set-marks', [GeneralController::class, 'setMarks'])->name('setMarks');

    Route::post('student', [GeneralController::class, 'storeStudent'])->name('storeStudent');

    Route::post('student/{id}', [GeneralController::class, 'updateStudent'])->name('updateStudent');
    Route::delete('student/{id}', [GeneralController::class, 'deleteStudent'])->name('deleteStudent');
    Route::delete('student/{id}/permanent', [GeneralController::class, 'permanentlyDeleteStudent'])->name('permanentlyDeleteStudent');
});
