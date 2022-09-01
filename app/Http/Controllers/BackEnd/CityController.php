<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\city;
use App\Models\Country;
use DataTables;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {

        $Countrys = Country::orderBy('name', 'asc')->where('status', 1)->get();
        return view('BackEnd.setup.city', compact('Countrys'));
    }
    public function LoadAll()
    {
        $city = city::orderBy('name', 'asc')
            ->latest()
            ->get();
        return Datatables::of($city)
            ->addIndexColumn()
        ->addColumn('state', function (city $city) {
      
        return $city->StateName->name;
        
        })
        ->addColumn('country', function (city $city) {
       
        return $city->StateName->CountryName->name;
        

        }) 
            ->addColumn('action', function ($city) {

                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $city->id . '" data-bs-toggle="modal" data-bs-target="#citymodal"><i class="bx bxs-edit"></i></button>';
              
                if ($city->status == 1) {
                    $button .= '<button  class="btn btn-sm btn-success" id="inactive" data-id="' . $city->id . '">Active</button>';
                } else {
                    $button .= '<button  class="btn btn-sm btn-warning" id="active" data-id="' . $city->id . '">Inactive</button>';
                }
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $city->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';

                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $city = new city();
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->save();
        return response()->json($city);
    }

    public function show(Request $request)
    {
        $id = $request->dataid;
        $city = city::with('StateName', 'StateName.CountryName')->find($id);
        return response()->json($city);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $city = city::find($id);
        $city->name = $request->name;
        $city->state_id = $request->state_id;
        $city->update();
        return response()->json($city);
    }

    public function destroy($id)
    {
        $city = city::find($id);
        if (!is_null($city)) {
            $adpostcity = AdPost::where('city_id', $city->id)->get();
            if ($adpostcity->count() > 0) {
                $city->status = 0;
                $city->update();
            } else {
                $city->delete();
            }
            $city->delete();
        }
    }
    public function getCityList(Request $request)
    {
        $cities = city::orderBy('name', 'asc')
            ->where("state_id", $request->state_id)
            ->pluck("name", "id");
        return response()->json($cities);
    }

    public function inActive($id)
    {
        $state = city::find($id);
        $state->status = 0;
        $state->update();
    }
    public function Active($id)
    {
        $state = city::find($id);
        $state->status = 1;
        $state->update();
    }

}
