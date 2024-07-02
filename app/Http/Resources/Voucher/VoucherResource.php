<?php

namespace App\Http\Resources\Voucher;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoucherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'voucher_id' => $this->voucher_id,
            'voucher' => $this->voucher,
            'voucher_code' => $this->voucher_code,
            'quantity' => $this->quantity,
            'start_day' => $this->start_day,
            'end_day' => $this->end_day,
            'status' => $this->status,
        ];
    }
}
