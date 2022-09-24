<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;
use PhpParser\Node\Expr\Cast\Double;

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
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name,
            ],
            'unit' => $this->unit,
            'price' => (double)$this->price,
            'discount' => (double)$this->discount,
            'net_price' => (double)($this->price - ($this->price * ($this->discount / 100))),
            'image' => getFullImagePath($this),
        ];
    }
}
