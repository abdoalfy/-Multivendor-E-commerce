<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Category extends Model
{

    use SoftDeletes;
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class ,'cat_id','id');
    }

    public function parent(){
        return $this->belongsTo(Category::class,'parent_id','id')->withDefault([
            'name'=>'Main Category'
        ]);
    }

    public function child(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    
    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'description',
        'cat_img',
        'status',
    ];

    public static function rules(){
        return [
            'name' =>[
            'required',
            'string',
            'max:20',
            // function ($attribute,$value,$fails){
            //     if(strtolower($value)=="admin"){
            //         $fails('this is un avilabel name');
            //     }
            // },
            'filter:admin,lavravel',
        ],
            
            'description' => 'required',
            'parent_id' => 'nullable|int|exists:categories,id',
            'status' => 'required',
            'cat_img' => 'image|max:1048576',

        ];
    }
}
