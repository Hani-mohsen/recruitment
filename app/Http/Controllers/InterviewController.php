<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Candidate;
use App\Models\JobApply;

use App\Models\Interview;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Auth;

class InterviewController extends Controller

{  public function index()
    {
        if(request()->ajax()){
           // $intervew = Interview::all();
            // render Datatable ajax response
            $intervew = Interview::query()->withCount(['jobApply','candidate','createdBy'])->get();
            // set column actions for datatable->editColumn('action', function ($user))
            $table = Datatables::of($intervew);
            $table->addColumn('action', function ($row) {
                $template = '
                    <a href="' . route('interview.show', $row->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                     <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm border-0 text-black edit-interview" data-bs-toggle="modal" data-bs-target="#updateModel"><i class="fa fa-edit fadeIn animated"></i></a>

                    <form action="' . route('interview.destroy', $row->id) . '" method="POST" data-id="'. $row->id .'" data-ajax-delete="true" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black delete-interview" data-id="'. $row->id .'"><i class="fa fa-trash-alt fadeIn animated"></i></button>

                    </form>
                ';
                return $template;
                
            });

            $table->editColumn('createdBy.name', function ($row) {
                return $row->createdBy->name ?? $row->created_by;
            });

            $table->editColumn('candidate.FirstName', function ($row) {
                return $row->candidate?$row->candidate->FirstName . ' ' . $row->candidate->LastName : $row->candidate_id; 
            });

            $table->editColumn('jobApply.Job.JobTitle', function ($row) {
                return $row->jobApply->Job->JobTitle ?? $row->job_apply_id;
            });
            


            $table->rawColumns(['action']);

            return $table->make(true);
        

        }

        $users = User::all();
        $jobApply = JobApply::with('Job')->get();
        $candidate = Candidate::all();
        //dd($jobApply);
        return view('interview.index', compact('users','jobApply','candidate'));
    }
    public function show($id)
    {
        $row = Interview::with(['jobApply','candidate','createdBy'])->find($id);
        // if($jobcandidate){
        //     // dd($jobcandidate->jobApply->availableJob);
        // }
        // dd($jobcandidate);
        return view('interview.show', compact('row'));
    }
    //add function store
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'nullable|string|max:255',
            'candidate_id' => 'required|exists:candidates,id',
            'job_apply_id' => 'required|exists:job_applies,id',
            'interview_date' => 'required|date',
            'interviewer' => 'nullable|array',
        ]);
        $data = $request->all();
        // implode interviewers if array
        $data['interviewer'] = implode(',', $data['interviewer']);
        $data['created_by'] = 1;
        $data['status'] = "New";

        $created = Interview::create(
            $data
        );

        // if created return success message
        return $created ? response()->json(['success' => 'interview saved successfully.']) : response()->json(['error' => 'interview not saved. try again.']);
    }
    public function edit($id)
    {
        $user = Interview::find($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'interview_id' => 'required|exists:interviews,id',
            'title'=>'nullable|string|max:255',
            'candidate_id' => 'required|exists:candidates,id',
            'job_apply_id' => 'required|exists:job_applies,id',
            'interview_date' => 'required|date',
            'interviewer' => 'nullable|array',
        ]);
        $row = Interview::find($id);
        $data = $request->only(['title', 'candidate_id', 'job_apply_id', 'interview_date', 'interviewer']);
        // implode interviewers if array
        $data['interviewer'] = implode(',', $data['interviewer']);
        // $data['updated_by'] = 1;
        $updated = $row->update($data);
        return $updated ? response()->json(['success' => 'Interview updated successfully.']) : response()->json(['error' => 'Interview not updated. try again.']);
    }   

    //public function destroy($id)

public function destroy($id)
    {
        $deleted = Interview::find($id)->delete();
        if(request()->ajax()){
            return $deleted ? response()->json(['success' => 'interview deleted successfully.']) : response()->json(['error' => 'interview not deleted. try again.']);
        }

        return $deleted ? redirect()->route('interview.index')->with('success', 'interview deleted successfully.') : redirect()->route('interview.index')->with('error', 'interview not deleted. try again.');
    }
}
