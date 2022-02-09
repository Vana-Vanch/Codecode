<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmitAssignment extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
        
            'zecode'=> 'required'
        ]);

        
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

    public function getSubmit(){
        $submits = Submission::all();
         
        return $submits;
    }

    public function getOneSubmit($id){
        $theone = Submission::find($id);
        $nullified = preg_replace( "/\r|\n/", " ", $theone->userCode );
        return $nullified;
    }
}
