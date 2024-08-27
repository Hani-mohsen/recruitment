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
    public function indexAjax()
    {
        if(request()->ajax()){
            $candidates = Candidate::all();
            // render Datatable ajax response
            return Datatables::of($candidates)->make(true);
        }

        return view('candidates.index');
    }
    public function index()
    {
        
        if(request()->ajax()){
            $candidates = Candidate::all();
            // render Datatable ajax response
            return Datatables::of($candidates)->make(true);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidate $candidate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
