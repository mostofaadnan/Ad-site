<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\Category;
use App\Models\Subcategory;
use DataTables;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{

    public function index()
    {
        $category = Category::orderby('id', 'asc')
        ->where('status',1)
        ->get();
        return view('BackEnd.setup.subcategory', compact('category'));
    }
    public function LoadAll()
    {
        $subcategory = Subcategory::orderBy('id', 'desc')
            ->latest()
            ->where('status',1)
            ->get();
        return Datatables::of($subcategory)
            ->addIndexColumn()
            ->addColumn('category', function (subcategory $subcategory) {
                return $subcategory->Categoryname->title;
            })
            ->addColumn('status', function (subcategory $subcategory) {
                return $subcategory->status == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('action', function ($subcategory) {

                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $subcategory->id . '" data-bs-toggle="modal" data-bs-target="#subcategorymodel"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $subcategory->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {

        $title = $request->title;
        $categoryid = $request->categoryid;
        $description = $request->description;
        $status = $request->status;

        $insert = Subcategory::insert([
            "title" => $title,
            "category_id" => $categoryid,
            "description" => $description,
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
        $subcategory = Subcategory::find($id);
        return response()->json($subcategory);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $update = Subcategory::find($id);
        if (!is_null($update)) {
            $update->title = $request->title;
            $update->category_id = $request->categoryid;
            $update->description = $request->description;
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
        $subcategordelete = Subcategory::find($id);
        if (!is_null($subcategordelete)) {
            $adpost = AdPost::where('category_id', $subcategordelete->id)->get();
            if ($adpost->count() > 0) {
                $subcategordelete->status = 0;
                $subcategordelete->update();
            } else {
                $subcategordelete->delete();
            }

        }

    }
}
