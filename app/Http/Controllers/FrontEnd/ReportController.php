<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\AdPost;
use App\Models\AdpostReport;
use App\Models\reportOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create($id)
    {
        $adPost = AdPost::find($id);
        $reportOptions = reportOption::where('status', 1)->get();
        return view('FrontEnd.report.create', compact('reportOptions', 'adPost'));

    }
    public function store(Request $request)
    {

        $this->validate(
            $request,
            ['reportOption' => 'required'],
            ['reportOption.required' => 'Please Select an report Oprion']
        );

        $adpostReport = new AdpostReport();
        $adpostReport->user_id = Auth::id();
        $adpostReport->post_id = $request->post_id;
        $adpostReport->report_option_id = $request->reportOption;
        $adpostReport->description = $request->description;
        if ($adpostReport->save()) {
            Session()->flash('success', 'You have reported ad post');
            return redirect()->route('Report.show', $adpostReport->id);
        } else {
            Session()->flash('erors', 'Fail T reported ad post');
            return redirect()->back();
        }

    }

    public function show($id)
    {
        $AdpostReport = AdpostReport::find($id);
        return view('FrontEnd.report.show', compact('AdpostReport'));

    }
}
