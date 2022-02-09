<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Please;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\SubmitAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    $user = $request->user();
    $aid = Auth::user()->id;

    return response([
        'id' => $aid,
        'message' => 'success',
        'user' => $user
    ]);
});

    Route::get('/check', function(){
        return response([
            'message' => 'You is an admin'
        ]);
    })->middleware('auth:sanctum');



Route::post('/practice', [PracticeController::class,'practiceCode']);
Route::get('/come', function(){
    return "Yep man";
});


//Assignment

Route::get('/assignmentlist', [AssignmentController::class, 'getAssignment']);
Route::post('/assignmentcreate', [AssignmentController::class, 'createAssignment']);
Route::get('/oneassignment/{id}', [AssignmentController::class, 'getoneAssignment']);
Route::middleware('auth:sanctum')->post('/submit/{id}', [SubmitAssignment::class, 'store']);
Route::get('/getsubmit', [SubmitAssignment::class, 'getSubmit']);
Route::get('/onesubmit/{id}', [SubmitAssignment::class, 'getOneSubmit']);

