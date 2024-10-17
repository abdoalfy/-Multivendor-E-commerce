<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
            $products=Product::paginate(10);
            return view('Dashbord.productindex',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user=Auth::user();
        if($user->store_id){
        $product=Product::where('store_id','=',$user->store_id)->findOrFail($id);
        }
        else{
        $prod=Product::findOrFail($id);
        $tags=implode(',', $prod->tags()->pluck('name')->toArray());
        return view('Dashbord.productedit',compact('prod','tags'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $product->update($request->except('tags'));
         $tags=explode(',', $request->input('tags'));
         $tag_ids=[];
         foreach($tags as $t_name){
         $slug=Str::slug($t_name);
         $tag=Tag::where('slug',$slug)->first();
         if(!$tag){
         $tag =Tag::create([
            'name'=>$t_name,
            'slug'=>$slug, 
         ]);
         }
         $tag_ids[]=$tag->id;
        }
        $product->tags()->sync($tag_ids);
         return redirect()->route('products.index')->with('success','product updated successfully..!');
    }   



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
