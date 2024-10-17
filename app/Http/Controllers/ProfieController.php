<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JetBrains\PhpStorm\Language;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;
class ProfieController extends Controller
{

  public function edit(){
      $user=Auth::user();
      return view('Dashbord.userprofile', [
        'user'=> $user,
        'countries'=>Countries::getNames(),
        'locales' => Languages::getNames(),
      ]);
  }

  public function update(Request $request){
             $request->validate([
            'fitrst_name'=>'required|string|max:255',
            'last_name'=>'required|string|max:255',
            'birthday'=>'required|string|before:today',
            'gender'=>'in:male,female',
            'country'=>'required|string|size:2',
        ]); 
        $user=Auth::user();
        $user->profile->fill($request->all())->save();
        return redirect()->route('profileeedit')->with('success','sdata has been updated');
    }
}
