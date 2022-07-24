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
            'ordered_at' => $this->created_at->format('d/m/Y'),
            'order_info' => new OrderContactInfoResource($this->info),
            'cost' => $this->total_cost,
            'total_cost' => ($this->total_cost + $this->info->commission + $this->info->delivery_fees),
            'items' => $this->items()
        ];
    }
}
