<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
    ];
    protected $primaryKey = 'cart_id';
    protected $table = 'carts';
    public function details()
    {
        return $this->hasMany(CartDetail::class);
    }
}
