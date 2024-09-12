@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            Interviewreview Details
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
                        <th data-priority="2">Created_By</th>
                        <td>{{ $row->createdBy ? $row->createdBy->name : $row->created_by}}</td>
                    </tr> 
                    <tr>
                        <th data-priority="3">interview_id</th>
                        <td>{{ $row->interview ? $row->interview->title : 'Not Found' }}</td>
                    </tr>
                    <tr>
                        <th data-priority="4">review</th>
                        <td>{{ $row->review }}</td>
                    </tr>
                    <tr>
                        <th data-priority="5">rating</th>
                        <td>{{ $row->rating }}</td>
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
            <a href="{{ route('interviewreview.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
