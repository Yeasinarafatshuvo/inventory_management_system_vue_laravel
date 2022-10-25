<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    //USER REGISTER API -POST
    public function register(Request $request)
    {
        $validation =  $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        if($validation){
            //save admin data
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'status' => 200,
                'message' => 'User Registration Successfully'
            ]);
        }
    }

    //USER LOGIN API -POST
    public function login(Request $request)
    {
        $validation =  $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation){
            if(!$token = auth()->attempt(['email' => $request->email, 'password'=> $request->password ])){
                return response()->json([
                    'status' => '404',
                    'message' => 'Invalid credentials'
                ]);
            }else{
                return response()->json([
                    'status' => 201,
                    'message' => 'Logged in successfully',
                    'access_token' => $token
                ]);
            }
        }
    }


}
