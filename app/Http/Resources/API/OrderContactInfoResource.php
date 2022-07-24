<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderContactInfoResource extends JsonResource
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
            "name" => $this->name,
            "phone" => $this->phone,
            "address" => $this->address,
            "lat" => $this->lat,
            "lon" => $this->lon,
            "commission" => $this->commission,
            "delivery_fees" => $this->delivery_fees,
        ];
    }
}
