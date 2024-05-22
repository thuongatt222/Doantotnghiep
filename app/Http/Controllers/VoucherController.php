<?php

namespace App\Http\Controllers;

use App\Http\Requests\Voucher\StoreVoucherRequest;
use App\Http\Requests\Voucher\UpdateVoucherRequest;
use App\Http\Resources\Voucher\VoucherCollection;
use App\Http\Resources\Voucher\VoucherResource;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    protected $voucher;
    public function __construct(Voucher $voucher)
    {
        $this->voucher = $voucher;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voucherResource = new VoucherCollection(Voucher::all());
        return $voucherResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVoucherRequest $request)
    {
        $dataCreate = $request->all();
        $check = Voucher::where('voucher', $dataCreate['voucher'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Voucher này đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $voucher = new Voucher();
        $voucher->voucher = $dataCreate['voucher'];
        $voucher->quantity = $dataCreate['quantity'];
        $voucher->start_day = $dataCreate['start_day'];
        $voucher->end_day = $dataCreate['end_day'];
        $voucher->status = $dataCreate['status'];
        $voucher->note = $dataCreate['note'];
        $voucher->save();
        return (new VoucherResource($voucher))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVoucherRequest $request, string $id)
    {
        try {
            $voucher = $this->voucher->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Voucher::where('voucher', $dataUpdate['voucher'])->where('voucher_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Voucher này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $voucher->voucher = $dataUpdate['voucher'];
            $voucher->quantity = $dataUpdate['quantity'];
            $voucher->start_day = $dataUpdate['start_day'];
            $voucher->end_day = $dataUpdate['end_day'];
            $voucher->status = $dataUpdate['status'];
            $voucher->note = $dataUpdate['note'];
            $voucher->save();
            return (new VoucherResource($voucher))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Voucher' . $voucher->voucher . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Order::where('voucher_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Voucher này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $voucher = $this->voucher->where('voucher_id', $id)->firstOrFail();
            $voucher->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $voucher->voucher,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Voucher' . $voucher->voucher . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
