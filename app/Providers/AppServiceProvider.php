<?php

namespace App\Providers;

use App\Repository\Cart\CartModelRepository;
use App\Repository\Cart\CartRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(CartRepository::class, CartModelRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('filter',function($attribute,$value,$params){
         return ! in_array(strtolower($value),$params);
        }, "this word not avilable");

    Paginator::useBootstrapFive();
    Paginator::useBootstrapFour();

    }
}
