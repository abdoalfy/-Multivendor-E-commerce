<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
    // protected function credentials(Request $request){
    //     return ['email'=> $request->email ,'password'=>$request->password ,'status'=>'active'];
    // }

    public function authenticate($request)
    {
        $username = $request->post( config('fortify.username') );
        $password = $request->post('password');
        $user = Admin::where('status', 'active')->Where('email', '=', $username)->first();
       if ($user && Hash::check($password, $user->password)) {
            return $user;
        }
        return false;
    }
}