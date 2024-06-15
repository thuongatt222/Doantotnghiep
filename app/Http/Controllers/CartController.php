<?php

namespace App\Http\Controllers;

use App\Http\Resources\Cart\CartCollection;
use Illuminate\Http\Response as HttpResponse;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::all();
        return (new CartCollection($cart))
            ->response()
            ->setStatusCode(HttpResponse::HTTP_OK);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            
        }catch(ModelNotFoundException $e){

        }
    }
    public function cart(Request $request)
    {
        $productDetailId = $request->input('product_detail_id');
        $quantity = $request->input('quantity') ?? 1;
        $user = Auth::user();
        $userId = $user->user_id;

        // Find or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        try {
            // Find the product detail
            $productDetail = ProductDetail::findOrFail($productDetailId);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Product detail not found.',
            ], HttpResponse::HTTP_NOT_FOUND);
        }
        // Find or create cart detail
        $cartDetail = CartDetail::firstOrNew([
            'cart_id' => $cart->cart_id,
            'product_detail_id' => $productDetailId,
        ]);
        
        // Update the quantity
        $cartDetail->quantity += $quantity;
        $cartDetail->save();
        // Retrieve updated cart details
        $cartDetails = CartDetail::where('cart_id', $cart->cart_id)->get();

        // Prepare cart data to return
        $cartData = $cartDetails->map(function ($detail) {
            return [
                'product_detail_id' => $detail->product_detail_id,
                'name' => $detail->productDetail->name,
                'price' => $detail->productDetail->price,
                'quantity' => $detail->quantity,
            ];
        });

        return response()->json([
            'data' => $cartData,
        ], HttpResponse::HTTP_OK);
    }
}