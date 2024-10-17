<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationManue extends Component
{

    public $notifications;
    public $newnotification;
    /**
     * Create a new component instance.
     */
    public function __construct($count=10)
    {
        $user=Auth::user();
        $this->notifications=$user->notifications()->take($count)->get();
        $this->newnotification=$user->unreadNotifications()->count();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notification-manue');
    }
}
