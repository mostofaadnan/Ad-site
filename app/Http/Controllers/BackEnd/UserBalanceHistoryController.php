<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\userBalance;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User;
class UserBalanceHistoryController extends Controller
{

    public function index()
    {
        $balance = 0;
        $credit = userBalance::where('cancel', 0)->sum('credit');
        $debit = userBalance::where('cancel', 0)->sum('debit');
        $balance = ($credit - $debit);
        return view('BackEnd.userBalance.index',compact('credit','debit','balance'));
    }
    public function LoadAll()
    {

        $userbalance = userBalance::orderBy('id', 'DESC')
            ->latest()
            ->get();

        return Datatables::of($userbalance)
            ->addIndexColumn()

            ->addColumn('user', function (userBalance $userBalance) {
                return $userBalance->UserName->name;
            })

            ->addColumn('action', function ($userbalance) {

                $button = ' <div class="dropdown">';
                $button .= ' <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>';
                $button .= '</div>';
                $button .= '<div class="dropdown-menu dropdown-menu-end">';
                $button .= '<a class="dropdown-item" id="datashow" data-id="' . $userbalance->id . '" >View</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="userbalancecheck" data-id="' . $userbalance->user_id . '">User Balance Check</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }

    public function show($id)
    {

        $userbalance = userBalance::find($id);
        return view('BackEnd.userBalance.show', compact('userbalance'));

    }
    public function UserCheck($id)
    {

        $userinfo = User::find($id);
        $balance = 0;
        $credit = userBalance::where('user_id', $id)
            ->where('cancel', 0)->sum('credit');
        $debit = userBalance::where('user_id', $id)
            ->where('cancel', 0)->sum('debit');
        $balance = ($credit - $debit);
        
        return view('BackEnd.userBalance.checkuser', compact('userinfo','id','credit','debit','balance'));

    }


    public function LoadAllUser(Request $request)
    {
        $id = $request->id;
        $userbalance = userBalance::orderBy('id', 'DESC')
        ->where('user_id', $id)
        ->get();

        return Datatables::of($userbalance)
            ->addIndexColumn()
            ->addColumn('action', function ($userbalance) {

                $button = ' <div class="dropdown">';
                $button .= ' <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>';
                $button .= '</div>';
                $button .= '<div class="dropdown-menu dropdown-menu-end">';
                $button .= '<a class="dropdown-item" id="datashow" data-id="' . $userbalance->id . '" >View</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }
}