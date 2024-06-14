<?php

namespace App\Http\Resources\Size;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'size_id' => $this->size_id,
            'size' => $this->size,
            'status' => $this->status,
        ];
    }
}
