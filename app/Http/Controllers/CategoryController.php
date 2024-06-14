<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorysResource = new CategoryCollection(Category::all());
        return $categorysResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category_name = $request->input('category_name');
        $check = Category::where('category_name', $category_name)->exists();
        if ($check) {
            return response()->json([
                'error' => 'Tên thể loại này đã tồn tại.'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $dataCreate = $request->all();
        $category = new Category();
        $category->category_name = $dataCreate['category_name'];
        $category->status = $dataCreate['status'];
        $category->save();
        return (new CategoryResource($category))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $category = $this->category->findOrFail($id);
            return (new CategoryResource($category))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thể loại id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        try {
            $category = $this->category->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Category::where('category_name', $dataUpdate['category_name'])->where('category_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Tên thể loại này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $category->category_name = $dataUpdate['category_name'];
            $category->status = $dataUpdate['status'];
            $category->save();
            return (new CategoryResource($category))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thể loại id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = Product::where('category_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Thể loại này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $category = $this->category->where('category_id', $id)->firstOrFail();
            $category->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $category->category_name,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Thể loại id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
