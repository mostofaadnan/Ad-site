<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\post;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class postController extends Controller
{
    public function index()
    {

        return view('BackEnd.postfront.index');
    }

    public function LoadAll(Request $request)
    {
        $post = post::orderBy('id', 'desc')
            ->latest()
            ->get();
        return Datatables::of($post)
            ->addIndexColumn()

            ->addColumn('status', function (post $post) {
                return $post->status == 1 ? 'Publish' : 'Draft';
            })
            ->addColumn('post_type', function (post $post) {
                return $post->post_type == 1 ? 'Home Page' : 'Ad Category Page';
            })

            ->addColumn('action', function ($page) {
                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $page->id . '"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $page->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';
                return $button;
            })

            ->make(true);
    }
    public function create()
    {
        return view('BackEnd.postfront.create');

    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post = new post();
        $post->title = $request->title;
        $post->post_type = $request->post_type;
        $post->status = $request->status;
        if ($post->save()) {
            Storage::put('/public/post/post-' . $post->id . '.txt', $request->description);

            Session()->flash('success', 'New Post save successfully');

        } else {
            Session()->flash('erors', 'Fail To save New Post');
        }

        return redirect()->route('posts');

    }

    public function edit($id)
    {

        $post = post::find($id);
        return view('BackEnd.postfront.edit', compact('post'));

    }
    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $post = post::find($request->id);
        $post->title = $request->title;
        $post->post_type = $request->post_type;
        $post->status = $request->status;
        if ($post->update()) {
            if (File::exists(public_path('storage/post/post-' . $request->id . '.txt'))) {
                File::delete(public_path('storage/post/post-' . $request->id . '.txt'));
            }
            Storage::put('/public/post/post-' . $request->id . '.txt', $request->description);
            Session()->flash('success', 'Page Upadte successfully');

        } else {
            Session()->flash('erors', 'Fail To update New Page');
        }

        return redirect()->route('posts');

    }

    public function destroy($id)
    {

        $post = post::find($id);
        if (!is_null($post)) {
            if (File::exists(public_path('storage/post/post-' . $id . '.txt'))) {
                File::delete(public_path('storage/post/post-' . $id . '.txt'));
            }
            $post->delete();
        }
    }
}
