<?php

namespace App\ThirdPartyAPI;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FakeStoreAPI implements ProductInterface{
    
    // Can be set to env.
    protected string $url = 'https://fakestoreapi.com/products';

    public function __construct(public Product $product)
    {
    }

    public function addProduct(): Response
    {
        $response = Http::post($this->url, [
            'title' => $this->product->title,
            'description' => $this->product->body,
            'price' => 91,
            'catagory' => 'Uncategorized',
            'image' => "https://api.lorem.space/image/furniture?w=640&h=480&r=8528",
        ]);

        Log::debug('FakeStoreAPI Response: ', [$response->body(), $response->status()]);
        return Response($response->body(), $response->status(), $response->headers());
    }
}