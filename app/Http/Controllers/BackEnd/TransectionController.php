<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\userBalance;
class TransectionController extends Controller
{
    
    public function index()
    {
        return view('BackEnd.account.transection');
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
}
