<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = [];
        if (Auth::user()->isAdmin() === true) {
            $products = Product::with('user')->get();
        } else {
            $userId = Auth::user()->id;
            $products = Product::with('user')->where('user_id', $userId)->get();
        }
        return view('product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        Gate::authorize('create', Product::class);
        $data = $request->only(['title','body']);
        $product = new Product($data);
        Auth::user()->products()->save($product);
        return redirect(route('product.show', ['product' => $product->id]))->with('status', "New Product has been created.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Product $product)
    {
        Gate::authorize('view', [$product]);
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        Gate::authorize('update', [$product]);
        $product->title = $request->input('title');
        $product->body = $request->input('body');
        $product->save();

        return redirect(route('product.show', ['product' => $product->id]))->with('status', "Product ID # {$product->id} has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        Gate::authorize('delete', $product);
        $id = $product->id;
        $product->del_flag = 1;
        $product->save();
        return redirect(route('product.index'))->with('status', "Product ID # $id has been deleted.");

    }
}
