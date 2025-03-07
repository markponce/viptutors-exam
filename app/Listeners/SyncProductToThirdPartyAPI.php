<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\ThirdPartyAPI\ProductInterface;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SyncProductToThirdPartyAPI implements ShouldQueue
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
        $productApi = app()->makeWith(ProductInterface::class, ['product' => $event->product]);
        $productApi->addProduct();
    }
}
