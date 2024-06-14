<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $fillable = [
        'size',
        'status',
    ];
    protected $table = 'sizes';
    protected $primaryKey = 'size_id';
}
