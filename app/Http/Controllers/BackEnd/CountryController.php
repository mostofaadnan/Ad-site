<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\city;
use App\Models\Country;
use App\Models\state;
use DataTables;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class CountryController extends Controller
{
    public function index()
    {
        // $cate = Category::orderBy("id", "asc")->paginate(1);
        return view('BackEnd.setup.country');
    }
    public function LoadAll()
    {
        $Country = Country::orderBy('name', 'asc')
            ->latest()
            ->get();
        return Datatables::of($Country)
            ->addIndexColumn()

            ->addColumn('status', function (Country $Country) {
                return $Country->status == 1 ? 'Active' : 'Inactive';
            })

            ->addColumn('action', function ($Country) {

                $button = ' <div class="btn-group">';
                $button .= '<button  class="btn btn-sm btn-info" id="datashow" data-id="' . $Country->id . '" data-bs-toggle="modal" data-bs-target="#countrymodal"><i class="bx bxs-edit"></i></button>';
                $button .= '<button  class="btn btn-sm btn-danger" id="deletedata" data-id="' . $Country->id . '"><i class="bx bxs-trash"></i></button>';
                $button .= '</div>';

                return $button;
            })
            ->make(true);
    }

    public function store(Request $request)
    {
        $Country = new Country();
        $Country->sortname = $request->shortname;
        $Country->name = $request->name;
        $Country->status = $request->status;
        $Country->save();
        return response()->json($Country);
    }

    public function show(Request $request)
    {
        $id = $request->dataid;
        $Country = Country::find($id);
        return response()->json($Country);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $Country = Country::find($id);
        $Country->sortname = $request->shortname;
        $Country->name = $request->name;
        $Country->status = $request->status;
        $Country->update();
        return response()->json($Country);
    }

    public function destroy($id)
    {

        $Country = Country::find($id);
        if (!is_null($Country)) {
            $adpostcountry = AdPost::where('country_id', $id)->get();
            if ($adpostcountry->count() > 0) {
                $Country->status = 0;
                $Country->update();
            } else {
                $states = state::where('country_id', $id)->get();
                foreach ($states as $state) {
                    $adpost = AdPost::where('state_id', $state->id)->get();
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
                $Country->delete();
                return response($Country);
               
            }

        }
    }


}