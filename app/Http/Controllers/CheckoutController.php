<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $total_price='100';
        $order=Order::create([
            $total_price,
        ]);
        $PaymentKey=PaymobController::pay($order->total_price,$order->id);
        return view('paymob')->with('token',$PaymentKey);
    }
}
