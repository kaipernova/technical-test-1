<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'organisation' => $this->organisation,
            'property_type' => $this->property_type,
            'parent_property_id' => $this->parent_property_id,
            'uprn' => $this->uprn,
            'address' => $this->address,
            'town' => $this->town,
            'postcode' => $this->postcode,
            'live' => $this->live,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
