<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $fillable = [
        'discount',
        'start_day',
        'end_day',
        'status',
        'note',
        'product_id'
    ];
    protected $primaryKey = 'discount_id';
    protected $table = 'discount';
}
