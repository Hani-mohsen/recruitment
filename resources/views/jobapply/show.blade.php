@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            User Details
        </div>
        <div class="card-body p-0 m-0">
            <table id="userInfo" class="table table-bordered table-striped table-hover mb-0" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    @if($jobapply)
                    <tr>
                        <th data-priority="1">Id</th>
                        <td>{{ $jobapply->id }}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">created_at</th>
                        <td>{{ $jobapply->created_at->diffForHumans() }}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">Candidate</th>
                        <td>{{ ($jobapply->createdBy ? $jobapply->createdBy->FirstName.' '.$jobapply->createdBy->LastName : 'Not Found')}}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">available_job_id</th>
                        <td>{{ $jobapply->Job ? $jobapply->Job->JobTitle : 'Not Found'}}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">Created By</th>
                        <td>{{ ($jobapply->Job && $jobapply->Job->createdBy ? $jobapply->Job->createdBy->name : 'Not Found')}}</td>
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
            <a href="{{ route('jobapply.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
