<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
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
            'stream_name' => $this->stream_name,
            'property_id' => $this->property_id,
            'issue_date' => $this->issue_date,
            'next_due_date' => $this->next_due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
