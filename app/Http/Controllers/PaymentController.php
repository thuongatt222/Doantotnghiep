<?php

namespace App\Http\Controllers;

use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;
use App\Http\Resources\Payment\PaymentCollection;
use App\Http\Resources\Payment\PaymentResource;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    protected $payment;
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentsResource = new PaymentCollection(Payment::all());
        return $paymentsResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $dataCreate = $request->all();
        $check = Payment::where('payment_method', $dataCreate['payment_method'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Phương thức đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $payment = new Payment();
        $payment->payment_method = $dataCreate['payment_method'];
        $payment->status = $dataCreate['status'];
        $payment->note = $dataCreate['note'];
        $payment->save();
        return (new PaymentResource($payment))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return $payment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, string $id)
    {
        try {
            $payment = $this->payment->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Payment::where('payment_method', $dataUpdate['payment_method'])->where('payment_method_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Phương thức đã tồn tại!'
                ], HttpResponse::HTTP_CONFLICT);
            }
            $payment->payment_method = $dataUpdate['payment_method'];
            $payment->status = $dataUpdate['status'];
            $payment->note = $dataUpdate['note'];
            $payment->save();
            return (new PaymentResource($payment))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Phương thức '. $payment->payment_method.' không tồn tại'
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Order::where('payment_method_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Phương thức này đã tồn tại trong hóa đơn nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $payment = $this->payment->where('payment_method_id', $id)->firstOrFail();
            $payment->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $payment->payment_method,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Phương thức '. $payment->payment_method.' không tồn tại'
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
