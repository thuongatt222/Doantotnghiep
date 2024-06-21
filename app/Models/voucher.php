<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'voucher_code',
        'voucher',
        'quantity',
        'start_day',
        'end_day',
        'status',
    ];
    protected $primaryKey = 'voucher_id';
    protected $table = 'voucher';
}
