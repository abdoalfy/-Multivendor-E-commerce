<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreateNotification extends Notification
{
    use Queueable;
    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order=$order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                     ->subject(" New Order # ". $this->order->oreder_code)
                     ->from('ShipLink@website.com','Ship Link')
                     ->greeting("Dear " . $notifiable->name . ",")
                     ->line("A new order # " . $this->order->oreder_code . " Has been Created by " . $notifiable->name)
                     ->action('View Order', url('/dashborde'))
                     ->line('Thank you for using our application!');
    }


    public function toDatabase(object $notifiable) {
        return[
            'body'=> 'A new order # ' . $this->order->oreder_code . ' Has been Created by ' . $notifiable->name,
            'icon'=>'fas fa-file',
            'ulr'=>url('/dashboard'),
        ];
    }


    public function toBroadcast(object $notifiable) {
        return new BroadcastMessage([
            'body'=> 'A new order # ' . $this->order->oreder_code . ' Has been Created by ' . $notifiable->name,
            'icon'=>'fas fa-file',
            'ulr'=>url('/dashboard'),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
