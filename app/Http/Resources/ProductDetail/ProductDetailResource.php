<?php

namespace App\Http\Resources\ProductDetail;

use App\Http\Resources\Color\ColorResource;
use App\Http\Resources\Size\SizeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_detail_id' => $this->product_detail_id,
            'product_id' => $this->product_id,
            'color' => new ColorResource($this->whenLoaded('color')),
            'size' => new SizeResource($this->whenLoaded('size')),
            'quantity' => $this->quantity,
            'status' => $this->status,
        ];
    }
}
