<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picture_library extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'product_detail_id'
    ];
    protected $primaryKey = 'picture_id';
    protected $table = 'picture_libraries';
}
