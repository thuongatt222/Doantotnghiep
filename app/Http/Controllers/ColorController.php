<?php

namespace App\Http\Controllers;

use App\Http\Requests\Color\StoreColorRequest;
use App\Http\Requests\Color\UpdateColorRequest;
use App\Http\Resources\Color\ColorCollection;
use App\Http\Resources\Color\ColorResource;
use App\Models\Color;
use App\Models\ProductDetail;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    protected $color;
    public function __construct(Color $color)
    {
        $this->color = $color;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ColorsResource = new ColorCollection(Color::all());
        return $ColorsResource;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreColorRequest $request)
    {
        $color = $request->input('color');
        $check = Color::where('color', $color)->exists();
        if ($check) {
            return response()->json([
                'error' => 'Màu này đã tồn tại.'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $dataCreate = $request->all();
        $color = new Color();
        $color->color = $dataCreate['color'];
        $color->status = $dataCreate['status'];
        $color->note = $dataCreate['note'];
        $color->save();
        return (new ColorResource($color))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $color = $this->color->findOrFail($id);
            return (new ColorResource($color))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Màu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateColorRequest $request, string $id)
    {
        try {
            $color = $this->color->findOrFail($id);
            $dataUpdate = $request->all();
            $check = Color::where('color', $dataUpdate['color'])->where('color_id', '!=', $id)->exists();
            if ($check) {
                return response()->json([
                    'error' => 'Màu này đã tồn tại!',
                ], HttpResponse::HTTP_CONFLICT);
            }
            $color->color = $dataUpdate['color'];
            $color->status = $dataUpdate['status'];
            $color->note = $dataUpdate['note'];
            $color->save();
            return (new ColorResource($color))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Màu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isUsedInOtherTable = ProductDetail::where('color_id', $id)->exists();
        if ($isUsedInOtherTable) {
            return response()->json([
                'error' => 'Màu này đang có sản phẩm nên không thể xóa.',
            ], HttpResponse::HTTP_CONFLICT);
        }
        try {
            $color = $this->color->where('color_id', $id)->firstOrFail();
            $color->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $color->color,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Màu id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
