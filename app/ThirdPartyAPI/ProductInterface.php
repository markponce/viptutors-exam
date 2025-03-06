<?php
namespace App\ThirdPartyAPI;

use Illuminate\Http\Response;

interface ProductInterface {
    public function addProduct(): Response;
    
}