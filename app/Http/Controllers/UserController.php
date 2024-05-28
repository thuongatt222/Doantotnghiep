<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response as HttpResponse;


class UserController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $usersResource = User::all();
        return (new UserCollection($usersResource))
        ->response()
        ->setStatusCode(HttpResponse::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $dataCreate = $request->all();
        $check = User::where('email', $dataCreate['email'])->exists();
        if($check){
            return response()->json([
                'error' => 'email đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $user = $this->user->create($dataCreate);
        $userResource = new UserResource($user);
        return response()->json([
            'data' => $userResource,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = $this->user->findOrFail($id);
            return (new UserResource($user))
                ->response()
                ->setStatusCode(HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'User id là ' . $id . ' không tồn tại',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = $this->user->findOrFail($id);
        $dataUpdate = $request->all();
        $check = User::where('email', $dataUpdate['email'])->exists();
        if($check){
            return response()->json([
                'error' => 'email đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $user->update($dataUpdate);
        $userResource = new UserResource($user);
        return response()->json([
            'data' => $userResource,
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user->where('size_id', $id)->firstOrFail();
        $user->delete();
        $userResource = new UserResource($user);
        return response()->json([
            'data' => $userResource,
        ], HttpResponse::HTTP_OK);
    }
}
