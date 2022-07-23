<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'unit' => $this->unit,
            'price' => $this->price,
            'discount' => $this->discount,
            'net_price' => $this->price - ($this->price * ($this->discount / 100)),
            'image' => getFullImagePath($this),
        ];
    }
}
