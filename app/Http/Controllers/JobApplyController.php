<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use App\Models\JobApply;
use Illuminate\Http\Request;

class JobApplyController extends Controller
{
  
         public function indexAjax()
        {
            if(request()->ajax()){
                $jobapply = JobApply::all();
                // render Datatable ajax response
                return Datatables::of($jobapply)->make(true);
            }
    
            return view('jobapply.index');
        }
        
    }
        // Just show the form and let the user do their thing.
