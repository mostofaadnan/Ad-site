<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\postImage;
use App\Models\User;
use App\Models\userBalance;
use Carbon\Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserControllerManagement extends Controller
{
    public function index()
    {
        $userBalance = $this->UserBalance();
        $free_post = AdPost::where('post_type', 1)
            ->where('user_id', Auth::id())
            ->get()->count();
        $paid_post = AdPost::where('post_type', 2)
            ->where('user_id', Auth::id())
            ->get()->count();
        $active_post = AdPost::where('created_at', '<=', Carbon::now())
            ->where('ending_date', '>=', Carbon::now())
            ->where('user_id', Auth::id())
            ->get()->count();

        return view('FrontEnd.user.Dashboard', compact('userBalance', 'free_post', 'paid_post', 'active_post'));
    }
    public function ManagePost()
    {
        $adposts = AdPost::where('user_id', Auth::id())->paginate(10);
        return view('FrontEnd.user.managepost', compact('adposts'));
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

    public function UserSetting()
    {

        return view('FrontEnd.user.setting');
    }

    public function UserUpdate(Request $request)
    {
        $user = Auth::user();
        /*      dd($user); */
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_name' => 'required|unique:users,user_name,' . $user->id,
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);

        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        $user->update([
            'user_name' => $request->user_name,
            'name' => $request->name,
            /* 'email' => $request->email, */
        ]);

        if ($user->email != $request->email) {
            $user->newEmail($request->email);
        }
        Session()->flash('success', 'Your Information Update Successfuly');
        return redirect()->route('user.Setting');
    }

    public function PostDestroy($id)
    {
        $adpost = AdPost::find($id);
        if (!is_null($adpost)) {

            if (File::exists('storage/app/public/post/description/details-' . $id . '.txt')) {
                File::delete('storage/app/public/post/description/details-' . $id . '.txt');
            }

            $postimages = postImage::where('post_id', $id)->get();
            foreach ($postimages as $image) {
                if (!is_null($image)) {
                    if (File::exists(public_path('/image/post/' . $image->image))) {
                        File::delete(public_path('/image/post/' . $image->image));
                    }
                    $image->delete();
                }
            }
            if ($adpost->details == 1) {
                foreach ($adpost->PostDetails as $details) {
                    $details->delete();
                }
            }
            $adpost->delete();
        }

    }
}
