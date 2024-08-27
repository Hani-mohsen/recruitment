<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use App\Models\AvailableJob;
use Illuminate\Http\Request;

class AvailableJobController extends Controller
{
    public function indexAjax()
    {
        if(request()->ajax()){
            $jobs = AvailableJob::all();
            // render Datatable ajax response
            return Datatables::of($jobs)->make(true);
        }

        return view('availablejob.index');
    }
    public function index()
    {
        return view ('job.index');
    }}
