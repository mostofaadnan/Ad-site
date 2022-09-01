<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class postdetail extends Model
{
    use HasFactory;
    public function PostType()
    {
        return $this->belongsTo(postfield::class, 'field_id', 'id');
    }

}
