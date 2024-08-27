<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use App\Models\Interview;
use Illuminate\Http\Request;

class InterviewController extends Controller
{  public function indexAjax()
    {
        if(request()->ajax()){
            $intervew = Interview::all();
            // render Datatable ajax response
            return Datatables::of($intervew)->make(true);
        }

        return view('interview.index');
    }
}
