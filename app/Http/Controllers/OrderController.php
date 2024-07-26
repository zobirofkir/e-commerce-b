<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(
            Order::with('product')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request, Product $product)
    {
        $order = Order::create(array_merge(
            $request->validated(),
            ["product_id" => $product->id]
        ));
        $orderResource = OrderResource::make($order);    
        Mail::to('zobirofkir19@gmail.com')->send(new OrderMail($orderResource->toArray($request)));
        return $order;
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Product $product ,Order $order)
    {
        $product->orders->contains($order);
        return OrderResource::make($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request,Product $product, Order $order)
    {
        $product->orders->contains($order);

        $order->update($request->validated());
        
        return OrderResource::make($order->refresh());
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product , Order $order)
    {
        $product->orders->contains($order);
        return $order->delete();
    }
}
