<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactoryController extends Controller
{
    public function index(){
        $user=Auth::user();
        return view('auth.twofactoryauth',compact('user'));
    }
}
