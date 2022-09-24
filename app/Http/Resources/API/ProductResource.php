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
            'price' => number_format($this->price, 1),
            'discount' => number_format($this->discount, 1),
            'net_price' => number_format(($this->price - ($this->price * ($this->discount / 100))), 1),
            'image' => getFullImagePath($this),
        ];
    }
}
