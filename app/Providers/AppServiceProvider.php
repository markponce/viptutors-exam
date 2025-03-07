<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use App\ThirdPartyAPI\FakeStoreAPI;
use App\ThirdPartyAPI\PlatziAPI;
use App\ThirdPartyAPI\ProductInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductInterface::class, function ($app, $parameters) {
            // return FakeStoreAPI($parameters['product']);
            return new PlatziAPI($parameters['product']);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Product::class, ProductPolicy::class);

    }
}
