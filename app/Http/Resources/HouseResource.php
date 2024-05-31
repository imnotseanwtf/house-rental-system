<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\HouseTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'house_number' => $this->house_number,
            'description' => $this->description,
            'price' => $this->price,
            'houseType' => new HouseTypeResource($this->whenLoaded('houseType')),
        ];
    }
}
