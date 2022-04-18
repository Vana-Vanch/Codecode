<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function getStudentCode(Request $request,$id){
       
   
        $assignment = Submission::where('uname',$request->stuName)->where('assignments_id',$id)->get();
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
   
        $student = User::where('name', $request->stuName)->first();
        $theId = $student->id;
     
        $assignment = Submission::where('user_id',$student->id)->where('assignments_id',$id)->update(array('marks' => $request->ratings));
        return $assignment;
        Review::create([
            'user_id' => $theId,
            // 'assignments_id' => $assignment[0]->assignments_id,
            'assignments_id' => $id,
            'ratings' => $request->ratings
        ]);
        



        return response([
            'message' => 'success'
        ]);
    }

    public function checkassignment(Request $request,$id){
        $student = User::where('name', $request->stuName)->first();
        $theId = $student->id;
        $isThis = Review::where('user_id', $theId)->where('assignments_id', $id)->get();
    
        if(count($isThis) == 0){
            return 'False';
        }else{
            return 'True';
        }
    }
}
