<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function register(Request $request){
        
        $field = $request->validate([
            'name' => 'required|max:255',
            'rollno' => 'required|max:20',
            'email' => 'required',
            'password' => 'required|confirmed'
        ]);
        if($request->ppic){
            
            $imgNewName = time().'-'.$request->name.'.'.$request->ppic->extension();
            $request->ppic->move(public_path('images/profilepics/'),$imgNewName);
            User::create([
                'name' => $field['name'],
                'rollno' => $field['rollno'],
                'email' => $field['email'],
                'profilePicture' => $imgNewName,
                'password' => bcrypt($field['password']),
            ]);
            return response([
                'message' => 'User created',
                'user' => $field
            ]);
      
        }else{
            User::create([
                'name' => $field['name'],
                'rollno' => $field['rollno'],
                'email' => $field['email'],
                'password' => bcrypt($field['password']),
            ]);
    
            return response([
                'message' => 'success',
                'user' => $field
            ]);
        }    
        return response([
            'error' => 'invalid form'
        ]);

    }

    public function login(Request $request){
        if(!Auth::attempt($request->only('email','password'))){
            return response([
                'message' => 'invalid credentials'
            ]);
        }
        $user = Auth::user();
        $token = $user->createToken('appToken')->plainTextToken;
        return response([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ])->withCookie(cookie('jwt',$token,60*24));
    }

    public function logout(Request $request){
        $cookie = Cookie::forget('jwt');
        return response([
            'message' => 'success'
        ])->withCookie($cookie);
    }
}
