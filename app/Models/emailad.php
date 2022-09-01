<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailad extends Model
{
    use HasFactory;
    public function PostDetails()
    {
        return $this->belongsTo(AdPost::class, 'post_id', 'id');
    }
    public function UserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
