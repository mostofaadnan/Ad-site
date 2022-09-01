<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function StateList()
    {
        return $this->hasMany(state::class, 'country_id','id');
    }
}
