<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class OrderCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request $request
     * @return array<int|string, mixed>
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($order) {
                return [
                    'order_id' => $order->order_id,
                    'name' => $order->name,
                    'address' => $order->address,
                    'phone_number' => $order->phone_number,
                    'status' => $order->status,
                    'payment_status' => $order->payment_status,
                    'total' => $order->total,
                    'user_id' => $order->user_id,
                    'employee_id' => $order->employee_id,
                    'voucher_id' => $order->voucher_id,
                    'created_at' => $order->created_at,
                    'order_details' => $order->orderDetails->map(function($orderDetail) {
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
                        'shipping_method_id' => $order->shipping->shipping_method_id,
                        'shipping_method' => $order->shipping->shipping_method,
                        'status' => $order->shipping->status,
                    ],
                    'payment' => [
                        'payment_method_id' => $order->payment->payment_method_id,
                        'status' => $order->payment->status,
                        'payment_method' => $order->payment->payment_method,
                    ]
                ];
            }),
        ];
    }
}
