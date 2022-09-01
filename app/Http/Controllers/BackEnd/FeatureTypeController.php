<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\featureType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class FeatureTypeController extends Controller
{
    
    public function index()
    {
        // $cate = Category::orderBy("id", "asc")->paginate(1);
        return view('BackEnd.setup.featureType');
    }
    public function LoadAll(Request $request)
    {
        $featureType = featureType::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($featureType)
            ->addIndexColumn()

            ->addColumn('status', function (featureType $featureType) {
                return $featureType->status == 1 ? 'Active' : 'Inactive';
            })
    
            ->addColumn('action', function ($featureType) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $featureType->id . '" data-bs-toggle="modal" data-bs-target="#featuremodal"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $featureType->id . '"><i class="bx bxs-trash"></i></button>';
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

        $total_day = $request->total_day;
        $amount = $request->amount;
        $status = $request->status;

        $insert = featureType::insert([
            "total_day" => $total_day,
            "amount" => $amount,
            "status" => $status,
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
        $featureType = featureType::find($id);
        return response()->json($featureType);
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
        $update = featureType::find($id);
        if(!is_null($update)){
            $update->total_day = $request->total_day;
            $update->amount = $request->amount;
            $update->status = $request->status;
            $update->update();
        }
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $featureType = featureType::find($id);
        if (!is_null($featureType)) {
            $featureType->delete();
            return response()->json($featureType);
        }
    }


}