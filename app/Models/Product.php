<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\FuncCall;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'store_id',
		'cat_id',
		'slug',
		'pro_img',	
		'description',
		'price',
		'compare_price',		
		'stats',
    ];

    protected $appends = [
        'image_url',
    ];


public function category(){
    return $this->belongsTo(Category::class,'cat_id','id');
}
public function store(){
    return $this->belongsTo(Store::class);
}

      public function tags(){
        return $this->belongsToMany(Tag::class,'product_tag','product_id','tag_id','id','id');
    }
    
    public static function booted(){
        static::addGlobalScope('store', function(Builder $builder){
           $user=Auth::user();
           if($user && $user->store_id)
           {
            $builder->where('store_id','=', $user->store_id);
           }
        });

        static::creating(function(Product $product){
            $product->slug=Str::slug($product->name);
        });
    }


   

    public function getImageUrlAttribute(){
        if(!$this->pro_img){
          return "https://www.bangladesh-made.com/assets/images/no-product-found.png";
        }
       if(Str::startsWith($this->pro_img,['http://','https://'])){
        return $this->pro_img;
       }
       return asset('storage/' .$this->pro_img);
    }


         public function getDiscountSaleAttribute(){
              if($this->compare_price){
               $disc=round(100 *(($this->price) / ($this->compare_price))-100, 1);
               return $disc;
         }
       }

    public function scopeFilter(Builder $builder,$filters){
        $options=array_merge([
            'cat_id'=>null,
            'store_id'=>null,
            'tag_id'=>null,
            'stats'=>null,
        ],$filters);

        $builder->when($options['stats'],function($query,$status){
           return $query->where('stats',$status); 
        });
        
        $builder->when($options['store_id'], function($builder,$value){
         $builder->where('store_id',$value);
        });

        $builder->when($options['cat_id'],function($builder,$value){
            $builder->where('cat_id',$value);
        });

        $builder->when($options['tag_id'],function($builder, $value) {
            $builder->whereExists(function($query) use ($value) {
                $query->select(1)
                    ->from('product_tag')
                    ->whereRaw('product_id = products.id')
                    ->where('tag_id', $value);
            });

    });
  }
}
