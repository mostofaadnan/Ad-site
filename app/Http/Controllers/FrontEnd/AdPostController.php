<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AdPost;
use App\Models\Category;
use App\Models\city;
use App\Models\Country;
use App\Models\ExtendType;
use App\Models\featureType;
use App\Models\postdetail;
use App\Models\postImage;
use App\Models\state;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\userBalance;
use App\Notifications\PostNotification;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Image;
use Storage;

class AdPostController extends Controller
{
    public function index()
    {
        $lists = Country::where('id', 231)
            ->orwhere('id', 38)
            ->orwhere('id', 13)
            ->OrderBy('id', 'DESC')
            ->get();

        $canadalists = state::where('country_id', 38)->get();
        $australialists = state::where('country_id', 13)->get();

        return view('FrontEnd.PostAd.LocationSet', compact('lists', 'canadalists', 'australialists'));
        /* return view('FrontEnd.PostAd.LocationSet'); */
    }

    public function postCategory($id)
    {

        Session::put('city_id', $id);
        $Categorys = Category::where('status', 1)->get();
        return view('FrontEnd.PostAd.postcategory', compact('Categorys'));

    }
    public function postCategoryBystate($id)
    {

        Session::put('city_id', "0");
        Session::put('state_id', $id);
        $Categorys = Category::where('status', 1)->get();
        return view('FrontEnd.PostAd.postcategory', compact('Categorys'));

    }
    public function posSubCategory($id)
    {
        Session::put('category_id', $id);
        $subcategoryis = Subcategory::where('category_id', $id)->get();
        return view('FrontEnd.PostAd.postSubcategory', compact('subcategoryis'));
    }

    public function NewPost($id)
    {
        $userBalance = $this->UserBalance();
        Session::put('subcategory_id', $id);
        $city_id = Session::get('city_id');

        $category_id = Session::get('category_id');
        $Subcategory_id = $id;

        $category = Category::find($category_id);
        $subcategory = Subcategory::find($Subcategory_id);

        if ($city_id == null) {
            redirect()->route('adpost.locationSet');

        } else if ($category_id == null && $Subcategory_id == null) {
            redirect()->route('adpost.category');
        } else {

            if ($city_id == "0") {

                $state_id = Session::get('state_id');
                $city = '';

            } else {

                $city = city::find($city_id);
                $state_id = $city->state_id;
                Session::put('state_id', $state_id);
            }

            $state = state::find($state_id);
            $country_id = $state->country_id;
            Session::put('country_id', $country_id);
            $country = Country::find($country_id);

            $postAbility = $this->PostAbility($category);
            $imagelimit = $postAbility == 1 ? 3 : 6;
            $features = featureType::where('status', 1)->get();
            $extends = ExtendType::where('status', 1)->get();
            return view('FrontEnd.PostAd.newPost', compact('features', 'extends', 'category', 'subcategory', 'city', 'state', 'country', 'userBalance', 'postAbility', 'imagelimit', 'city_id'));

        }

    }

    public function Category()
    {
        $Categorys = Category::where('status', 1)->get();
        return view('FrontEnd.PostAd.postcategory', compact('Categorys'));
    }

