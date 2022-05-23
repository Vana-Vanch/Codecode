<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Please;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\ProfileReviewController;
use App\Http\Controllers\ReviewController;
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
//All assignment List
Route::get('/assignmentlist', [AssignmentController::class, 'getAssignment']);
//Create Assignment
Route::post('/assignmentcreate', [AssignmentController::class, 'createAssignment']);
//Get One Assignment
Route::get('/oneassignment/{id}', [AssignmentController::class, 'getoneAssignment']);
//Submit an Assignment
Route::middleware('auth:sanctum')->post('/submit/{id}', [SubmitAssignment::class, 'store']);
//Get all Submissions
Route::get('/getsubmit', [SubmitAssignment::class, 'getSubmit']);
//Get Particular submission
Route::middleware('auth:sanctum')->get('/onesubmit/{id}', [SubmitAssignment::class, 'getOneSubmit']);
//Check whether a user has submission on a particular assignment
Route::middleware('auth:sanctum')->get('/checksubmit/{id}', [SubmitAssignment::class, 'checkSubmit']);
//Profile Assignment
Route::middleware('auth:sanctum')->get('/myassignments', [AssignmentController::class,'profileAssignment']);
Route::middleware('auth:sanctum')->get('/parassignment', [AssignmentController::class, 'forallassignment']);
//Get Particular students code
Route::post('/studentcode/{id}', [ReviewController::class, 'getStudentCode']);
//Make review



Route::post('/review/{id}', [ReviewController::class, 'reviewStore']);


//Get all Users
Route::get('/allusers',[AdminController::class, 'allUsers']);
//get submission List of one assignment
Route::post('/sublist/{id}', [AdminController::class, 'assignmentSubList']);
//check assignment present
Route::post('/checkthis/{id}', [ReviewController::class, 'checkassignment']);


//Announcements
Route::get('/allannouncements', [AnnouncementController::class, 'getAll']);

Route::post('postAnnouncement', [AnnouncementController::class, 'storeAnnouncement']);

Route::post('/removeAnnouncement/{id}', [AnnouncementController::class, 'removeAnnouncement']);


//Review Profile Return

// Route::get('/mymarks', [ProfileReviewController::class, 'returnMarks']);

Route::middleware('auth:sanctum')->get('/mymarks', [ProfileReviewController::class, 'returnMarks']);

Route::middleware('auth:sanctum')->post('/oneReview/{id}', [ProfileReviewController::class, 'checkRatings']);