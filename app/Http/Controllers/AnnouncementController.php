<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function getAll(){
        $announcement = Announcement::all();
        return response([
            'announcement' => $announcement
        ]);
    } 

    public function storeAnnouncement(Request $request){
        $theann = $request->validate([
            'announceBody' => 'required'
        ]);

        Announcement::create([
            'theBody' => $theann['announceBody']
        ]);

        return response([
            'message' => 'success'
        ]);
    }

    public function removeAnnouncement($id){
        $thisOne = Announcement::find($id);
        $thisOne->delete();
        return "Success";
    }
}


