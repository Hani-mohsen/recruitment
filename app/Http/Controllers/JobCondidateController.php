<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Yajra\Datatables\Datatables;

use App\Models\JobCondidate;
use Illuminate\Http\Request;

class JobCondidateController extends Controller

{
 
    public function indexAjax()
    {
        if(request()->ajax()){
            $jobcandidate = JobCandidate::all();
            // render Datatable ajax response
            return Datatables::of($jobcandidate)->make(true);
        }

        return view('jobcandidate.index');
    }
}
