<?php
namespace App\Services;
use Illuminate\Support\Facades\Http;
class CurrencyConverter
{
     private $apikye;
     protected $baseurl = 'https://free.currconv.com/api/v7';
    public function __construct($apikye){
     $this->apikye=$apikye;
    }

    public function convert($from,$to,$amount=1){
        $q="{$from}_{$to}";
       $response = Http::baseUrl($this->baseurl)->get('/convert',[
           'q'=>$q,
           'compact'=>"y",
           'apikey'=>$this->apikye,
    ]);
       $result=$response->json();
        return $result[$q]['val'] * $amount;
    }
}