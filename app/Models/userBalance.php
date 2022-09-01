<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userBalance extends Model
{
    use HasFactory;
    public function UserBalance()
    {
        return $this->belongsTo(userBalance::class, 'user_id', 'id');
    }
    public function UserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
