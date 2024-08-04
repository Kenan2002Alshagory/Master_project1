<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request){
        $user= User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);
        $token=$user->createToken('token')->plainTextToken;
        return response()->json([
            "message"=>"register is true",
            "token"=>$token,
            "user"=>$user
        ],200);
    }

    public function login(LoginRequest $request){
            $data = $request->all();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                $user= Auth::user();
                $token =  $user->createToken('token')->plainTextToken;
                return response()->json([
                    "message"=>"Login is true",
                    'token'=>$token,
                    'user'=>$user,
                ]);
            }
            return response()->json([
                'message' => 'your email or password rong'
            ]);
    }



    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'message'=>"logout sucsses"
        ]);
    }

}

