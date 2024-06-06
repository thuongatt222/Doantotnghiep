<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;
    protected $fillable = ['cart_id', 'product_detail_id', 'quantity'];
    protected $primaryKey = 'cart_id';
    protected $table = 'carts';
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id');
    }
}
