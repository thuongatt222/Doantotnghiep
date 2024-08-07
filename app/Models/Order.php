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
        'payment_status',
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
    public function shipping(){
        return $this->belongsTo(Shipping::class, 'shipping_method_id', 'shipping_method_id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_method_id', 'payment_method_id');
    }
}
