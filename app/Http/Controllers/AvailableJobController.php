<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use App\Models\User;

use App\Models\AvailableJob;
use Illuminate\Http\Request;

class AvailableJobController extends Controller
{
    
    public function index()
    {
        if(request()->ajax()){
            $jobs = AvailableJob::query()->with(['createdBy']);
            // render Datatable ajax response
            $table = Datatables::of($jobs);
            $table->addColumn('action', function ($row) {
                $template = '
                    <a href="' . route('available.show', $row->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm border-0 text-black job-edit" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fa fa-edit fadeIn animated"></i></a>

                    <form action="' . route('available.destroy', $row->id) . '" method="POST" data-ajax-delete="true" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black job-delete data-id="'. $row->id .' "><i class="fa fa-trash-alt fadeIn animated"></i></button>

                    </form>
                ';
                return $template;
            });
            $table->editColumn('createdBy.name', function ($row) {
                return $row->createdBy->name ?? $row->created_by;
            });

            // set row id to tr data-priority
            $table->setRowAttr([
                'data-entry-id' => '{{$id}}',
            ]);

            $table->rawColumns(['action']);

            return $table->make(true);
        }
       
       
        $users = User::all();

        return view('availablejob.index', compact('users'));  
      }
      public function store(Request $request)
    {
        $request->validate([
            'jobTitle' => 'required|string',
            'jobDescription' => 'required|string',
            'salaryRange' => 'required|integer',
            'postingDate' => 'required|date',
            'closingDate' => 'required|date',

        ]);

        $created = AvailableJob::create(
            [
                'JobTitle' => $request->jobTitle,
                'JobDescription' => $request->jobDescription,
                'created_by' =>1 ,
                'SalaryRange' => $request->salaryRange,
                'PostingDate' => $request->postingDate,
                'ClosingDate' => $request->closingDate,
                
            ]
        );

        // if created return success message
        return $created ? response()->json(['success' => 'Job saved successfully.']) : response()->json(['error' => 'Job not saved. try again.']);
    }
      public function show($id)
      {
          $row = AvailableJob::with(['createdBy'])->find($id);
          return view('availablejob.show', compact('row'));
      }
      public function edit($id)
    {
        $row = AvailableJob::find($id);
        return response()->json($row);
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'jobTitle' => 'required|string',
            'jobDescription' => 'required|string',
            'salaryRange' => 'required|integer',
            'postingDate' => 'required|date',
            'closingDate' => 'required|date', 

        ]);
        $data = $request->only(['jobTitle', 'jobDescription', 'salaryRange', 'postingDate', 'closingDate']);
        $updated = AvailableJob::findOrFail($id)->update($data);
        return $updated ? response()->json(['success' => 'Job updated successfully.']) : response()->json(['error' => 'Job not updated. try again.']);
    }   





      public function destroy($id)
    {
        $deleted = AvailableJob::find($id)->delete();
        if(request()->ajax()){
            return $deleted ? response()->json(['success' => 'Job deleted successfully.']) : response()->json(['error' => 'job not deleted. try again.']);
        }

        return $deleted ? redirect()->route('Available.index')->with('success', 'Job deleted successfully.') : redirect()->route('Available.index')->with('error', 'Job not deleted. try again.');
    }
  
  }

