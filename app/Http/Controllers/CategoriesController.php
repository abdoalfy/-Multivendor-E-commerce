<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // if(Gate::allows('categories.create')){
        //  return abort(403);
        //     };

        $query=Category::query();
        if($name=$request->query('name')){
            $query->where('name','LIKE',"%$name%");
        }
        if($status=$request->query('status')){
            $query->where('status','=',$status);
        }
        // $categories=Category::with('parent')->withCount('products')->leftJoin('categories as parents','parents.id','=','categories.parent_id')->select([
        //     'categories.*',
        //     'parents.name as  parent_name'
        //    ])->paginate(4);
      
        $categories=Category::with('parent')->withCount('products')->paginate(4);
        return view('Dashbord.index',compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     */

     public function showdeleted()
     {
        $categories=Category::onlyTrashed()->get();
        return view('Dashbord.deleted' , compact('categories'));
     }

     public function restore($id){
        Category::withTrashed()->where('id',$id)->restore();
        return redirect()->back();
        }

        public function forceDelete($id){
         $cat=Category::withTrashed()->where('id',$id)->forceDelete();
                return redirect()->back();
           }

    public function create()
    {
        $parents=Category::all();
        return view('Dashbord.create',compact('parents'));
    }

    public function store(Request $request)
    {
       $request->validate(Category::rules());

        $request->merge([
            'slug'=> Str::slug($request->name),
        ]);

        $data=$request->except('cat_img');

        if($request->hasFile('cat_img')){
         $file=$request->file('cat_img');
         $path=$file->store('uploads',[
            'disk'=> 'public'
         ]);
         $data['cat_img']=$path;
        }
        Category::create($data);
       return redirect()->route('categories.index')->with('success' , 'Category Inserted SuccessFully'); 
       }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
                return view('Dashbord.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    $parents=Category::where('id','<>',$id)->where(function($quary) use ($id){
    $quary->whereNull('parent_id')->orwhere('parent_id','<>',$id);
    })->get();

    $category=Category::findorfail($id);
     return view('Dashbord.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Category::rules());
        $category=Category::findorfail($id);
        $old_image=$category->cat_img;
        $data=$request->except('cat_img');
        if($request->hasFile('cat_img')){
            $file=$request->file('cat_img');
            $path=$file->store('uploads',[
               'disk'=> 'public'
            ]);
            $data['cat_img']=$path;
           }

        $category->update($data);
        
        if($old_image && isset($data['cat_img'])){
            Storage::disk('public')->delete($old_image);
               }

        return redirect()->route('categories.index')->with('success','Category Updated SuccessFully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id)
    {

       $cat= Category::findorfail($id);
       $cat->delete();
       return redirect()->route('categories.index')->with('danger','Category Has Been Deleted!');
    }
}
