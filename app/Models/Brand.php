<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand_name',
        'note',
        'status',
    ];
    protected $primaryKey = 'brand_id';
    protected $table = 'brand';
}
