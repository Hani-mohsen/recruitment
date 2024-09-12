<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;

use App\Models\JobApply;
use Illuminate\Http\Request;
use PHPUnit\Util\PHP\Job;

class JobApplyController extends Controller
{
  
    public function index()
    {
        if(request()->ajax()){
            $jobapply = JobApply::query()->with(['Job','createdBy']);
              // set column actions for datatable->editColumn('action', function ($user))
              $table = Datatables::of($jobapply);
              $table->addColumn('action', function ($row) {
                  $template = '
                      <a href="' . route('jobapply.show', $row->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm border-0 text-black jobapply-edit" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fa fa-edit fadeIn animated"></i></a>
                       <form action="' . route('jobapply.destroy', $row->id) . '" method="POST" data-ajax-delete="true" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black ajax-delete data-id="'. $row->id .' "><i class="fa fa-trash-alt fadeIn animated"></i></button>

                    </form>
                  ';
                  return $template;
                  
              });
  
              $table->editColumn('createdBy.FirstName', function ($row) {
                  return $row->createdBy?$row->createdBy->FirstName . ' ' . $row->createdBy->LastName : $row->candidate_id; 
              });
  
              $table->editColumn('Job.JobTitle', function ($row) {
                  return $row->Job->JobTitle ?? $row->available_job_id;
              });
              
  
  
              $table->rawColumns(['action']);
  
              return $table->make(true);
          }
            // render Datatable ajax response
        

        return view('jobapply.index');
    }

    public function show($id)
    {
        $jobapply = JobApply::with(['Job','createdBy'])->find($id);
        // if($jobcandidate){
        //     // dd($jobcandidate->jobApply->availableJob);
        // }
        // dd($jobcandidate);
        return view('jobapply.show', compact('jobapply'));
    }
    public function edit($id)
    {
        $row = JobApply::find($id);
        return response()->json($row);
    }  
    public function update(Request $request, $id)
    {
        $request->validate([
            'candidate_id' => 'required',
            'available_job_id' => 'required',
         
       


        ]);
        $data = $request->only(['', '', '', '', '']);
        $updated = JobApply::findOrFail($id)->update($data);
        return $updated ? response()->json(['success' => 'JobApply updated successfully.']) : response()->json(['error' => 'JobApply not updated. try again.']);
    }   
    
public function destroy($id)
{
    $deleted = JobApply::find($id)->delete();
    if(request()->ajax()){
        return $deleted ? response()->json(['success' => 'jobapply deleted successfully.']) : response()->json(['error' => 'jobapply not deleted. try again.']);
    }

    return $deleted ? redirect()->route('jobapply.index')->with('success', 'jobapply deleted successfully.') : redirect()->route('jobapply.index')->with('error', 'jobapply not deleted. try again.');
}
    
}