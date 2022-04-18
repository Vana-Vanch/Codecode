<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileReviewController extends Controller
{
    public function returnMarks(){
        $currUser = Auth::user();
        $userReviews = Review::where('user_id', $currUser->id)->get();
        return $userReviews;
    }

    public function checkRatings(Request $request,$id){
        $currUser = Auth::user();
        $ratings = Review::where('assignments_id', $id)->where('user_id',$currUser->id)->get();
        if(count($ratings)>0){
            return response(
                [
                    'message' => $ratings
                ]
            );
        }else{
            return response([
                'message' => 'NULL'
            ]);
        }
       
    }
}
