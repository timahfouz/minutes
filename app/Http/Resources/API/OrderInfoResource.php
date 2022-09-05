<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderInfoResource extends JsonResource
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
            'status' => $this->status,
            'status_tr' => translateStatus($this->status),
            'ordered_at' => $this->created_at->format('d/m/Y'),
            'is_special' => (bool)$this->is_special,
            'cost' => $this->total_cost,
            'total_cost' => ($this->total_cost + $this->info->commission + $this->info->delivery_fees),
            'description' => $this->info->description,
            'image' => getFullImagePath($this->info),
            'order_info' => new OrderContactInfoResource($this->info),
            'items' => $this->items() //$this->cart_id ? $this->items() : [],
        ];
    }
}
