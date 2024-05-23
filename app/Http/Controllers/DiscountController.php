<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discount\StoreDiscountRequest;
use App\Http\Requests\Discount\UpdateDiscountRequest;
use App\Http\Resources\Discount\DiscountCollection;
use App\Http\Resources\Discount\DiscountResource;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;

class DiscountController extends Controller
{
    protected $discount;
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $discountResource = new DiscountCollection(Discount::all());
        return $discountResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDiscountRequest $request)
    {
        $dataCreate = $request->all();
        $check = Discount::where('discount', $dataCreate['discount'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Discount này đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $discount = new Discount();
        $discount->discount = $dataCreate['discount'];
        $discount->start_day = $dataCreate['start_day'];
        $discount->end_day = $dataCreate['end_day'];
        $discount->status = $dataCreate['status'];
        $discount->note = $dataCreate['note'];
        $discount->save();
        return (new DiscountResource($discount))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $discount = $this->discount->findOrFail($id);
            return (new DiscountResource($discount))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Discount id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountRequest $request, string $id)
    {
        try {
            $discount = $this->discount->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Discount::where('discount', $dataUpdate['discount'])->where('discount_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Discount này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $discount->discount = $dataUpdate['discount'];
            $discount->start_day = $dataUpdate['start_day'];
            $discount->end_day = $dataUpdate['end_day'];
            $discount->status = $dataUpdate['status'];
            $discount->note = $dataUpdate['note'];
            $discount->save();
            return (new DiscountResource($discount))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Discount id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Product::where('discount_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Discount này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $discount = $this->discount->where('discount_id', $id)->firstOrFail();
            $discount->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $discount->discount,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Discount id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
