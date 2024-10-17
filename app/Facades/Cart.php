<?php
namespace App\Facades;
use App\Repository\Cart\CartRepository;
use Illuminate\Support\Facades\Facade;

class Cart extends Facade{

   /**
    * 
    *  @return string
    */
    protected static function getFacadeAccessor()
    {
        return CartRepository::class;
    }
} 
