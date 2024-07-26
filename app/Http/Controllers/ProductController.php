<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Mail\ProductMail; 
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(
            Product::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request, User $user)
    {
        $product = Product::create(array_merge(
            $request->validated(),
            ['user_id' => $user->id]
        ));
        Mail::to('zobirofkir19@gmail.com')->send(new ProductMail($request->validated()));
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Product $product)
    {
        $user->products->contains($product);
        return ProductResource::make($product);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, User $user, Product $product)
    {
        $product->update($request->validated());
    
        return ProductResource::make($product->refresh());
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, Product $product)
    {
        return $user->products->contains(
            $product->delete()
        );
    }
}
