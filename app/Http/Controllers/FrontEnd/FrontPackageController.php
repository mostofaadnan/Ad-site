<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\package;
class FrontPackageController extends Controller
{
    public function index(){
        
        $packages=package::orderBy('id','DESC')->get();
        return view('FrontEnd.package.index',compact('packages'));
    }
}