<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Cart extends Model
{
    public $incrementing = false;
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
        ];
    use HasFactory;

    public static function booted(){
        static::creating(function(Cart $cart){
         $cart->id=Str::uuid();
        });
    }


  public function user(){
    return $this->belongsTo(User::class)->withDefault([
        'name'=>'Anonymous',
    ]);
  }

  public function  product(){
    return $this->belongsTo(Product::class);
  }

   
}
