<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone_number',
        'status',
        'total',
        'payment_method_id',
        'shipping_method_id',
        'payment_status',
        'user_id',
        'voucher_id',
        'employee_id',
        'note',
    ];
    protected $primaryKey = 'order_id';
    protected $table = 'order';
}
