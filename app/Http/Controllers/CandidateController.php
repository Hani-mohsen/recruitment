<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        
        if(request()->ajax()){
            // $candidates = Candidate::all();
            // get all candidates with count JobApplies, and JobCandidates
            $candidates = Candidate::withCount(['jobApplies', 'jobCandidates', 'interviews', ])->get();
            $table = Datatables::of($candidates);
            $table->addColumn('action', function ($row) {
                $template = '
                    <a href="' . route('candidates.show', $row->id) . '"class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm border-0 text-black candidate-edit" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa fa-edit fadeIn animated"></i></a>
                   <form action="' . route('candidates.destroy', $row->id) . '" method="POST" data-ajax-delete="true" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-outline-danger btn-sm border-0 text-black Candidate-delete data-id="'. $row->id .' "><i class="fa fa-trash-alt fadeIn animated"></i></button>

                    </form>
                ';
                return $template;
            });
          // set row id to tr data-priority
        $table->setRowAttr([
           'data-entry-id' => '{{$id}}',
             ]);

            $table->rawColumns(['action']);

            return $table->make(true);
         
        }

        return view('candidates.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        // $row= Candidate::find($candidate->id);
        // get candidate by id with relations
        $row = Candidate::with(['jobApplies', 'jobCandidates', 'interviews',])->find($candidate->id);
        return view('candidates.show', compact('row'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Candidate::find($id);
        return response()->json($row);
    }  

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'FirstName' => 'required',
            'LastName' => 'required',
            'Email' => 'required',
            'Phone' => 'required',
            'City' => 'required',
            'Resume' => 'required',
            'profile' => 'required',
         
       


        ]);
        $data = $request->only(['', '', '', '', '']);
        $updated = Candidate::findOrFail($id)->update($data);
        return $updated ? response()->json(['success' => 'Candidate updated successfully.']) : response()->json(['error' => 'Candidate not updated. try again.']);
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deleted = Candidate::find($id)->delete();
        if(request()->ajax()){
            return $deleted ? response()->json(['success' => 'candidate deleted successfully.']) : response()->json(['error' => 'candidate not deleted. try again.']);
        }

        return $deleted ? redirect()->route('candidates.index')->with('success', '   candidate deleted successfully.') : redirect()->route('candidates.index')->with('error', 'candidate not deleted. try again.');
    }
}
