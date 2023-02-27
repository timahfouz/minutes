<?php

namespace App\Http\Resources\API;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'phone' => $this->phone,
            'is_active' => (bool)$this->active,
            // 'activation_code' => $this->activation_code,
            'governorate' => [
                'id' => $this->governorate_id,
                'name' => $this->governorate->name
            ],
            'city' => [
                'id' => $this->city_id,
                'name' => $this->city->name
            ],
            'area' => [
                'id' => $this->area_id,
                'name' => $this->area->name
            ],
            'image' => getFullImagePath($this),
            'access_token' => $this->when($this->access_token, $this->access_token)
        ];
    }
}
