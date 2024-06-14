<?php

namespace App\Http\Controllers;

use App\Http\Requests\Size\StoreSizeRequest;
use App\Http\Requests\Size\UpdateSizeRequest;
use App\Http\Resources\Size\SizeCollection;
use App\Http\Resources\Size\SizeResource;
use App\Models\ProductDetail;
use App\Models\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;

class SizeController extends Controller
{
    protected $size;
    public function __construct(Size $size)
    {
        $this->size = $size;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $SizesResource = new SizeCollection(Size::all());
        return $SizesResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSizeRequest $request)
    {
        $dataCreate = $request->all();
        $check = Size::where('size', $dataCreate['size'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Kích cỡ này đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $size = new Size();
        $size->size = $dataCreate['size'];
        $size->status = $dataCreate['status'];
        $size->save();
        return (new SizeResource($size))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $size = $this->size->findOrFail($id);
            return (new SizeResource($size))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Kích cỡ id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSizeRequest $request, string $id)
    {
        try {
            $size = $this->size->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Size::where('size', $dataUpdate['size'])->where('size_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Kích cỡ này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $size->size = $dataUpdate['size'];
            $size->status = $dataUpdate['status'];
            $size->save();
            return (new SizeResource($size))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Kích cỡ id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = ProductDetail::where('size_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Màu này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $size = $this->size->where('size_id', $id)->firstOrFail();
            $size->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $size->size,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Kích cỡ id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
