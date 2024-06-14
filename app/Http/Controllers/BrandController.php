<?php

namespace App\Http\Controllers;

use App\Http\Requests\Brand\StoreBrandRequest;
use App\Http\Requests\Brand\UpdateBrandRequest;
use App\Http\Resources\Brand\BrandCollection;
use App\Http\Resources\Brand\BrandResource;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;


class BrandController extends Controller
{
    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
    public function index()
    {
        $brandsResource = new BrandCollection(Brand::all());
        return $brandsResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand_name = $request->input('brand_name');
        $check = Brand::where('brand_name', $brand_name)->exists();
        if ($check) {
            return response()->json([
                'error' => 'Tên nhãn hàng này đã tồn tại.'
            ], HttpResponse::HTTP_CONFLICT);
        } else {
            $dataCreate = $request->all();
            $brand = new Brand();
            $brand->brand_name = $dataCreate['brand_name'];
            $brand->status = $dataCreate['status'];
            $brand->save();
            return (new BrandResource($brand))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $brand = $this->brand->findOrFail($id);
            return (new BrandResource($brand))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thương hiệu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        try {
            $brand = $this->brand->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Brand::where('brand_name', $dataUpdate['brand_name'])->where('brand_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Tên thương hiệu này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $brand->brand_name = $dataUpdate['brand_name'];
            $brand->status = $dataUpdate['status'];
            $brand->save();
            return (new BrandResource($brand))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thương hiệu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Product::where('brand_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Nhãn hành này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $brand = $this->brand->where('brand_id', $id)->firstOrFail();
            $brand->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $brand->brand_name,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thương hiệu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
