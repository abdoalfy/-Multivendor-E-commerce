<?php

namespace App\View\Components;
use App\Repository\Cart\CartRepository;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CartManue extends Component
{

    public $items;
    public $total;
    /**
     * Create a new component instance.
     * @return void
     */
    public function __construct(CartRepository $cart)
    {
        $this->items=$cart->get();
        $this->total=$cart->total();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart-manue');
    }
}
