<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', // ID pengguna yang melakukan following
        'following_id', // ID pengguna yang diikuti
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function following()
    {
        return $this->belongsTo(User::class, 'following_id');
    }
}