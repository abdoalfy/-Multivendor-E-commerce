<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function  index(){
        
    }

    public function show(Product $product){
        return view('front.single',compact('product'));
    }
    

}
