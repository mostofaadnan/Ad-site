<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\emailad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTException;
use Mail;

class EmailAdController extends Controller
{
    public function create($id)
    {
        $adPost = AdPost::find($id);

        return view('FrontEnd.emailad.create', compact('adPost'));

    }
    public function store(Request $request)
    {

        $this->validate(
            $request,
            ['friend_name' => 'required'],
            ['friend_name.required' => 'Friends Name Required'],
            ['friends_email' => 'required|email'],
            ['frends_email.required' => 'Friends Email Required'],
        );

        $emailad = new emailad();
        $emailad->user_id = Auth::id();
        $emailad->post_id = $request->post_id;
        $emailad->friends_email = $request->friends_email;
        $emailad->friend_name = $request->friend_name;
        $emailad->message = $request->message;
        if ($emailad->save()) {
            $this->ConfirmationMail($emailad);
            Session()->flash('success', 'Your Email Successfuly Send');
            return redirect()->route('Emailad.show', $emailad->id);
        } else {
            Session()->flash('erors', 'Fail T send email');
            return redirect()->back();
        }

    }

    public function show($id)
    {
        $emailad = emailad::find($id);
        return view('FrontEnd.emailad.show', compact('emailad'));

    }

    public function ConfirmationMail($emailad)
    {

        $data["email"] = $emailad->friends_email;
        $data["Friend_name"] = $emailad->friend_name;
        $data["subject"] = "Ad Post";
        $data["message"] = $emailad->message;
        $data["name"] = $emailad->UserName->name;
        $data["email"] = $emailad->UserName->email;
        $data["title"] = $emailad->PostDetails->title;
        $data["post_id"] = $emailad->PostDetails->id;
        try {
            Mail::send('FrontEnd.emailad.email', compact('data'), function ($message) use ($data) {
                $message->to($data["email"], $data["Friend_name"])
                    ->subject($data["subject"]);
            });
        } catch (JWTException $exception) {
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {

            Session()->flash('success', 'Error sending mail');
        } else {

         Session()->flash('success', 'Message sent Succesfully');
        }

        return;
    }
}