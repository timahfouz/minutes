<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'is_special' => (bool)$this->is_special,
            'ordered_at' => $this->created_at->format('d/m/Y'),
            'carrier_phone' => $this->carrier->phone,
        ];
    }
}
