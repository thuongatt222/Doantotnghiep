<?php

namespace App\Http\Resources\Review;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ReviewCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->map(function($review) {
                return [
                    'review_id' => $review->review_id,
                    'review' => $review->review,
                    'evaluation' => $review->evaluation,
                    'product_id' => $review->product_id,
                    'user' =>  $review->user ? [
                        'id' => $review->user->user_id,
                        'name' => $review->user->name,
                        'avatar' => $review->user->avatar,
                    ] : null,
                ];
            }),
        ];
    }
}
