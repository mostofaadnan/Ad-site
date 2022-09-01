<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\User;
use App\Models\userBalance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('BackEnd.user.index');

    }
    public function LoadAll()
    {
        $users = User::orderBy('id', 'desc')->latest()
            ->get();

        return Datatables::of($users)
            ->addIndexColumn()

            ->addColumn('status', function ($users) {
                return $users->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('action', function ($users) {
                $button = '<div class="btn-group" role="group" aria-label="Basic example">';
                $button .= '<a href=' . route('userlist.postlist', $users->id) . '   class="delete btn btn-success btn-sm">Post lIst</a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button id="userbalancecheck" type="button" name="delete" data-id=' . $users->id . ' class="btn btn-info btn-sm">User Balance Check</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a href='.route('userlist.userReloadBalance').' class="btn btn-warning btn-sm">User Balance Check</button>';
                $button .= '&nbsp;&nbsp;';
                /*  $button .= '<button id="datadelete" type="button" name="delete" data-id=' . $users->id . ' class="btn btn-danger btn-sm">Inactive</button>'; */
                $button .= '</div>';
                return $button;
            })
            ->make(true);
    }

    public function userPostList($id)
    {
        $userinfo = User::find($id);

        return view('BackEnd.user.postlist', compact('userinfo'));
    }

    public function LoadAllUerPost($id)
    {

        $AdPost = AdPost::orderBy('id', 'DESC')
            ->where('user_id', $id)
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
                $button .= '<a class="dropdown-item" id="userbalancecheck" data-id="' . $AdPost->user_id . '">User Balance Check</a>';
                
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }

    public function userReloadBalance($id)
    {

        $userinfo = User::find($id);
        $balance = 0;
        $credit = userBalance::where('user_id', $id)
            ->where('cancel', 0)->sum('credit');
        $debit = userBalance::where('user_id', $id)
            ->where('cancel', 0)->sum('debit');
        $balance = ($credit - $debit);
        return view('BackEnd.userBalance.reloadbalance', compact('userinfo','credit','debit','balance'));

    }

    public function reloadStore(Request $request)
    {

        $request->validate([
            'credit' => 'required',
        ]);
        $userbalance = new userBalance();
        $userbalance->credit = $request->credit;
        $userbalance->user_id = $request->user_id;
        $userbalance->payment_description = $request->payment_description;
        $userbalance->transection = $request->transection;
        $userbalance->currency = $request->currency;
        if ($userbalance->save()) {

            Session()->flash('success', 'Successfully reload Balance');
        } else {
            Session()->flash('erors', 'Fail To Reload Balance');
        }
        return redirect()->route('userbalancesHistory');

    }
}
