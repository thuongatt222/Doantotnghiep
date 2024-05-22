<?php

namespace App\Http\Resources\Discount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscountResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'discount_id' => $this->discount_id,
            'discount' => $this->discount,
            'start_day' => $this->start_day,
            'end_day' => $this->end_day,
            'status' => $this->status,
            'note' => $this->note,
        ];
    }
}
