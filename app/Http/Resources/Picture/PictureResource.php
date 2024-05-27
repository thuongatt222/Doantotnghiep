<?php

namespace App\Http\Resources\Picture;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PictureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->picture_id,
            'title' => $this->title,
            'image' => $this->image,
            'product_detail_id' => $this->product_detail_id,
        ];
    }
}
