<?php

namespace App\Http\Resources\Shipping;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'shipping_method_id' => $this->shipping_method_id,
            'shipping_method' => $this->shipping_method,
            'status' => $this->status,
            'note' => $this->note,
        ];
    }
}
