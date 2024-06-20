<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'name',
        'phone_number',
        'status',
        'total',
        'payment_method_id',
        'shipping_method_id',
        'user_id',
        'voucher_id',
        'employee_id',
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'order';
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }
}
