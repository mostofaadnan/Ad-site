<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use App\Models\Admin;
class AdminResetPasswordController extends Controller
{
    public function index()
    {
        return view('BackEnd.admin.resetpassword');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        return redirect()->route('admin.home');
    }
}
