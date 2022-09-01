<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\page;
use Illuminate\Http\Request;

class FrontPageController extends Controller
{
    public function page($id){
        $page=page::find($id);
        return view('FrontEnd.page.page',compact('page'));
    }
}