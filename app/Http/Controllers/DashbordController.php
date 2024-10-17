<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;


class DashbordController extends Controller
{
    public function index(){
        return view('layouts.dashbord');
    }
    
}
