<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'store_id',
        'user_id',
        'payment_method',
        'order_status',
        'payment_status',
    ];
    use HasFactory;
    public function store(){
        return $this->belongsTo(Store::class,'store_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
           'name' => 'Guest Customer'
        ]);
    }
    public function products(){
        return $this->belongsToMany(Product::class,'order_details','order_id','product_id','id','id')->
        using(OrderDetails::class)->withPivot([
            'product_name','products_price','quantity','options',
        ]);
    }

    public function address(){
        return $this->hasMany(OrderAddress::class);
    }

    public function billingAddress(){
        return $this->hasOne(OrderAddress::class,'order_id','id')->where('type','=','billing');
    }
    public function ShipingAddress(){
        return $this->hasOne(OrderAddress::class,'order_id','id')->where('type','=','shipping');
    }

    protected static function booted(){
        static::creating(function(Order $order){
         $order->oreder_code=Order::getNextOrderNumber();
        });
    }
    public static function getNextOrderNumber(){
        $year=Carbon::now()->year;
        $oreder_code=Order::whereYear('created_at',$year)->max('oreder_code');
        if($oreder_code){
            return $oreder_code + 1;
        }
        return $year . "0001";
    }
}

