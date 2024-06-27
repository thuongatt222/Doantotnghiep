<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
    ];
    protected $primaryKey = 'favourite_id';
    protected $table = 'favourite';
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', "product_id");
    }
}
