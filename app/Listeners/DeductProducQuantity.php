<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Facades\Cart;
use App\Models\Cart as ModelsCart;
use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class DeductProducQuantity
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // foreach($order->products() as $product){
        //     $product->decrement('quantity',$product->order_item->quantity);
        // }

        foreach(Cart::get() as $item){
            Product::where('id','=',$item->product_id)->update([
                'quantity'=>DB::raw("quantity - {$item->quantity}"),
            ]);
        }
    }
}
