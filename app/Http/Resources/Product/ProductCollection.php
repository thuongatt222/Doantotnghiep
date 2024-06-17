<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function ($product) {
                return [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'description' => $product->description,
                    'price' => $product->price,
                    'discount' => $product->discount,
                    'status' => $product->status,
                    'image' => $product->image,
                    'brand' => $product->brand,
                    'category' => $product->category,
                    'product_details_count' => $product->product_details_count,
                    'total_quantity' => $product->total_quantity, 
                    'created_at' => $product->created_at, 
                    'product_details' => $product->productDetails->map(function ($detail) {
                        return [
                            'product_detail_id' => $detail->product_detail_id,
                            'color' => $detail->color,
                            'size' => $detail->size,
                            'quantity' => $detail->quantity,
                            'status' => $detail->status,
                        ];
                    }),
                ];
            }),
        ];
    }
}
