<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\Category;
use App\Models\postfield;
use App\Models\Subcategory;
use DataTables;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        return view('BackEnd.setup.category');
    }
    public function LoadAll(Request $request)
    {
        $Category = Category::orderBy('id', 'desc')
            ->where('status', 1)
            ->latest()
            ->get();
        return Datatables::of($Category)
            ->addIndexColumn()

            ->addColumn('status', function (Category $Category) {
                return $Category->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('post_type', function (Category $Category) {
                return $Category->post_type == 1 ? 'Defauld' : 'Custom';
            })

            ->addColumn('action', function ($Category) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $Category->id . '" data-bs-toggle="modal" data-bs-target="#categorymodel"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $Category->id . '"><i class="bx bxs-trash"></i></button>';
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

        $post_type = $request->post_type;
        $Category = new Category();
        $Category->title = $request->title;
        $Category->post_field_type = $request->post_type;
        $Category->total_free_post = $request->total_free_post;
        $Category->per_post_charge = $request->per_post_charge;
        $Category->free_post_publish_day = $request->free_post_publish_day;
        $Category->premimum_publish_day = $request->premimum_publish_day;
        $Category->adult_content = $request->adult_content;
        $Category->status = $request->status;
        if ($Category->save()) {
            if ($post_type == 2) {
                $tableData = $request->itemtables;
                foreach ($tableData as $items) {
                    $field_name = $items['field_name'];
                    $fieldname = preg_replace("/[\s_]/", "_", $field_name);
                    $tableData = $request->itemtables;
                    $postfield = new postfield();
                    $postfield->category_id = $Category->id;
                    $postfield->field_label = $items['field_label'];
                    $postfield->field_name = $fieldname;
                    $postfield->field_type = $items['field_type'];
                    $postfield->save();
                }
            }
            return response()->json($Category);
        }
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
        $category = Category::with('PostType')->find($id);
        return response()->json($category);
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
        $post_type = $request->post_type;
        $Category = Category::find($id);
        $Category->title = $request->title;
        $Category->post_field_type = $request->post_type;
        $Category->total_free_post = $request->total_free_post;
        $Category->per_post_charge = $request->per_post_charge;
        $Category->free_post_publish_day = $request->free_post_publish_day;
        $Category->premimum_publish_day = $request->premimum_publish_day;
        $Category->adult_content = $request->adult_content;
        $Category->status = $request->status;
        if ($Category->update()) {
            if ($post_type == 2) {
                $postfields = postfield::where('category_id', $Category->id)->get();
                foreach ($postfields as $pf) {
                    if (!is_null($pf)) {
                        $pf->delete();
                    }
                }
                $tableData = $request->itemtables;
                foreach ($tableData as $items) {
                    $field_name = $items['field_name'];
                    $fieldname = preg_replace("/[\s_]/", "_", $field_name);
                    $tableData = $request->itemtables;
                    $postfield = new postfield();
                    $postfield->category_id = $Category->id;
                    $postfield->field_label = $items['field_label'];
                    $postfield->field_name = $fieldname;
                    $postfield->field_type = $items['field_type'];
                    $postfield->save();
                }
            }
            return response()->json($Category);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $categorydelete = Category::find($id);
        if (!is_null($categorydelete)) {
            $adpost = AdPost::where('category_id', $categorydelete->id)->get();
            if ($adpost->count() > 0) {
                $categorydelete->status = 0;
                $categorydelete->update();
            } else {
                $subcategordelete = Subcategory::where('category_id', $id)->get();
                if (!is_null($subcategordelete)) {
                    foreach ($subcategordelete as $subcate) {
                        $subcate->delete();
                    }
                }
                $categorydelete->delete();
            }

            return response()->json($categorydelete);
        }
    }

    public function GetList()
    {
        $category = Category::all();
        return response()->json($category);

    }
}
