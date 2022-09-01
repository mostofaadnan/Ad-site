<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\addBaner;
use File;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Storage;
use Yajra\DataTables\Facades\DataTables;

class addBannerController extends Controller
{
    public function index()
    {
        return view('BackEnd.banner.index');
    }
    public function LoadAll(Request $request)
    {
        $addBaner = addBaner::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($addBaner)
            ->addIndexColumn()

            ->addColumn('status', function (addBaner $addBaner) {
                return $addBaner->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('type', function (addBaner $addBaner) {
                return $addBaner->type == 1 ? 'Adsense' : 'Custom';
            })

            ->addColumn('action', function ($addBaner) {
                $button = ' <div class="btn-group">';
                $button .= '<a href="' . route('adbanners.edit', $addBaner->id) . '" class="btn btn-sm btn-info"><i class="bx bxs-edit"></i></a>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $addBaner->id . '"><i class="bx bxs-trash"></i></button>';
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

        $addBaner = new addBaner();
        $addBaner->type = $request->type;
        $addBaner->status = $request->status;
        $addBaner->add_title = $request->add_title;
        $addBaner->link = $request->link;

        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $Path = public_path('/image/banner/');
            $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $Img = Image::make($file->getRealPath());
            $Img->save($Path . '/' . $img, 50);
            $addBaner->image = $img;
        }
        if ($addBaner->save()) {
            if ($request->type == 1) {
                Storage::put('/public/banner/source/src-' . $addBaner->id . '.txt', $request->source);
            }

            Session()->flash('success', 'Ad Banner save successfully');
        } else {
            Session()->flash('erors', 'Fail To save New Ad Banner');
        }
        return redirect()->route('adbanners');

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
        $addBanner = addBaner::find($id);
        return view('BackEnd.banner.edit', compact('addBanner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $addBanner = addBaner::find($id);
        return view('BackEnd.banner.edit', compact('addBanner'));
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
        $addBaner = addBaner::find($id);
        $addBaner->type = $request->type;
        $addBaner->status = $request->status;
        $addBaner->add_title = $request->add_title;
        $addBaner->link = $request->link;
        if ($request->type == 1) {
            if (File::exists(public_path('storage/banner/source/src-' . $id . '.txt'))) {
                File::delete(public_path('storage/banner/source/src-' . $id . '.txt'));
            }
            Storage::put('/public/banner/source/src-' . $addBaner->id . '.txt', $request->source);
        }

        if ($request->hasfile('images')) {

            if (File::exists(public_path('/image/banner/' . $addBaner->image))) {
                File::delete(public_path('/image/banner/' . $addBaner->image));
            }
            $file = $request->file('images');
            $Path = public_path('/image/banner/');
            $img = time() . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            $Img = Image::make($file->getRealPath());
            $Img->save($Path . '/' . $img, 50);
            $addBaner->image = $img;
        }
        if ($addBaner->update()) {

            Session()->flash('success', 'Ad Banner Update successfully');

        } else {
            Session()->flash('erors', 'Fail To Update New Ad Banner');
        }
        return redirect()->route('adbanners');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $addBaner = addBaner::find($id);
        if (!is_null($addBaner)) {
            if (File::exists(public_path('/image/banner/' . $addBaner->image))) {
                File::delete(public_path('/image/banner/' . $addBaner->image));
            }
            if (File::exists(public_path('storage/banner/source/src-' . $id . '.txt'))) {
                File::delete(public_path('storage/banner/source/src-' . $id . '.txt'));
            }
            $addBaner->delete();
        }
        return response()->json($addBaner);

    }

}
