<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\city;
use App\Models\Country;
use App\Models\state;
use DataTables;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $Countrys = Country::orderBy('name', 'asc')->where('status', 1)->get();
        return view('BackEnd.setup.state', compact('Countrys'));
    }
    public function LoadAll()
    {
        $state = state::orderBy('name', 'asc')
            ->latest()
            ->get();
        return Datatables::of($state)
            ->addIndexColumn()
            ->addColumn('country', function (state $state) {
                return $state->CountryName->name;
            })
            ->addColumn('action', function ($state) {

                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $state->id . '" data-bs-toggle="modal" data-bs-target="#statemodal"><i class="bx bxs-edit"></i></button>';
                if ($state->status == 1) {
                    $button .= '<button  class="btn btn-sm btn-success" id="inactive" data-id="' . $state->id . '">Active</button>';
                } else {
                    $button .= '<button  class="btn btn-sm btn-warning" id="active" data-id="' . $state->id . '">Inactive</button>';
                }
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $state->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';

                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $state = new state();
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->save();
        return response()->json($state);
    }

    public function show(Request $request)
    {
        $id = $request->dataid;
        $state = state::find($id);
        return response()->json($state);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $state = state::find($id);
        $state->name = $request->name;
        $state->country_id = $request->country_id;
        $state->update();
        return response()->json($state);
    }

    public function destroy($id)
    {

        $state = state::find($id);
        if (!is_null($state)) {
            $adpost = AdPost::where('state_id', $id)->get();
            if ($adpost->count() > 0) {
                $state->status = 0;
                $state->update();
            } else {
                $citys = city::where('state_id', $state->id);
                if (!is_null($citys)) {
                    foreach ($citys as $city) {
                        $adpostcity = AdPost::where('city_id', $city->id)->get();
                        if ($adpostcity->count() > 0) {
                            $city->status = 0;
                            $city->update();
                        } else {
                            $city->delete();
                        }
                    }
                }
                $state->delete();
            }
        }
    }
    public function getStateList(Request $request)
    {
        $states = state::orderBy('name', 'asc')
            ->where("country_id", $request->country_id)
            ->pluck("name", "id");
        return response()->json($states);
    }

    public function inActive($id)
    {
        $state = state::find($id);
        $state->status = 0;
        $state->update();
    }
    public function Active($id)
    {
        $state = state::find($id);
        $state->status = 1;
        $state->update();
    }
}
