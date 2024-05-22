<?php

namespace App\Http\Resources\Payment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'payment_method_id' => $this->payment_method_id,
            'payment_method' => $this->payment_method,
            'status' => $this->status,
            'note' => $this->note,
        ];
    }
}
