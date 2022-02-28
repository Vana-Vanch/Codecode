<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function allUsers(){
        $users = User::all();
        return response([
            'users' => $users
        ]);
    }



    public function assignmentSubList($id){
        $main = Assignment::find($id);
        $list = Submission::where('assignments_id', $id)->get();
        return response([
            'main' => $main,
            'list' => $list
        ]);
    }

    // public function getTheUser($id){
    //     $oneUser = 
    // }


}
