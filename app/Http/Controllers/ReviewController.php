<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getStudentCode(Request $request,$id){
        $student = User::find($request->stuId);
        $assignment = Submission::where('user_id',$student->id)->where('assignments_id',$id)->get();
        $filename = $assignment[0]->userCode;
        $output = null;
        $retval = null;
        $command = 'cat /home/vana/Study/laravel/codecode/public/storage/submits/'.$filename;
        exec($command,$output,$retval);
        return response([
            'message' => 'success',
            'assignment' => $assignment,
            'code' => $output
        ]);
    }

    public function reviewStore(Request $request,$id){
        $student = User::find($request->stuId);
        $assignment = Submission::where('user_id',$student->id)->where('assignments_id',$id)->get();
        Review::create([
            'user_id' => $student->id,
            'assignments_id' => $assignment[0]->assignments_id,
            'ratings' => $request->ratings
        ]);
        return response([
            'message' => 'success'
        ]);
    }
}
