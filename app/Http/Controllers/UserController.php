<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\User\UserCollection;
use App\Http\Resources\User\UserResource;
use App\Models\Cart;
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
        if ($check) {
            return response()->json([
                'error' => 'email đã tồn tại!'
            ], HttpResponse::HTTP_CONFLICT);
        }
        $user = new User();
        $user->name = $dataCreate['name'];
        $user->email = $dataCreate['email'];
        $user->password = bcrypt($dataCreate['password']);
        $user->avatar = $dataCreate['avatar'] ?? 'avatar.jpg';
        $user->address = $dataCreate['address'];
        $user->phone = $dataCreate['phone'];
        $user->role = $dataCreate['role'];
        $user->status = $dataCreate['status'] ?? 1;
        $user->note = $dataCreate['note'];
        $user->save();
        $cart = new Cart();
        $cart->user_id = $user->user_id;
        $cart->save();
        return (new UserResource($user))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
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

        // Check if the email is being updated and if it already exists
        if ($user->email !== $dataUpdate['email']) {
            $check = User::where('email', $dataUpdate['email'])->exists();
            if ($check) {
                return response()->json([
                    'error' => 'email đã tồn tại!'
                ], HttpResponse::HTTP_CONFLICT);
            }
        }

        // Update user fields individually
        $user->name = $dataUpdate['name'];
        $user->email = $dataUpdate['email'];
        if (isset($dataUpdate['password'])) {
            $user->password = bcrypt($dataUpdate['password']);
        }
        $user->address = $dataUpdate['address'];
        $user->phone = $dataUpdate['phone'];
        $user->role = $dataUpdate['role'];
        $user->status = $dataUpdate['status'];
        $user->note = $dataUpdate['note'];
        $user->save();
        return (new UserResource($user))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->user->where('user_id', $id)->firstOrFail();
        $user->delete();
        return (new UserResource($user))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
    }
}
