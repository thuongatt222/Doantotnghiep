<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response as HttpResponse;
use App\Http\Requests\Picture\StorePictureRequest;
use App\Http\Requests\Picture\UpdatePictureRequest;
use App\Http\Resources\Picture\PictureResource;
use App\Http\Resources\Picture\PictureCollection;
use App\Models\Picture_library;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Picture_library as Picture;
use App\Models\Product;
use App\Models\ProductDetail;

class PictureLibraryController extends Controller
{
    protected $picture;

    public function __construct(Picture $picture)
    {
        $this->picture = $picture;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pictures  = new PictureCollection(Picture::all());
        return $pictures;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePictureRequest $request)
    {
        $dataCreate = $request->all();
        $get_image = $dataCreate['image'];
        $product_detail_id = $request->product_detail_id;
        $product_detail = ProductDetail::find($product_detail_id);
        if (!$product_detail) {
            return response()->json(['error' => 'Product detail not found'], 404);
        }
        $product = Product::find($product_detail->product_id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        // dd($get_image);
        if ($get_image) {
            foreach ($get_image as $img) {
                $path = 'uploads/library/';
                $get_name_image = $img->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $img->getClientOriginalExtension();
                $img->move($path, $new_image);
                $picture = new Picture();
                $picture->title = $product->product_name;
                $picture->product_detail_id = $product_detail_id;
                $picture->image = $new_image;
                $picture->save();
            }
        }
        $pictures = Picture::where('product_detail_id', $product_detail_id)->get();
        return new PictureCollection($pictures);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pictures  = new PictureCollection(Picture::where('product_detail_id', $id)->get());
        return $pictures;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePictureRequest $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $picture = $this->picture->where('picture_id', $id)->firstOrFail();
            $picture->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $picture->image,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Hình ảnh ' . $picture->image . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
