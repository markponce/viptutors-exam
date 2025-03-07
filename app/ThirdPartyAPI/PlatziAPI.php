<?php

namespace App\ThirdPartyAPI;

use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PlatziAPI implements ProductInterface{
    
    // Can be set to env.
    protected string $url = 'https://api.escuelajs.co/api/v1/products/';

    public function __construct(public Product $product)
    {
    }

    public function addProduct(): Response
    {
        $response = Http::post($this->url, [
            'title' => $this->product->title,
            'description' => $this->product->body,
            'categoryId' => 1,
            'price' => 99,
            'images' => [
                'https://api.lorem.space/image/fashion?w=640&h=480&r=4278'
            ]
        ]);

        Log::debug('PlatziAPI Response: ', [
            'status' => $response->status(),
            'body' => $response->body(),
        ]);

        return Response($response->body(), $response->status(), $response->headers());
    }
}