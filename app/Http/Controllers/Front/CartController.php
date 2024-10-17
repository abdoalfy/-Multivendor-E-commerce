<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Repository\Cart\CartModelRepository;
use App\Repository\Cart\CartRepository;
use Illuminate\Http\Request;
class CartController extends Controller
{
    // public function index()
    // {
    //   $repository= new CartModelRepository();
    //   $items= $repository->get();
    //   return view('front.cart',compact('items','repository'));
    // }
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','int','min:1'],
        ]);
        $product=Product::findOrFail($request->post('product_id'));
        $repository= new CartModelRepository();
        $repository->add($product,$request->post('quantity'));

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Item added to cart!',
            ], 201);
        }
        return redirect()->route('cart.index')->with('success','Product has been add to the Cart!');
    }

    public function update(Request $request,$id)
    {
  
        $request->validate([
            'quantity'=>['required','integer','min:1'],
        ]);
        $repository=new CartModelRepository();
        $repository->update($id,$request->post('quantity'));

    }
    public function destroy($id)
    {
        $repository=new CartModelRepository();
        $repository->delete($id);
    }
}
