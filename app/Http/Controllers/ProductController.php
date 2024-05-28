<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return new ProductCollection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $dataCreate = $request->all();
        $check = Product::where('product_name', $dataCreate['product_name'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $product = new Product();
        $product->product_name = $dataCreate['product_name'];
        $product->status = $dataCreate['status'];
        $product->description = $dataCreate['description'];
        $product->price = $dataCreate['price'];
        $get_image = $dataCreate['image'];
        $path = 'uploads/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $product->image = $new_image;
        $product->brand_id = $dataCreate['brand_id'];
        $product->category_id = $dataCreate['category_id'];
        $product->note = $dataCreate['note'];
        $product->save();
        return (new ProductResource($product))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = $this->product->findOrFail($id);
            return (new ProductResource($product))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Product id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = $this->product->findOrFail($id);
        $dataUpdate = $request->all();
        $check = Product::where('product_name', $dataUpdate['product_name'])->exists();
        if ($check) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $product->update($dataUpdate);
        $productResource = new ProductResource($product);
        return response()->json([
            'data' => $productResource,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = OrderDetail::where('product_id', $id)->exists();
        $isUsedInFavouriTable = OrderDetail::where('product_id', $id)->exists();
        if ($isUsedInOtherTable || $isUsedInFavouriTable) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại trong hóa đơn nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        $product = $this->product->where('product_id', $id)->firstOrFail();
        $product->delete();
        $productResource = new ProductResource($product);
        return response()->json([
            'data' => $productResource,
        ], HttpResponse::HTTP_OK);
    }
    /**
     * Search for products by product_name.
     */
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Search for products with similar product_name
        $products = Product::where('product_name', 'LIKE', "%$searchTerm%")->paginate(5);
        return new ProductCollection($products);
    }
    
}
