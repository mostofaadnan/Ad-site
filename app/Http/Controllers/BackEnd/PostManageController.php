<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\ExtendType;
use App\Models\featureType;
use App\Models\postImage;
use File;
use Yajra\DataTables\DataTables;

class PostManageController extends Controller
{
    public function index()
    {
        return view('BackEnd.post.index');
    }

    public function LoadAll()
    {

        $AdPost = AdPost::orderBy('id', 'DESC')
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
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="pdf" data-id="' . $AdPost->id . '">Active</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="mail" data-id="' . $AdPost->id . '">User Check</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="canceldata" data-id="' . $AdPost->id . '">Delete</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }

    public function show($id)
    {

        $adpost = AdPost::find($id);
        $features = featureType::where('status', 1)->get();
        $extends = ExtendType::where('status', 1)->get();
        return view('BackEnd.post.view', compact('adpost', 'features', 'extends'));
    }

    public function inActive($id)
    {
        $adpost = AdPost::find($id);
        $adpost->status = 0;
        $adpost->update();
        return redirect()->back();

    }
    public function Active($id)
    {
        $adpost = AdPost::find($id);
        $adpost->status = 1;
        $adpost->update();
        return redirect()->back();

    }

    public function Destroy($id)
    {
        $adpost = AdPost::find($id);
        if (!is_null($adpost)) {

            if (File::exists(public_path('storage/post/description/details-' . $id . '.txt'))) {
                File::delete(public_path('storage/post/description/details-' . $id . '.txt'));
            }

            $postimages = postImage::where('post_id', $id)->get();
            foreach ($postimages as $image) {

                if (!is_null($image)) {
                    if (File::exists(public_path('/image/post/' . $image->image))) {
                        File::delete(public_path('/image/post/' . $image->image));
                    }
                }
                if ($adpost->details == 1) {

                    foreach ($adpost->PostDetails as $details) {
                        $details->delete();
                    }

                }
               
            }
            $adpost->delete();
        }
    }
}
