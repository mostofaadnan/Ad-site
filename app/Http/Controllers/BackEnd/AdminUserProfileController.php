<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class AdminUserProfileController extends Controller
{
    public function Profile()
    {
        return view('BackEnd.Admin.profile');
    }

    
    public function ImageChange(Request $request)
    {
   
        $user = Admin::find(Auth::user()->id);
        if ($request->hasFile('file')) {
            if (File::exists(public_path('image/user/' . $user->image))) {
                File::delete(public_path('image/user/' . $user->image));
            }
            $image = $request->File('file');
            $Path = public_path('/image/user/');
            $img = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $Img = Image::make($image->getRealPath());
            $Img->save($Path . '/' . $img, 50);
            $user->image = $img;
        }
        $user->update();
        return response()->json($request->File('file'));
    }

}