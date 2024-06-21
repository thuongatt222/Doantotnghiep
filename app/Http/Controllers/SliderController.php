<?php

namespace App\Http\Controllers;

use App\Http\Requests\Slider\StoreSliderRequest;
use App\Http\Requests\Slider\UpdateSliderRequest;
use App\Http\Resources\Slider\SliderCollection;
use App\Http\Resources\Slider\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slidersResource = new SliderCollection(Slider::all());
        return $slidersResource;
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
    public function store(StoreSliderRequest $request)
    {
        $dataCreate = $request->all();
        $slider = new Slider();
        $slider->title = $dataCreate['title'];
        $slider->status = $dataCreate['status'];
        $get_image = $dataCreate['image'];
        $path = 'uploads/slider/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $slider->image = $new_image;
        $slider->save();
        return (new SliderResource($slider))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $slider = $this->slider->findOrFail($id);
            return (new SliderResource($slider))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Slider id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, $id)
    {
        try {
            $slider = $this->slider->findOrFail($id);
            $dataUpdate = $request->all();
            $slider->title = $dataUpdate['title'];
            $slider->description = $dataUpdate['description'];
            $slider->status = $dataUpdate['status'];
            $get_image = $dataUpdate['image'];
            if ($get_image) {
                $path_unlink = 'uploads/slider/' . $slider->image;
                if (file_exists($path_unlink)) {
                    unlink($path_unlink);
                }
                $path = 'uploads/slider/';
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move($path, $new_image);
                $slider->image = $new_image;
            }
            $slider->save();
            return (new SliderResource($slider))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Slider không tồn tại'
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $slider = $this->slider->where('slider_id', $id)->firstOrFail();
            $slider->delete();
            return response()->json([
                'message' => 'Xóa thành công ' . $slider->title,
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Không tồn tại slider id' . $id,
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
