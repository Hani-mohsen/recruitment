<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use App\Models\InterviewReview;
use Illuminate\Http\Request;

class InterviewReviewController extends Controller
{   public function indexAjax()
    {
        if(request()->ajax()){
            $review = InterviewReview::all();
            // render Datatable ajax response
            return Datatables::of($review)->make(true);
        }

        return view('interviewreview.index');
    }
}
