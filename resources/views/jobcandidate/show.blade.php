@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            jobcandidate Details
        </div>
        <div class="card-body p-0 m-0">
            <table id="jobcandidateInfo" class="table table-bordered table-striped table-hover mb-0" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    @if($jobcandidate)
                    <tr>
                        <th data-priority="1">Id</th>
                        <td>{{ $jobcandidate->id }}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">created_by</th>
                        <td>{{ $jobcandidate->createdBy->name }}</td>
                    </tr>
                    <tr>
                        <th data-priority="3">candidate</th>
                        <td>{{ ($jobcandidate->candidate ? $jobcandidate->candidate->FirstName . ' ' . $jobcandidate->candidate->LastName : 'Not Found') }}</td>
                    </tr>
                    <tr>
                        <th data-priority="4">job_applies</th>
                        <td>{{ ($jobcandidate->jobApply && $jobcandidate->jobApply->Job ? $jobcandidate->jobApply->Job->JobTitle : 'Not Found') }}</td>
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
            <a href="{{ route('jobcandidate.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
