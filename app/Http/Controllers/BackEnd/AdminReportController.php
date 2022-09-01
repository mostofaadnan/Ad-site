<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdpostReport;
use Yajra\DataTables\DataTables;

class AdminReportController extends Controller
{
    public function index()
    {
        return view('BackEnd.report.index');
    }

    public function LoadAll()
    {

        $adpostreport = AdpostReport::orderBy('id', 'DESC')
            ->latest()
            ->get();

        return Datatables::of($adpostreport)
            ->addIndexColumn()
            ->addColumn('post_title', function (adpostreport $adpostreport) {
                return $adpostreport->PostDetails->title;
            })
            ->addColumn('report_option', function (adpostreport $adpostreport) {
                return $adpostreport->ReportOption->name;
            })
            ->addColumn('user', function (adpostreport $adpostreport) {
                return $adpostreport->UserName->name;
            })
            ->addColumn('action', function ($adpostreport) {

                $button = ' <div class="dropdown">';
                $button .= ' <div class="cursor-pointer font-24 dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown"><i class="bx bx-dots-horizontal-rounded"></i>';
                $button .= '</div>';
                $button .= '<div class="dropdown-menu dropdown-menu-end">';
                $button .= '<a class="dropdown-item" id="datashow" data-id="' . $adpostreport->id . '" >View</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="postdetails" data-id="' . $adpostreport->id . '">Post Details</a>';
                $button .= '<div class="dropdown-divider"></div>';
                $button .= '<a class="dropdown-item" id="delete" data-id="' . $adpostreport->id . '">Delete</a>';
                $button .= '</div>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }

    public function show($id)
    {
        $AdpostReport = AdpostReport::find($id);
        return view('BackEnd.report.show', compact('AdpostReport'));
    }
    public function destroy($id)
    {
        $adpostreport = AdpostReport::find($id);
        if (!is_null($adpostreport)) {
            $adpostreport->delete();
        }

    }
}
