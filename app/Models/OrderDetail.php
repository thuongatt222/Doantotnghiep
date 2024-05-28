<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'price',
        'product_detail_id',
        'order_id',
        'note',
    ];
    protected $primaryKey = 'order_detail_id';
    protected $table = 'order_detail';
}
