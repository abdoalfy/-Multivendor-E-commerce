<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Laravel\Sanctum\PersonalAccessToken;

class AccesstokenController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'email'=>'required|email|max:255',
            'password'=>'required|min:6|string',
            'device_name'=>'string|max:255',
        ]);
        $user=User::where('email',$request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
         $device_name=$request->input('device_name',$request->userAgent());
         $token=$user->createToken($device_name);
    
         return Response::json([
            'user'=>$user,
            'token'=>$token->plainTextToken,
         ]);
        }  

        return Response::json([
            'message'=>'un auth user',
        ]);
    }


    
    public function destroy($token = null){
        $user=Auth::guard('sanctum')->user();

        if(null == $token){
           $user->currentAccessToken()->delete(); 
        }

        $personalaccesstoken= PersonalAccessToken::findToken($token);
        if($user->id==$personalaccesstoken->tokenable_id && get_class($user)==$personalaccesstoken->tokenable_type){
            $personalaccesstoken->delete();
        }
    }
}
