<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\ExtendType;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ExtendDayTypeController extends Controller
{
     
    public function index()
    {
        // $cate = Category::orderBy("id", "asc")->paginate(1);
        return view('BackEnd.setup.extendtype');
    }
    public function LoadAll(Request $request)
    {
        $ExtendType = ExtendType::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($ExtendType)
            ->addIndexColumn()

            ->addColumn('status', function (ExtendType $ExtendType) {
                return $ExtendType->status == 1 ? 'Active' : 'Inactive';
            })
    
            ->addColumn('action', function ($ExtendType) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $ExtendType->id . '" data-bs-toggle="modal" data-bs-target="#extendmodal"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $ExtendType->id . '"><i class="bx bxs-trash"></i></button>';
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

        $insert = ExtendType::insert([
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
        $ExtendType = ExtendType::find($id);
        return response()->json($ExtendType);
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
        $update = ExtendType::find($id);
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

        $ExtendType = ExtendType::find($id);
        if (!is_null($ExtendType)) {
            $ExtendType->delete();
            return response()->json($ExtendType);
        }
    }

}