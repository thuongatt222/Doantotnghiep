<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favourite\StoreFavouriteRequest;
use App\Http\Requests\Favourite\UpdateFavouriteRequest;
use App\Http\Resources\Favourite\FavouriteCollection;
use App\Http\Resources\Favourite\FavouriteResource;
use App\Models\Favourite;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    protected $favourite;
    public function __construct(Favourite $favourite)
    {
        $this->favourite = $favourite;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $favouritesResource = Favourite::all();
        return new FavouriteCollection($favouritesResource);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavouriteRequest $request)
    {
        $user = Auth::user();
        $check = Favourite::where('product_id', $request->product_id)->first();
        if ($check) {
            flash()->addWarning('Sản phẩm này đã tồn tại trong danh mục yêu thích');
        }
        $favourite = new Favourite();
        $favourite->user_id = $user->user_id;
        $favourite->product_id = $request->product_id;
        $favourite->save();
        $favouriteResource = new FavouriteResource($favourite);
        return response()->json([
            'data' => $favouriteResource,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavouriteRequest $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Auth::user();
        $favourite = Favourite::where('user_id', $user->user_id)->where('product_id', $id)->firstOrFail();
        $favourite->delete();
        $favouriteResource = new FavouriteResource($favourite);
        return response()->json([
            'data' => $favouriteResource,
        ], HttpResponse::HTTP_OK);
    }
}
