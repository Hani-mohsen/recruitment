@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            Interview Details
        </div>
        <div class="card-body p-0 m-0">
            <table id="userInfo" class="table table-bordered table-striped table-hover mb-0" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    @if($row)
                    <tr>
                        <th data-priority="1">Id</th>
                        <td>{{ $row->id }}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">Job</th>
                        <td>{{ $row->jobApply && $row->jobApply->Job ? $row->jobApply->Job->JobTitle : 'Not Found' }}</td>

                    </tr>
                    <tr>
                        <th data-priority="3">CandidateName</th>
                        <td>{{ $row->candidate ? $row->candidate->FirstName : $row->candidate_id}}</td>

                    </tr>
                    <tr>
                        <th data-priority="4">Created_By</th>
                        <td>{{ $row->createdBy ? $row->createdBy->name : $row->created_by}}</td>
                    </tr> 
                    <tr>
                        <th data-priority="5">interview_date</th>
                        <td>{{ $row->interview_date }}</td>
                    </tr>
                    <tr>
                        <th data-priority="6">status</th>
                        <td>{{ $row->status }}</td>
                    </tr>
                    <tr>
                        <th data-priority="7">intervwer</th>
                        <td>{{ $row->interviewer }}</td>
                    </tr>
                  
                
                    @else
                    <tr>
                        <td>User Found</td>
                    </tr>
                    @endif
    
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('interview.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
