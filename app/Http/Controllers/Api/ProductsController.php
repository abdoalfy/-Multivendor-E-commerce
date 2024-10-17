<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ProductsController extends Controller
{

    public function __construct()
    {
     $this->middleware('auth:sanctum')->except('index','show');   
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products= Product::filter($request->query())->with('category:id,name','store','tags')->paginate();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Product $product)
    {
       $request->validate([
        'name'=>'required|string|max:255',
        'description'=>'nullable|string|max:255',
        'cat_id'=>'|required|exists:categories,id',
        'stats'=>'|in:active,inactive',
        'price'=>'required|numeric|min:0',
        'compare_price'=>'nullable|numeric|gat:price',
       ]);
       $product->create($request->all());
    //   return Product::create([$request->all()]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
        // return Product::findOrFail($id)->with('category:id,name','store')->first();
       //  return $product->load('category:id,name','store');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        $request->validate([
            'name'=>'sometimes|required|string|max:255',
            'description'=>'nullable|string|max:255',
            'cat_id'=>'sometimes|required|exists:categories,id',
            'stats'=>'|in:active,inactive',
            'price'=>'sometimes|required|numeric|min:0',
            'compare_price'=>'nullable|numeric|gat:price',
           ]);
          $product->update($request->all());
          return response('product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
     $product->delete();
     return response('product has been deleted');
    }
}
