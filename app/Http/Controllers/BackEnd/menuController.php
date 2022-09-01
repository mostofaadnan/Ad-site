<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class menuController extends Controller
{
    public function index()
    {

        return view('BackEnd.page.menu.menu');
    }
    public function LoadAll()
    {
        $menu = menu::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($menu)
            ->addIndexColumn()
            ->addColumn('page', function (menu $menu) {
                return $menu->PageName->title;
            })
            ->addColumn('menu_type', function (menu $menu) {
                return $menu->menu_type == 1 ? 'Header' : 'Footer';
            })
            ->addColumn('action', function ($menu) {

                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $menu->id . '" data-bs-toggle="modal" data-bs-target="#menumodal"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $menu->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {

        $menu = new menu();
        $menu->menu_title = $request->menu_title;
        $menu->page_id = $request->page_id;
        $menu->menu_type = $request->menu_type;
        $menu->save();
        return response()->json($menu);

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
        $menu = menu::find($id);
        return response()->json($menu);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $menu = menu::find($id);
        $menu->menu_title = $request->menu_title;
        $menu->page_id = $request->page_id;
        $menu->menu_type - $request->menu_types;
        $menu->update();
        return response()->json($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $menu = menu::find($id);
        if (!is_null($menu)) {
            $menu->delete();
        }
    }
}