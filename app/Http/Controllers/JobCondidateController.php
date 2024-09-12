<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Yajra\Datatables\Datatables;

use App\Models\JobCondidate;
use Illuminate\Http\Request;

class JobCondidateController extends Controller

{
 
    public function index()
    {
        if(request()->ajax()){
            $jobcandidate = JobCandidate::query()->with(['createdBy', 'jobApply', 'candidate']);
            $table = Datatables::of($jobcandidate);
            $table->addColumn('action', function ($row) {
                $template = '
                    <a href="' . route('jobcandidate.show', $row->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                    <a href="' . route('jobcandidate.edit', $row->id) . '" class="btn btn-outline-warning btn-sm border-0 text-black"><i class="fa fa-edit fadeIn animated"></i></a>
                    <form action="' . route('jobcandidate.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black"><i class="fa fa-trash-alt fadeIn animated"></i></button>
                    </form>
                                      

                ';
                return $template;
            })->editColumn('createdBy.name', function ($row) {
                return $row->createdBy->name ?? $row->created_by;
            })->editColumn('candidate.FirstName', function ($row) {
                return $row->candidate ? $row->candidate->FirstName . ' ' . $row->candidate->LastName : $row->candidate_id;
            })->editColumn('jobApply.Job.JobTitle', function ($row) {
                return $row->jobApply && $row->jobApply->Job ? $row->jobApply->Job->JobTitle : $row->job_apply_id;
            });


            $table->rawColumns(['action']);

            return $table->make(true);
        }

            // render Datatable ajax response
        

        return view('jobcandidate.index');
    }
        // Fetch a single jobcandidate by ID

    public function show($id)
    {
        $jobcandidate = JobCandidate::with(['createdBy', 'jobApply', 'candidate'])->find($id);
        // if($jobcandidate){
        //     // dd($jobcandidate->jobApply->availableJob);
        // }
        // dd($jobcandidate);
        return view('jobcandidate.show', compact('jobcandidate'));
    }

}
