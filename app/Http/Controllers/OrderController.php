<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $orderResource = Order::all();
        return new OrderCollection($orderResource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $userId = $user->user_id;

        // Retrieve the user's cart
        $cart = Cart::where('user_id', $userId)->first();
        if (!$cart) {
            return response()->json(['error' => 'Cart is empty.'], HttpResponse::HTTP_BAD_REQUEST);
        }

        // Retrieve cart details
        $cartDetails = CartDetail::where('cart_id', $cart->cart_id)->get();
        if ($cartDetails->isEmpty()) {
            return response()->json(['error' => 'Cart is empty.'], HttpResponse::HTTP_BAD_REQUEST);
        }

        // Calculate total price
        $totalPrice = $cartDetails->sum(function ($detail) {
            return $detail->quantity * $detail->productDetail->product->price;
        });

        // Create the order
        $orderData = $request->only([
            'address',
            'phone_number',
            'status',
            'payment_method_id',
            'shipping_method_id',
            'voucher_id',
        ]);

        $orderData['user_id'] = $userId;
        $orderData['total'] = $totalPrice;
        $orderData['status'] = $orderData['status'] ?? 0; // Set default status to 0 if not provided
        $orderData['voucher_id'] = $orderData['voucher_id'] ?? null;
        $orderData['employee_id'] = null;

        $order = Order::create($orderData);

        // Create order details
        foreach ($cartDetails as $detail) {
            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_detail_id' => $detail->product_detail_id,
                'quantity' => $detail->quantity,
                'price' => $detail->productDetail->product->price,
            ]);
        }

        // Clear the cart
        CartDetail::where('cart_id', $cart->cart_id)->delete();

        // Return the order resource
        $orderResource = new OrderResource($order);
        return response()->json(['data' => $orderResource], HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = $this->order->findOrFail($id);
            return (new OrderResource($order))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Order id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, string $id)
    {
        try {
            // Find the order by ID
            $order = Order::findOrFail($id);

            // Get the currently authenticated user
            $user = Auth::user();

            // Ensure only the status field is updated and set employee_id
            $dataUpdate = [
                'status' => $request->input('status'),
                'employee_id' => $user->user_id,
            ];

            // Update the order
            $order->update($dataUpdate);

            // Transform the updated order
            $orderResource = new OrderResource($order);

            // Return the updated order with HTTP OK status
            return $orderResource->response()->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the order is not found
            return response()->json([
                'error' => 'Không tìm thấy đơn hàng',
            ], HttpResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            // Handle any other exceptions
            return response()->json([
                'error' => 'Đã xảy ra lỗi không mong muốn',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $order = $this->order->where('order_id', $id)->firstOrFail();
            $order->delete();
            $orderResource = new OrderResource($order);

            return $orderResource->response()->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Không tìm thấy đơn hàng',
            ], HttpResponse::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi không mong muốn',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function profit()
    {
        $profit = Order::join('orderdetails', 'orders.id', '=', 'orderdetails.order_id')
            ->join('products', 'orderdetails.product_id', '=', 'products.id')
            ->select('orders.total', 'orders.created_at', 'products.name')
            ->get();
    }

    public function confOrder()
    {
    }
}
