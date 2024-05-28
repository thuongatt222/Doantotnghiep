<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Requests\Review\UpdateReviewRequest;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $review;
    public function __construct(Review $review)
    {
        $this->review = $review;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $reviewResource = Review::all();
        return (new ReviewCollection($reviewResource))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        $dataCreate = $request->all();
        $review = $this->review->create($dataCreate);
        $reviewResource = new ReviewResource($review);
        return response()->json([
            'data' => $reviewResource,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $review = $this->review->findOrFail($id);
            return (new ReviewResource($review))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Review id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, string $id)
    {
        $review = $this->review->findOrFail($id);
        $dataUpdate = $request->all();
        $review->update($dataUpdate);
        $reviewResource = new ReviewResource($review);
        return response()->json([
            'data' => $reviewResource,
        ], HttpResponse::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = $this->review->where('review_id', $id)->firstOrFail();
        $review->delete();
        $reviewResource = new ReviewResource($review);
        return response()->json([
            'data' => $reviewResource,
        ], HttpResponse::HTTP_OK);
    }
}
