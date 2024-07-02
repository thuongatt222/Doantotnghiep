<?php

namespace App\Http\Controllers;

use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Http\Resources\Order\OrderCollection;
use App\Http\Resources\Order\OrderResource;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartDetail;
use App\Models\Momo;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $orders = Order::with([
            'orderDetails.productDetail.color',
            'orderDetails.productDetail.size',
            'orderDetails.productDetail.product',
            'shipping',
            'payment'
        ])->get();
        return (new OrderCollection($orders))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }
    public function display_user()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], HttpResponse::HTTP_UNAUTHORIZED);
            }
            $orders = Order::with([
                'orderDetails.productDetail.color',
                'orderDetails.productDetail.size',
                'orderDetails.productDetail.product',
                'shipping',
                'payment'
            ])->where('user_id', $user->user_id)->get();

            return (new OrderCollection($orders))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
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
            $price = $detail->productDetail->product->price;
            $discount = $detail->productDetail->product->discount ?? 0;
            $discountedPrice = $price - ($price * ($discount / 100));
            return $detail->quantity * $discountedPrice;
        });

        // Create the order
        $orderData = $request->only([
            'address',
            'name',
            'phone_number',
            'payment_method_id',
            'shipping_method_id',
            'voucher_code',
            'shipping_code',
        ]);
        if ($user->role == 1) {
            $orderData['employee_id'] = $userId;
            $orderData['user_id'] = $userId;
        } else {
            $orderData['user_id'] = $userId;
        }
        if (!empty($orderData['voucher_code'])) {
            $voucher = Voucher::where('voucher_code', $orderData['voucher_code'])->first();
            if ($voucher) {
                $totalPrice = $totalPrice - ($totalPrice * ($voucher->voucher / 100) );
                $orderData['voucher_id'] = $voucher->voucher_id;
            } else {
                return response()->json(['error' => 'Invalid voucher code.'], HttpResponse::HTTP_BAD_REQUEST);
            }
        } else {
            $orderData['voucher_id'] = null;
        }
        $orderData['total'] = $totalPrice;
        $orderData['shipping_code'] = $request['shipping_code'] ?? null;
        $orderData['status'] = 1;

        $order = Order::create($orderData);

        // Create order details
        foreach ($cartDetails as $detail) {
            $productDetail = $detail->productDetail; 
            $product = $productDetail->product;

            OrderDetail::create([
                'order_id' => $order->order_id,
                'product_detail_id' => $detail->product_detail_id,
                'quantity' => $detail->quantity,
                'price' => $product->price,
            ]);
            $detail->productDetail->decrement('quantity', $detail->quantity);
        }

        // Clear the cart
        CartDetail::where('cart_id', $cart->cart_id)->delete();
        $payment = Payment::where('payment_method_id', $order->payment_method_id)->first();
        if ($payment->payment_method == 'Momo') {
            return $this->processMomoPayment($order);
        }
        // Return the order resource
        return response()->json(['data' => "/"], HttpResponse::HTTP_OK);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = Order::with([
                'orderDetails.productDetail.color',
                'orderDetails.productDetail.size',
                'orderDetails.productDetail.product',
                'shipping',
                'payment'
            ])->findOrFail($id);

            return (new OrderResource($order))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Order id ' . $id . ' không tồn tại',
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
                'shipping_code' => $request->input('shipping_code'),
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
    public function getMonthlyProfit()
    {
        $profits = Order::select(
            DB::raw('SUM(total) as profit'),
            DB::raw('DATE_TRUNC(\'month\', created_at) as month')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartData = $profits->map(function ($profit) {
            // Convert 'month' to a Carbon instance
            $month = Carbon::parse($profit->month);
            return [
                'month' => $month->format('Y-m'),
                'profit' => $profit->profit,
            ];
        });

        return response()->json($chartData, HttpResponse::HTTP_OK);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function report()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Lấy sô lợi nhuận trong tháng
        $profit = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->sum('total'); // Assuming there's a 'profit' column in orders table

        // Số đơn hàng trong tháng
        $ordersCount = Order::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Người dùng mới trong tháng
        $newUsersCount = User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();

        // Hóa đơn chờ duyệt
        $pendingInvoicesCount = Order::where('status', 1)->count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'monthly_profit' => $profit,
                'orders_count' => $ordersCount,
                'new_users_count' => $newUsersCount,
                'pending_invoices_count' => $pendingInvoicesCount,
            ],
        ], 200);
    }
    private function processMomoPayment($order)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = env('MOMO_PARTNER_CODE', 'MOMOBKUN20180529');
        $accessKey = env('MOMO_ACCESS_KEY', 'klm05TvNBzhg7h7j');
        $secretKey = env('MOMO_SECRET_KEY', 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa');
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $order->total;
        $orderId = $order->order_id . '_' . time();
        $redirectUrl = env('URL_CUSTOMER') . "/order";
        $ipnUrl = env('URL_CUSTOMER') . "/order";
        $requestId = time() . "";
        $requestType = "payWithATM";
        $extraData = "";

        // Before signing HMAC SHA256 signature
        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];
        try {
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);

            if (isset($jsonResult['payUrl'])) {
                return $jsonResult['payUrl'];
            } else {
                // Handle the error case
                return response()->json('error', 'Unable to create MoMo payment. Please try again.');
            }
        } catch (\Exception $e) {
            // Handle the exception case
            return response()->json('error', 'An error occurred while processing your request. Please try again.');
        }
    }
}
