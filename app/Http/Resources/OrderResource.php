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
            'product_name' => $this->product ? $this->product->name : 'Unknown Product', // Handle null product
            "name" => $this->name,
            "email" => $this->email,
            "address" => $this->address,
            "city" => $this->city,
            "zip_code" => $this->zip_code,
            "phone" => $this->phone,
        ];
    }
}
