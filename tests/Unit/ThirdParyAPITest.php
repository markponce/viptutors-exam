<?php

use App\Models\Product;
use App\ThirdPartyAPI\FakeStoreAPI;
use App\ThirdPartyAPI\PlatziAPI;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

test('test PlatziAPI', function () {
    $product = Product::factory()->createQuietly();
    Log::debug('product created!', $product->toArray());
    $response = (new PlatziAPI($product))->addProduct();
    $statusCode = $response->status();
    expect($statusCode == Response::HTTP_CREATED)->toBeTrue();
});

test('test FakeStoreAPI', function () {
    $product = Product::factory()->createQuietly();
    Log::debug('product created!', $product->toArray());
    $response = (new FakeStoreAPI($product))->addProduct();
    $statusCode = $response->status();
    expect($statusCode == Response::HTTP_OK)->toBeTrue();
});
