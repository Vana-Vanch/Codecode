<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmitAssignment extends Controller
{
    public function store(Request $request, $id){
        $request->validate([
        
            'zecode'=> 'required',
            'language' => 'required'
        ]);

        
        $userId = Auth::user()->id;
        $assignment = Assignment::find($id);
       
        $assignmentName = $assignment->title;
        $theCode = $request->zecode;
        $lang = $request->language;
        $destination = public_path()."/storage/submits/";
        $file = $userId.'-'.$id;
        if (!is_dir($destination)) {  mkdir($destination,0777,true);  }
        if($lang=='c'){
            $withExt = $file.'.c';
            File::put($destination.$withExt,$theCode);
            Submission::create([
                'user_id' => $userId,
                'assignments_id' => $id,
                'userCode' => $withExt
            ]);
            return response([
                'message' => 'Assignment submitted'
            ]);
        }else if($lang == 'cpp'){
            $withExt = $file.'.cpp';
            File::put($destination.$withExt,$theCode);
            Submission::create([
                'user_id' => $userId,
                'assignments_id' => $id,
                'userCode' => $withExt,
                'title' => $assignmentName
            ]);
            return response([
                'message' => 'Assignment submitted'
            ]);
        }else if($lang == 'python'){
            $withExt = $file.'.python';
            File::put($destination.$withExt,$theCode);
            Submission::create([
                'user_id' => $userId,
                'assignments_id' => $id,
                'userCode' => $withExt,
                'title' => $assignmentName
            ]);
            return response([
                'message' => 'Assignment submitted'
            ]);
        }else if($lang == 'php'){
            $withExt = $file.'.php';
            File::put($destination.$withExt,$theCode);
            Submission::create([
                'user_id' => $userId,
                'assignments_id' => $id,
                'userCode' => $withExt,
                'title' => $assignmentName
            ]);
            return response([
                'message' => 'Assignment submitted'
            ]);
        }else if($lang == 'javascript'){
            $withExt = $file.'.js';
            File::put($destination.$withExt,$theCode);
            Submission::create([
                'user_id' => $userId,
                'assignments_id' => $id,
                'userCode' => $withExt,
                'title' => $assignmentName
            ]);
            return response([
                'message' => 'Assignment submitted'
            ]);
        }
    }

    public function getSubmit(){
        $submits = Submission::all();
         
        return response([
            'assignments' => $submits
        ]);
    }

    public function getOneSubmit($id){
        $userId = Auth::user()->id;
        $theone = Submission::where('assignments_id',$id)->where('user_id',$userId)->get();
        $assignment = Assignment::find($id);
        $output = null;
        $retval = null;
        $filename = $theone[0]->userCode;
        $command = 'cat /home/vana/Study/laravel/codecode/public/storage/submits/'.$filename;
        exec($command,$output,$retval);
        return response([
            'theUser' => $theone,
            'assignment' => $assignment,
            'code' => $output
        ]);
    }   

    public function checkSubmit($id){
        $uId = Auth::user()->id;
  
            $theAssignment = Submission::where('assignments_id', $id)->where('user_id', $uId)->get();
            if(count($theAssignment) === 0){
                return response([
                    'message' => 'null'
                ]);
            }else{
                $filename = $theAssignment[0]->userCode;
                $output = null;
                $retval = null;
             
                $command = 'cat /home/vana/Study/laravel/codecode/public/storage/submits/'.$filename;
                exec($command,$output,$retval);
                return response([
                    'message' => 'submitted',
                    'current' => $theAssignment,
                    'code' => $output
                ]);
            }
        
      
            
        
    }
}
