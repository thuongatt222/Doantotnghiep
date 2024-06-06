<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'token'];
    protected $primaryKey = 'email';
    protected $table = 'password_reset_tokens';
    public function user(){
        return $this->hasOne(User::class, 'email', 'email');
    }
    public function scopeCheckToken($q, $token){
        return $q->where('token', $token)->firstOrFail();
    }
}
