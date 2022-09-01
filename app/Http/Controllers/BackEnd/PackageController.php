<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Models\package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
       $packages=package::all();
        return view('BackEnd.package.index',compact('packages'));
    }
    public function create()
    {
        return view('BackEnd.package.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'package_name' => 'required',
            'price' => 'required',
        ]);
        $package = new package();
        $package->package_name = $request->package_name;
        $package->post_number = $request->post_number;
        $package->image_number = $request->image_number;
        $package->publish_day = $request->publish_day;
        $package->image_unlimited = $request->image_unlimited;
        $package->post_unlimited = $request->post_unlimited;
        $package->publish_unlimited = $request->publish_unlimited;
        $package->price = $request->price;
        $package->description = $request->description;
        $package->status = $request->status;
        $package->background_color=$request->background_color;
        if ($package->save()) {
            Session()->flash('success', 'New Package save successfully');
        } else {
            Session()->flash('erors', 'Fail To save New Post');
        }
        return redirect()->route('packages');

    }
    public function edit($id){
        $package=package::find($id);
        return view('BackEnd.package.edit',compact('package'));
    }
    public function update(Request $request)
    {
        $id=$request->id;
        $request->validate([
            'package_name' => 'required',
            'price' => 'required',
        ]);
        $package = package::find($id);
        $package->package_name = $request->package_name;
        $package->post_number = $request->post_number;
        $package->image_number = $request->image_number;
        $package->publish_day = $request->publish_day;
        $package->image_unlimited = $request->image_unlimited;
        $package->post_unlimited = $request->post_unlimited;
        $package->publish_unlimited = $request->publish_unlimited;
        $package->price = $request->price;
        $package->description = $request->description;
        $package->status = $request->status;
        $package->background_color=$request->background_color;
        if ($package->update()) {
            Session()->flash('success', 'Package Has Update successfully');
        } else {
            Session()->flash('erors', 'Fail To Update Package');
        }
        return redirect()->route('packages');
    }

    public function Inactive($id){
        $package = package::find($id);
        $package->status=0;
        if ($package->update()) {
            Session()->flash('success', 'Package Has Inactivate successfully');
        } else {
            Session()->flash('erors', 'Fail To Inactivate Package');
        }
        return redirect()->route('packages');
    }

    public function Active($id){
        $package = package::find($id);
        $package->status=1;
        if ($package->update()) {
            Session()->flash('success', 'Package Has Activate successfully');
        } else {
            Session()->flash('erors', 'Fail To Activate Package');
        }
        return redirect()->route('packages');
    }

    public function Destroy($id){
        $package = package::find($id);
        if(!is_null($package)){
            $package->delete();
        }
    }

}