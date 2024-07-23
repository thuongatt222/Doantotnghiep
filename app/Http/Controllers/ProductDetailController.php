<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductDetail\StoreProductDetailRequest;
use App\Http\Requests\ProductDetail\UpdateProductDetailRequest;
use App\Http\Resources\ProductDetail\ProductDetailCollection;
use App\Http\Resources\ProductDetail\ProductDetailResource;
use App\Models\Color;
use App\Models\Product;

use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\size;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;

class ProductDetailController extends Controller
{
    protected $product_detail;
    public function __construct(ProductDetail $product_detail)
    {
        $this->product_detail = $product_detail;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_details = ProductDetail::with(['color', 'size'])->get();
        return (new ProductDetailCollection($product_details))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductDetailRequest $request)
    {
        $dataCreate = $request->all();
        $check = ProductDetail::where('color_id', $dataCreate['color_id'])
            ->where('product_id', $dataCreate['product_id'])
            ->where('size_id', $dataCreate['size_id'])->exists();

        if ($check) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại'
            ], HttpResponse::HTTP_CONFLICT);
        }

        try {
            $product_detail = ProductDetail::create($dataCreate);
            return (new ProductDetailResource($product_detail))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi tạo chi tiết sản phẩm.',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product_detail = $this->product_detail->findOrFail($id);
            return (new ProductDetailResource($product_detail))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Product detail id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductDetailRequest $request, string $id)
    {
        try {
            $product_detail = ProductDetail::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Chi tiết sản phẩm không tồn tại.',
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        $dataUpdate = $request->all();
        $check = ProductDetail::where('color_id', $dataUpdate['color_id'])
            ->where('product_id', $dataUpdate['product_id'])
            ->where('size_id', $dataUpdate['size_id'])
            ->where('product_detail_id', '!=', $id)
            ->exists();

        if ($check) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại'
            ], HttpResponse::HTTP_CONFLICT);
        }

        try {
            $product_detail->update($dataUpdate);
            return (new ProductDetailResource($product_detail))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi cập nhật chi tiết sản phẩm.',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function topSellingProducts()
    {
        $now = Carbon::now();
        $month = $now->month;
        $year = $now->year;

        $topProducts = ProductDetail::selectRaw('
            product_detail.product_detail_id,
            product_detail.product_id,
            color.color as color_name,
            sizes.size as size_name,
            product.product_name,
            product.image,
            SUM(order_detail.quantity) as total_sold_quantity
        ')
            ->join('order_detail', 'product_detail.product_detail_id', '=', 'order_detail.product_detail_id')
            ->join('order', 'order_detail.order_id', '=', 'order.order_id')
            ->join('product', 'product_detail.product_id', '=', 'product.product_id')
            ->join('color', 'product_detail.color_id', '=', 'color.color_id')
            ->join('sizes', 'product_detail.size_id', '=', 'sizes.size_id')
            ->whereMonth('order.created_at', $month)
            ->whereYear('order.created_at', $year)
            ->groupBy(
                'product_detail.product_detail_id',
                'product_detail.product_id',
                'color.color',
                'sizes.size',
                'product.product_name',
                'product.image'
            )
            ->orderByDesc('total_sold_quantity')
            ->limit(4)
            ->get();
        return response()->json([
            'data' => $topProducts,
        ], HttpResponse::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $isUsedInOrderDetailTable = OrderDetail::where('product_detail_id', $id)->exists();

            if ($isUsedInOrderDetailTable) {
                return response()->json([
                    'error' => 'Sản phẩm này đã tồn tại trong hóa đơn nên không thể xóa.',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $product_detail = ProductDetail::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Chi tiết sản phẩm không tồn tại.',
            ], HttpResponse::HTTP_NOT_FOUND);
        }

        try {
            $product_detail->delete();
            return (new ProductDetailResource($product_detail))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi xóa chi tiết sản phẩm.',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
