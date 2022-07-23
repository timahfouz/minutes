<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = $this->product;
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'name' => $product->name,
            'unit' => $this->unit,
            'price' => $this->price,
            'qty' => $this->qty,
            'total_price' => $this->qty * $this->price,
        ];
    }
}