    public function StorePost(Request $request)
    {

        $city_id = Session::get('city_id');
        $category_id = Session::get('category_id');
        $Subcategory_id = Session::get('subcategory_id');
        $category = Category::find($category_id);

        if ($city_id == null) {
            route('adpost.locationSet');
        } else if ($category_id == null && $Subcategory_id == null) {
            route('adpost.category');
        } else {
            $toalcharge = 0;
            $totalpublishday = 0;
            $postAbility = $this->PostAbility($category);
            $userBalance = $this->UserBalance();

            $featurecharge = 0;
            $featureDay = 0;
            $extendcharge = 0;
            $extendday = 0;
            $publishday = 0;
            if ($request->feature_id > 0) {
                $feature = featureType::find($request->feature_id);
                $featurecharge = $feature->amount;
                $featureDay = $feature->total_day;
            } else {
                $featurecharge = 0;
            }
            if ($request->extend_day_id > 0) {
                $extend = ExtendType::find($request->extend_day_id);
                $extendcharge = $extend->amount;
                $extendday = $extend->total_day;
            } else {
                $extendcharge = 0;
            }

            if ($postAbility == 1) {
                $post_charg = 0;
                $toalcharge = $post_charg + $featurecharge + $extendcharge;
                $publishday = $category->free_post_publish_day;
            } else {
                $post_charg = $category->per_post_charge;
                $toalcharge = $post_charg + $featurecharge + $extendcharge;
                $publishday = $category->premimum_publish_day;
            }
            if ($userBalance >= $toalcharge) {
                $totalpublishday = $featureDay + $extendday + $publishday;
                $this->savePost($request, $toalcharge, $postAbility, $totalpublishday);
            } else {
                Session()->flash('erors', 'You Have no suitiable charge for this post');
            }

            return redirect()->back();
        }

    }
    public function savePost(Request $request, $totalcharge, $postAbility, $totalpublishday)
    {

        $currentD = Carbon::now();
        $c = $currentD->format('l d M Y');
        $endingdate = $currentD->addDays($totalpublishday);
        $endingdateFormat = $endingdate->format('l d M Y');

        $country_id = Session::get('country_id');
        $state_id = Session::get('state_id');
        $city_id = Session::get('city_id');
        $category_id = Session::get('category_id');
        $Subcategory_id = Session::get('subcategory_id');
        $category = Category::find($category_id);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'agree_term' => 'required|numeric',

        ]);
        $AdPost = new AdPost();
        $AdPost->date = $c;
        $AdPost->country_id = $country_id;
        $AdPost->state_id = $state_id;
        $AdPost->city_id = $city_id;
        $AdPost->category_id = $category_id;
        $AdPost->subcategory_id = $Subcategory_id;
        $AdPost->user_id = Auth::id();
        $AdPost->feature_id = $request->feature_id;
        $AdPost->extend_day_id = $request->extend_day_id;
        $AdPost->display_email = $request->display_email;
        $AdPost->ad_day = $totalpublishday;
        $AdPost->ending_date = $endingdateFormat;
        $AdPost->title = $request->title;
        $AdPost->status = 1;
        $AdPost->post_type = $postAbility;
        if ($AdPost->save()) {
            Storage::put('/public/post/description/details-' . $AdPost->id . '.txt', $request->description);
            if ($category->post_field_type == 2) {
                foreach ($category->PostType as $post) {
                    $fieldname = $post->field_name;
                    $fieldlabel = $post->field_label;
                    $postdetails = new postdetail();
                    $postdetails->post_id = $AdPost->id;
                    $postdetails->field_id = $post->id;
                    $postdetails->field_name = $fieldlabel;
                    $postdetails->description = $request->$fieldname;
                    $postdetails->save();
                }
                $AdPost->details = 1;
                $AdPost->update();

            }

            if ($category->adult_content == 1) {

                //Service
                $fieldname = "Service";
                $description = $request->service;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //Incall
                $fieldname = "Incall";
                $description = $request->incall;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //Outcall
                $fieldname = "Outcall";
                $description = $request->outcall;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //sexual_orientation
                $fieldname = "sexual_orientation";
                $description = $request->sexual_orientation;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                $AdPost->details = 1;
                $AdPost->update();
            }
            $imagelimit = $postAbility == 1 ? 3 : 6;
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $file) {
                    $valid = false;
                    if ($imagelimit > $key) {
                        $valid = true;
                    } else {

                        $valid = false;
                    }
                    if ($valid) {
                        $Path = public_path('/image/post/');
                        $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                        $Img = Image::make($file->getRealPath());
                        $Img->save($Path . '/' . $img, 50);

                        $imagepost = new postImage();
                        $imagepost->post_id = $AdPost->id;
                        $imagepost->image = $img;
                        $imagepost->save();
                    }

                }
            }
            $admins = Admin::all();
            foreach ($admins as $admin) {
                Admin::find($admin->id)->notify(new PostNotification($AdPost));
            }
            if ($totalcharge > 0) {
                $this->PostCharge($totalcharge);
            }

            Session::put('id', $AdPost->id);
            Session()->flash('success', 'New Ad post save successfully');

        } else {
            Session()->flash('erors', 'Fail To save New Post');
        }

    }

    public function saveAdultContent($postid, $fieldname, $description)
    {
        $postdetails = new postdetail();
        $postdetails->post_id = $postid;
        $postdetails->field_name = $fieldname;
        $postdetails->description = $description;
        $postdetails->save();
    }
    public function PostAbility(Category $category)
    {
        $postAbility = 0;
        $userbaance = $this->UserBalance();
        $total_free_post = $category->total_free_post;
        $premium_post_charge = $category->per_post_charge;
        if ($total_free_post > 0) {
            $AdPost = AdPost::where('user_id', Auth::id())
                ->where('post_type', 1)
                ->get();
            if ($total_free_post > $AdPost->count()) {
                $postAbility = 1;
            } else {

                if ($userbaance >= $premium_post_charge) {
                    $postAbility = 2;

                } else {
                    $postAbility = 0;
                }
            }

        } else {

            if ($userbaance >= $premium_post_charge) {
                $postAbility = 2;

            } else {
                $postAbility = 0;
            }

        }
        return $postAbility;
    }

    public function UserBalance()
    {
        $balance = 0;
        $userid = Auth::user()->id;
        $credit = userBalance::where('user_id', $userid)
            ->where('cancel', 0)->sum('credit');
        $debit = userBalance::where('user_id', $userid)
            ->where('cancel', 0)->sum('debit');
        $balance = ($credit - $debit);
        return $balance;
    }

    public function PostCharge($amount)
    {

        $userbalance = new userBalance();
        $userbalance->user_id = Auth::id();
        $userbalance->description = "Post Charge";
        $userbalance->credit = 0;
        $userbalance->debit = $amount;
        $userbalance->status = 'Confirm';
        $userbalance->currency = 'USD';
        $userbalance->save();
    }

    public function edit($id)
    {

        $adpost = AdPost::find($id);
        $postimage = $adpost->ImagePost->count();
        /*  dd($postimage); */
        $post_type = $adpost->post_type;
        if ($post_type == 1) {
            $imagelimit = 3 - $postimage;
        } else {
            $imagelimit = 6 - $postimage;
        }
    

        $features = featureType::where('status', 1)->get();
        $extends = ExtendType::where('status', 1)->get();
        $service = postdetail::select('description')->where('field_name', 'Service')
            ->where('post_id', $id)->first();
        $incall = postdetail::select('description')->where('field_name', 'Incall')
            ->where('post_id', $id)->first();
        $outcall = postdetail::select('description')->where('field_name', 'Outcall')
            ->where('post_id', $id)->first();
        $sexual_orientation = postdetail::select('description')->where('field_name', 'sexual_orientation')
            ->where('post_id', $id)->first();
        $postdetails = postdetail::where('field_id', '>', '0')
            ->where('post_id', $id)->get();
        return view('FrontEnd.PostAd.edit', compact('adpost', 'features', 'extends', 'service', 'incall', 'outcall', 'sexual_orientation', 'postdetails', 'imagelimit','postimage'));
    }

    public function DeleteImage($id)
    {
        $postImage = postImage::find($id);
        if (!is_null($postImage)) {
            if (File::exists(public_path('/image/post/' . $postImage->image))) {
                File::delete(public_path('/image/post/' . $postImage->image));
            }
            $postImage->delete();
        }
        return redirect()->route('adpost.edit', $postImage->post_id);
    }
    public function Update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $AdPost = AdPost::find($request->id);
        $AdPost->title = $request->title;
        if ($AdPost->update()) {
            //Adpost Details Delete
            if ($AdPost->details == 1) {
                foreach ($AdPost->PostDetails as $details) {
                    $details->delete();
                }
            }
            //Delete Details
            if (File::exists('storage/app/public/post/description/details-' . $request->id . '.txt')) {
                File::delete('storage/app/public/post/description/details-' . $request->id . '.txt');
            }

            Storage::put('/public/post/description/details-' . $AdPost->id . '.txt', $request->description);
            if ($AdPost->CategoryName->post_field_type == 2) {
                foreach ($AdPost->CategoryName->PostType as $post) {
                    $fieldname = $post->field_name;
                    $fieldlabel = $post->field_label;
                    $postdetails = new postdetail();
                    $postdetails->post_id = $AdPost->id;
                    $postdetails->field_id = $post->id;
                    $postdetails->field_name = $fieldlabel;
                    $postdetails->description = $request->$fieldname;
                    $postdetails->save();
                }
                $AdPost->details = 1;
                $AdPost->update();
            }

            if ($AdPost->CategoryName->adult_content == 1) {
                //Service
                $fieldname = "Service";
                $description = $request->service;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);
                //Incall
                $fieldname = "Incall";
                $description = $request->incall;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //Outcall
                $fieldname = "Outcall";
                $description = $request->outcall;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //Outcall
                $fieldname = "Outcall";
                $description = $request->outcall;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                //Sexual Orientation
                $fieldname = "sexual_orientation";
                $description = $request->sexual_orientation;
                $this->saveAdultContent($AdPost->id, $fieldname, $description);

                $AdPost->details = 1;
                $AdPost->update();
            }
            //Image
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $key => $file) {

                    $Path = public_path('/image/post/');
                    $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                    $Img = Image::make($file->getRealPath());
                    $Img->save($Path . '/' . $img, 50);

                    $imagepost = new postImage();
                    $imagepost->post_id = $AdPost->id;
                    $imagepost->image = $img;
                    $imagepost->save();

                }
            }
            Session::put('id', $AdPost->id);
            Session()->flash('success', 'Ad Post Update successfully');

        } else {
            Session()->flash('erors', 'Fail To Update Post');
        }
        return redirect()->route('adpost.edit', $request->id);

    }
}
