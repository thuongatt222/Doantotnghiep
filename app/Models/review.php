<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review',
        'evaluation',
        'product_id',
        'user_id',
    ];
    protected $primaryKey = 'review_id';
    protected $table = 'review_and_evaluation';
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
