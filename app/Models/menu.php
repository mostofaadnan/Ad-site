<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    use HasFactory;

    public function PageName()
    {
        return $this->belongsTo(page::class, 'page_id', 'id');
    }
}
