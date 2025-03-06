<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Models\User;
use App\Notifications\NewProduct;
use App\ThirdPartyAPI\FakeStoreAPI;
use App\ThirdPartyAPI\PlatziAPI;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProductCreatedNotifications implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductCreated $event): void
    {
        // User::whereNot('id', $event->chirp->user_id)->cursor()
        $adminUsers = User::where('is_admin', true)->whereNot('id', $event->product->user->id)->cursor();
        foreach($adminUsers as $adminUser) {
            $adminUser->notify(new NewProduct($event->product));
        }
        $event->product->syncToServer(new FakeStoreAPI($event->product));
    }
}
