<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Image;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('BackEnd.Admin.index');
    }
    public function create()
    {

        return view('BackEnd.Admin.create');
    }

    public function LoadAll()
    {
        $users = Admin::orderBy('id', 'desc')->latest()
            ->get();

        /* $table = Datatables::of($purchases);
        return $table->make(true); */
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('status', function ($users) {
                return $users->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($users) {
                $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                $button .= '<button id="dataedit" type="button" name="delete" data-id="' . $users->id . '" class="delete btn btn-outline-success btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button id="datadelete" type="button" name="delete" data-id="' . $users->id . '" class="btn btn-outline-danger btn-sm">Delete</button>';
                $button .= '</div>';
                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|same:password_confirmation',
        ]);

        $input = $request->all();

        $input['password'] = Hash::make($input['password']);
        if ($request->hasFile('user_image')) {

            $image = $request->File('user_image');
            $Path = public_path('/image/user/');
            $img = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $Img = Image::make($image->getRealPath());
            $Img->save($Path . '/' . $img, 50);
            $input['image'] = $img;
        }
        Admin::create($input);
        return redirect()->route('admins');
        Session()->flash('success', 'New User Has been Insert successfully');

    }

    public function edit($id)
    {

        $user = Admin::find($id);
        return view('BackEnd.Admin.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,

        ]);
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $user = Admin::find($id);
        if ($request->hasFile('user_image')) {
            if (File::exists(public_path('image/user/' . $user->image))) {
                File::delete(public_path('image/user/' . $user->image));
            }
            $image = $request->File('user_image');
            $Path = public_path('/image/user/');
            $img = time() . rand(1, 100) . '.' . $image->getClientOriginalExtension();
            $Img = Image::make($image->getRealPath());
            $Img->save($Path . '/' . $img, 50);
            $input['image'] = $img;
        }
        $user->update($input);
        return redirect()->route('admins');
        Session()->flash('success', 'User Information Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
    }
}
