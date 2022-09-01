<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\post;
use Illuminate\Http\Request;
use App\Models\state;
class HomeController extends Controller
{
    public function index(){


      
        $usallists=state::where('country_id',231)
        ->where('status',1)
        ->get();
        
        $canadalists=state::where('country_id',38)
        ->where('status',1)
        ->get();

        $australialists=state::where('country_id',13)
        ->where('country_id',230)
        ->where('status',1)
        ->get();
        
        $posts=post::where('post_type',1)
        ->where('status',1)
        ->orderBy('id','DESC')
        ->get();
        return view('FrontEnd.Home.index', compact('usallists','canadalists','australialists','posts'));
    }
}