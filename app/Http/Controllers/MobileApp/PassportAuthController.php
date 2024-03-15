<?php

namespace App\Http\Controllers\MobileApp;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class PassportAuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:8',
            'role' => 'required|string|in:admin,prof,student'

        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>$request->role
        ]);
        $token = $user->createToken('Eman')->accessToken;
        return response()->json(['token'=>$token],200);
    }

    public function login(Request $request){
        $data=[
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if (auth()->attempt($data)) {
            $token = $request->user()->createToken('Eman')->accessToken;
            return response()->json(['Token'=>$token],200);
        }else{
        return response()->json(['error'=>'unauthorized'],401);
        }
    }

}



