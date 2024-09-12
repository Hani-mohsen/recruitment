<?php

namespace App\Http\Controllers;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Interview;
use App\Models\InterviewReview;
use Illuminate\Http\Request;

class InterviewReviewController extends Controller
{   public function index()
    {
        if(request()->ajax()){
            $review = InterviewReview::all();
            // render Datatable ajax response
            $review = InterviewReview::query()->withCount(['interview','createdBy'])->get();
            // set column actions for datatable->editColumn('action', function ($user))
            $table = Datatables::of($review);
            $table->addColumn('action', function ($row) {
                $template = '
                    <a href="' . route('interviewreview.show', $row->id) . '" class="btn btn-outline-info btn-sm border-0 text-black"><i class="fa fa-eye fadeIn animated"></i></a>
                     <a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-outline-warning btn-sm border-0 text-black edit-interviewreview" data-bs-toggle="modal" data-bs-target="#updateModel"><i class="fa fa-edit fadeIn animated"></i></a>
                     <form action="' . route('interviewreview.destroy', $row->id) . '" method="POST" data-ajax-delete="true" style="display:inline;">
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
            $table->editColumn('interview.title', function ($row) {
                return $row->interview?$row->interview->title : $row->interview_id;
            });

           
            


            $table->rawColumns(['action']);

            return $table->make(true);
        

               }
               $users = User::all();
               $intervew=Interview::all();


        return view('interviewreview.index', compact('users','intervew'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'interview_id' => 'required',
            'created_by' => 'required',
            'interview_date' => 'required',
            'interview_time' => 'required',
            'interview_result' => 'required',


        // if created return success message

        ]);

        $data = $request->all();
        $data['created_by'] = 1;
        $data['updated_by'] = 1;
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $created = InterviewReview::create($data);
        if($created){
            return response()->json(['success' => 'Interview Review created successfully.']);
        }

        return response()->json(['error' => 'Interview Review not created. try again.']);

    }


    public function show($id)
    {
        $row = InterviewReview::with(['interview','createdBy'])->find($id);
        // if($jobcandidate){
        //     // dd($jobcandidate->jobApply->availableJob);
        // }
        // dd($jobcandidate);
        return view('interviewreview.show', compact('row'));
    }
    
    public function edit($id)
    {
        $row = InterviewReview::find($id);
        return response()->json($row);
    }  








    public function destroy($id)
    {
        $deleted = InterviewReview::find($id)->delete();
        if(request()->ajax()){
            return $deleted ? response()->json(['success' => 'interviewreview deleted successfully.']) : response()->json(['error' => 'interviewreview not deleted. try again.']);
        }

        return $deleted ? redirect()->route('interviewreview.index')->with('success', 'interviewreview deleted successfully.') : redirect()->route('interviewreview.index')->with('error', 'interviewreview not deleted. try again.');
    }
}
