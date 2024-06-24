<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'color_id',
        'size_id',
        'product_id',
        'quantity',
        'status',
    ];
    protected $primaryKey = 'product_detail_id';
    protected $table = 'product_detail';
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }
    public function getTotalSoldQuantityInMonth($month, $year)
    {
        return $this->hasMany(OrderDetail::class, 'product_detail_id', 'product_detail_id')
            ->join('orders', 'order_detail.order_id', '=', 'orders.order_id')
            ->whereMonth('orders.created_at', $month)
            ->whereYear('orders.created_at', $year)
            ->sum('order_detail.quantity');
    }
}
