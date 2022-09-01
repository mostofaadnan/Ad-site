<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class AdPost extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;
    public function Categoryname()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function SubCategoryname()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id','id');
    }

    public function CountryName()
    {
        return $this->belongsTo(Country::class, 'country_id','id');
    }

    public function StateName()
    {
        return $this->belongsTo(state::class, 'state_id','id');
    }
    public function CityName()
    {
        return $this->belongsTo(city::class, 'city_id','id');
    }
    public function UserName(){
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function PostDetails()
    {
        return $this->hasMany(postdetail::class, 'post_id');
    }

    public function ImagePost()
    {
        return $this->hasMany(postImage::class, 'post_id');
    }


}
