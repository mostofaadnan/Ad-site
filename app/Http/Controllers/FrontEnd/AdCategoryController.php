<?php
namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\Category;
use App\Models\city;
use App\Models\post;
use App\Models\state;
use App\Models\Subcategory;
use Carbon\Carbon;
use App\Models\postdetail;
use Illuminate\Support\Facades\Session;

class AdCategoryController extends Controller
{
    public function index($id)
    {

        $Categorys = Category::where('status', 1)->get();
        Session::put('cityid', $id);
        $city = city::find($id);
        $state = state::find($city->state_id);
        $posts = post::where('post_type', 2)
            ->where('status', 1)
            ->orderBy('id', 'ASC')
            ->get();
        return view('FrontEnd.AdCategory.index', compact('Categorys', 'posts', 'state'));
    }

    public function AdCollection($id)
    {
        $now = now();
        $city_id = Session::get('cityid');
        $subcategory = Subcategory::find($id);
        $city = city::find($city_id);
        $state_id = $city->state_id;

        $adposts = AdPost::where('subcategory_id', $id)
            ->where('city_id', $city_id)
            ->where('state_id', $state_id)
            ->Orwhere([
                ['city_id', 0],
                ['state_id', $state_id],
            ])
            ->where('category_id', $subcategory->category_id)
            ->where('status', 1)
            ->where('created_at', '<=', Carbon::now())
            ->where('ending_date', '>=', Carbon::now())
            ->orderBy('created_at', 'DESC')
            ->paginate(100)
            ->groupBy(function ($acetone) {
                return $acetone->created_at->toDateString();
            });
        return view('FrontEnd.AdCategory.AdCollection', compact('adposts', 'subcategory'));

    }
    public function AdDetails($id)
    {

        $adpost = AdPost::find($id);
        $date = $adpost->created_at;
        $postdate = strtotime($date);
        $postdate = date('l, d M Y h:i', $postdate);
        views($adpost)->record();
        
        return view('FrontEnd.AdCategory.Details', compact('adpost', 'postdate','age'));
    }
}
