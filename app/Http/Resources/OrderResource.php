<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "product_id" => $this->product_id,
            'product_name' => $this->product ? $this->product->name : 'Unknown Product',
            'product_image' => $this->product ? $this->product->image : 'Unknown Image', 
            'product_price' => $this->product ? $this->product->price : 'Unknown Price',
            "name" => $this->name,
            "email" => $this->email,
            "address" => $this->address,
            "city" => $this->city,
            "zip_code" => $this->zip_code,
            "phone" => $this->phone,
        ];
    }
}
