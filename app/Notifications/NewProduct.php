<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class NewProduct extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Product $product)
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    ->subject("New Product {$this->product->title} Created by {$this->product->user->name}!")
                    ->greeting("New Product {$this->product->title} Created by {$this->product->user->name}!")
                    ->line(Str::limit("Product Body: {$this->product->title}", 50))
                    ->action('Go to Product ', url(route('product.show', ['product' => $this->product->id])))
                    ->line('Thank you!');
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
