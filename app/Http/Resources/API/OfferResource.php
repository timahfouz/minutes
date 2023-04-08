<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
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
            'id' => (int)$this->id,
            'name' => $this->name ?? '',
            'category' => [
                'id' => (int)$this->category_id,
                'name' => $this->category_name,
            ],
            'title' => $this->title ?? '',
            'unit' => $this->new_unit,
            'in_stock' => $this->in_stock,
            'old_price' => number_format($this->price, 1),
            'price' => number_format($this->new_price, 1),
            'saving' => number_format($this->price - $this->new_price, 1),
            'discount' => number_format((($this->price - $this->new_price) / $this->price)  * 100, 1),
            'image' => $this->image_path ?? '',
        ];
    }
}
