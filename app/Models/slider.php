<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';
    protected $fillable = [
        'title', 'image'
    ];
    protected $primaryKey = 'slide_id';
}
