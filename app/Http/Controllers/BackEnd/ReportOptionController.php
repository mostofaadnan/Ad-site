<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\reportOption;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportOptionController extends Controller
{
    public function index()
    {
        return view('BackEnd.setup.reportoption');
    }
    public function LoadAll(Request $request)
    {
        $reportOption = reportOption::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($reportOption)
            ->addIndexColumn()

            ->addColumn('status', function (reportOption $reportOption) {
                return $reportOption->status == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('action', function ($reportOption) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $reportOption->id . '" data-bs-toggle="modal" data-bs-target="#reportoptionmodal"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $reportOption->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $insert = reportOption::insert([
            "name" => $request->name,
            "status" => $request->status,
        ]);
        return response()->json($insert);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->dataid;
        $reportOption = reportOption::find($id);
        return response()->json($reportOption);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $reportOption = reportOption::find($id);
        if (!is_null($reportOption)) {

            $reportOption->name = $request->name;
            $reportOption->status = $request->status;
            $reportOption->update();
        }
        return response()->json($reportOption);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $reportOption = reportOption::find($id);
        if (!is_null($reportOption)) {
            $reportOption->delete();
            return response()->json($reportOption);
        }
    }
}
