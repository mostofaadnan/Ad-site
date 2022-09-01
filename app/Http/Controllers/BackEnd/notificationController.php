<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdPost;
use App\Models\ExtendType;
use App\Models\featureType;
use App\Models\postdetail;
use Illuminate\Notifications\Notification;
class notificationController extends Controller
{
    public function markAsReadmessage($id)
    {

        $notification = auth()->user()->notifications()->where('id', $id)->first();
        $postid = $notification->data['id'];
        if ($notification) {
            $notification->markAsRead();
            $adpost = AdPost::find($postid);
            $features = featureType::where('status', 1)->get();
            $extends = ExtendType::where('status', 1)->get();
            return view('BackEnd.post.view', compact('adpost', 'features', 'extends'));
            
        }
    }
}
