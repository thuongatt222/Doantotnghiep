<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'order_id' => $this->order_id,
            'address' => $this->address,
            'phone_number' => $this->phone_number,
            'status' => $this->status,
            'total' => $this->total,
            'user_id' => $this->user_id,
            'employee_id' => $this->employee_id,
            'voucher_id' => $this->voucher_id,
            'created_at' => $this->created_at,
            'order_details' => $this->orderDetails->map(function($orderDetail) {
                return [
                    'order_detail_id' => $orderDetail->order_detail_id,
                    'quantity' => $orderDetail->quantity,
                    'price' => $orderDetail->price,
                    'product_detail_id' => $orderDetail->product_detail_id,
                    'order_id' => $orderDetail->order_id,
                    'product_detail' => [
                        'product_detail_id' => $orderDetail->productDetail->product_detail_id,
                        'quantity' => $orderDetail->productDetail->quantity,
                        'color_id' => $orderDetail->productDetail->color_id,
                        'size_id' => $orderDetail->productDetail->size_id,
                        'product_id' => $orderDetail->productDetail->product_id,
                        'status' => $orderDetail->productDetail->status,
                        'color' => [
                            'color_id' => $orderDetail->productDetail->color->color_id,
                            'status' => $orderDetail->productDetail->color->status,
                            'color' => $orderDetail->productDetail->color->color,
                        ],
                        'size' => [
                            'size_id' => $orderDetail->productDetail->size->size_id,
                            'size' => $orderDetail->productDetail->size->size,
                            'status' => $orderDetail->productDetail->size->status,
                        ],
                        'product' => [
                            'product_id' => $orderDetail->productDetail->product->product_id,
                            'product_name' => $orderDetail->productDetail->product->product_name,
                            'status' => $orderDetail->productDetail->product->status,
                            'description' => $orderDetail->productDetail->product->description,
                            'price' => $orderDetail->productDetail->product->price,
                            'discount' => $orderDetail->productDetail->product->discount,
                            'image' => $orderDetail->productDetail->product->image,
                            'brand_id' => $orderDetail->productDetail->product->brand_id,
                            'category_id' => $orderDetail->productDetail->product->category_id,
                        ]
                    ],
                ];
            }),
            'shipping' => [
                'shipping_method_id' => $this->shipping->shipping_method_id,
                'shipping_method' => $this->shipping->shipping_method,
                'status' => $this->shipping->status,
            ],
            'payment' => [
                'payment_method_id' => $this->payment->payment_method_id,
                'status' => $this->payment->status,
                'payment_method' => $this->payment->payment_method,
            ]
        ];
    }
}
