<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function getAssignment(){
        $assignments = Assignment::all();
        return response([
            'assignments' => $assignments
        ]);
    }

    public function createAssignment(Request $request){
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
 
        ]);

        Assignment::create([
            'title' => $request->title,
            'description' => $request->desc,
            'in' => $request->inpt,
            'out' => $request->outpt
        ]);

        return response([
            'message' => 'success'
        ]);
    }

    public function getoneAssignment($id){
        $currentAssignment = Assignment::find($id);
      
        return response([
            'theassignment' => $currentAssignment
        ]);
    }

    public function profileAssignment(){
        $theId = Auth::user()->id;

        $result = Submission::where('user_id', $theId)->get();
        return $result;
        // $assid = Assignment::where('id',$result->assignments_id);
        return response([
            'msg' => $result,
        
        ]);
    }


    public function storeAssignment(Request $request, $id){
        
        // $request->validate([
        //     'zecode' => 'required'
        // ]);


        
        $userId = Auth::user()->id;
        Submission::create([
            'user_id' => $userId,
            'assignments_id' => $id,
            'userCode' => $request->zecode
        ]);
        return response([
            'message' => 'Assignment submitted'
        ]);
    }
}
