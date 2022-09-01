<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class HomeController extends Controller
{
    public function index()
    {
        return view('BackEnd.home.index');
    }
    public function CountData(AdPost $adPost)
    {

        $User = User::all();
        $totalUser = $User->count();
        $post = AdPost::all();
        $totalPost = $post->count();
        $totalViews = views($adPost)->count();
        $frerpost = AdPost::where('post_type', 1)->get()->count();
        $paidpost = AdPost::where('post_type', 2)->get()->count();
        return response()->json([
            'totalUser' => $totalUser,
            'totalPost' => $totalPost,
            'totalViews' => $totalViews,
            'freepost' => $frerpost,
            'paidpost' => $paidpost,
        ]);
    }

    public function RecentPost()
    {
        $currentD = Carbon::now();
        $currentdate = $currentD->format('l d M Y');
        $AdPost = AdPost::orderBy('id', 'DESC')
            ->where('date', $currentdate)
            ->latest()
            ->get();
        return Datatables::of($AdPost)
            ->addIndexColumn()
            ->addColumn('category', function (AdPost $AdPost) {
                return $AdPost->Categoryname->title;
            })
            ->addColumn('subcategory', function (AdPost $AdPost) {
                return $AdPost->SubCategoryname->title;
            })
            ->addColumn('user', function (AdPost $AdPost) {
                return $AdPost->UserName->name;
            })

            ->addColumn('location', function (AdPost $AdPost) {
                if ($AdPost->city_id == 0) {
                    $locatoin = 'All City, ' . $AdPost->StateName->name . ',' . $AdPost->CountryName->name;
                } else {
                    $locatoin = $AdPost->CityName->name . ',' . $AdPost->StateName->name . ',' . $AdPost->CountryName->name;
                }
                return $locatoin;
            })
            ->addColumn('status', function (AdPost $AdPost) {
                return $AdPost->status == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('action', function ($AdPost) {

                $button = ' <div class="dropdown">';
                $button .= ' <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>';
                $button .= '</div>';
                $button .= '<div class="dropdown-menu dropdown-menu-end">';
                $button .= '<a class="dropdown-item" id="datashow" data-id="' . $AdPost->id . '" >View</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }
}
