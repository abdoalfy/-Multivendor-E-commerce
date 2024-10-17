<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConverter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class CurrencyConverterController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'currency_code'=>'required|size:3|string',
        ]);
        $basecurrency=config('app.currency'); 
        $currency_code=$request->input('currency_code');

        $cachkey='currency_rate_' . $currency_code;
        $rate=Cache::get($cachkey,0);
        
        if(!$rate){
            $converter=new CurrencyConverter(config('services.currency.api_key'));
            $rate=$converter->convert($basecurrency,$currency_code); 
            Cache::put($cachkey,$rate,now()->addMinute(60));
        }
        Session::put('currency_code',$currency_code);    
        return redirect()->back();
    }
}
 