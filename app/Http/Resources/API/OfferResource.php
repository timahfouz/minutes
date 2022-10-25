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
            'id' => $this->id,
            'name' => $this->name,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category_name,
            ],
            'title' => $this->title,
            'unit' => $this->new_unit,
            'old_price' => $this->price,
            'price' => $this->new_price,
            'saving' => $this->price - $this->new_price,
            'discount' => number_format((($this->price - $this->new_price) / $this->price), 2),
            'image' => $this->image_path,
        ];
    }
}
