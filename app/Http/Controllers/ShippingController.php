<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shipping\StoreShippingRequest;
use App\Http\Requests\Shipping\UpdateShippingRequest;
use App\Http\Resources\Shipping\ShippingCollection;
use App\Http\Resources\Shipping\ShippingResource;
use App\Models\Order;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;

class ShippingController extends Controller
{
    protected $shipping;
    public function __construct(Shipping $shipping)
    {
        $this->shipping = $shipping;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $shippingResource = new ShippingCollection(Shipping::all());
        return $shippingResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShippingRequest $request)
    {
        $dataCreate = $request->all();
        $check = Shipping::where('shipping_method', $dataCreate['shipping_method'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Phương thức đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $shipping = new Shipping();
        $shipping->shipping_method = $dataCreate['shipping_method'];
        $shipping->status = $dataCreate['status'];
        $shipping->save();
        return (new ShippingResource($shipping))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $shipping = $this->shipping->findOrFail($id);
            return (new ShippingResource($shipping))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Phương thức id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShippingRequest $request, string $id)
    {
        try {
            $shipping = $this->shipping->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Shipping::where('shipping_method', $dataUpdate['shipping_method'])->where('shipping_method_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Phương thức đã tồn tại!'
                ], HttpResponse::HTTP_CONFLICT);
            }
            $shipping->shipping_method = $dataUpdate['shipping_method'];
            $shipping->status = $dataUpdate['status'];
            $shipping->save();
            return (new ShippingResource($shipping))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Phương thức id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Order::where('shipping_method_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Phương thức này đã tồn tại trong hóa đơn nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $shipping = $this->shipping->where('shipping_method_id', $id)->firstOrFail();
            $shipping->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $shipping->shipping_method,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Phương thức id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
