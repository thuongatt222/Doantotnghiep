<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\ProductDetail\ProductDetailResource;
use App\Http\Resources\Review\ReviewResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'product_name' => $this->product_name,
            'description' => $this->description,
            'discount' => $this->discount,
            'price' => $this->price,
            'image' => $this->image,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'product_details' => ProductDetailResource::collection($this->whenLoaded('productDetails')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
            'total_quantity' => $this->total_quantity,
        ];
    }
}
