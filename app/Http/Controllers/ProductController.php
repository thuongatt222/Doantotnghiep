<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use App\Models\Favourite;
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
        $products = Product::with([
            'brand',
            'category',
            'productDetails.color',
            'productDetails.size',
        ])->withCount('productDetails')->get();
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
        $product->discount = $dataCreate['discount'];
        $get_image = $dataCreate['image'];
        $path = 'uploads/product/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $product->image = $new_image;
        $product->brand_id = $dataCreate['brand_id'];
        $product->category_id = $dataCreate['category_id'];
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
            $product = Product::with([
                'brand',
                'category',
                'productDetails.color',
                'productDetails.size',
            ])->withCount('productDetails')->findOrFail($id);

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
        dd($request);
        $dataUpdate = $request->all();

        dd($dataUpdate);
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Sản phẩm không tồn tại.',
            ], HttpResponse::HTTP_NOT_FOUND);
        }



        // Check if the product name already exists (excluding the current product)
        $check = Product::where('product_name', $dataUpdate['product_name'])
            ->where('product_id', '!=', $id)
            ->exists();
        if ($check) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại!',
            ], HttpResponse::HTTP_CONFLICT);
        }

        try {
            // Update product attributes
            $product->product_name = $dataUpdate['product_name'];
            $product->status = $dataUpdate['status'];
            $product->description = $dataUpdate['description'];
            $product->price = $dataUpdate['price'];
            $product->discount = $dataUpdate['discount'];
            $product->brand_id = $dataUpdate['brand_id'];
            $product->category_id = $dataUpdate['category_id'];

            // Handle image update if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image
                $oldImage = $product->image;
                if ($oldImage && file_exists('uploads/product/' . $oldImage)) {
                    unlink('uploads/product/' . $oldImage);
                }

                // Save the new image
                $get_image = $dataUpdate['image'];
                $path = 'uploads/product/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $product->image = $new_image;
            }

            $product->save();

            return (new ProductResource($product))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi cập nhật sản phẩm.',
            ], HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInFavouriteTable = Favourite::where('product_id', $id)->exists();

        if ($isUsedInFavouriteTable) {
            return response()->json([
                'error' => 'Sản phẩm này đã tồn tại trong danh sách yêu thích nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Sản phẩm không tồn tại.',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
        // Delete the product image if it exists
        if ($product->image && file_exists('uploads/product/' . $product->image)) {
            unlink('uploads/product/' . $product->image);
        }

        $product->delete();

        return response()->json([
            'data' => new ProductResource($product),
        ], HttpResponse::HTTP_OK);
    }


    /**
     * Search for products by product_name.
     */
}
