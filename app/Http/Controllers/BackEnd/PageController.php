<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\menu;
use App\Models\page;
use File;
use Illuminate\Http\Request;
use Storage;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {

        return view('BackEnd.page.index');
    }

    public function LoadAll(Request $request)
    {
        $page = page::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($page)
            ->addIndexColumn()

            ->addColumn('status', function (page $page) {
                return $page->status == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('action', function ($page) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $page->id . '" data-bs-toggle="modal" data-bs-target="#categorymodel"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $page->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }
    public function create()
    {
        return view('BackEnd.page.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $page = new page();
        $page->title = $request->title;
        $page->status = $request->status;
        if ($page->save()) {
            Storage::put('/public/page/page-' . $page->id . '.txt', $request->description);

            Session()->flash('success', 'New Page save successfully');

        } else {
            Session()->flash('erors', 'Fail To save New Page');
        }

        return redirect()->route('pages');

    }

    public function edit($id)
    {

        $page = page::find($id);
        return view('BackEnd.page.edit', compact('page'));

    }
    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $page = page::find($request->id);
        $page->title = $request->title;
        $page->status = $request->status;
        if ($page->update()) {

            if (File::exists(public_path('storage/page/page-' . $request->id . '.txt'))) {
                File::delete('storage/page/page-' . $request->id . '.txt');
            }
            Storage::put('/public/page/page-' . $request->id . '.txt', $request->description);
            Session()->flash('success', 'Page Upadte successfully');

        } else {
            Session()->flash('erors', 'Fail To update New Page');
        }

        return redirect()->route('pages');

    }

    public function destroy($id)
    {

        $page = page::find($id);
        if (!is_null($page)) {
            
            if (File::exists(public_path('storage/page/page-' . $page->id . '.txt'))) {
                File::delete('storage/page/page-' . $page->id . '.txt');
            }
            $menulists = menu::where('page_id', $page->id)->get();
            foreach ($menulists as $menul) {

                if (!is_null($menul)) {
                    $menul->delete();
                }

            }
            $page->delete();

        }
    }
    public function GetList()
    {
        $page = page::all();
        return response()->json($page);

    }

}
