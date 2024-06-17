<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'image',
        'brand_id',
        'discount',
        'category_id',
        'status',
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'product';
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
    public function getTotalQuantityAttribute()
    {
        return $this->productDetails->sum('quantity');
    }
}
