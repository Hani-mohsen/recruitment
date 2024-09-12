@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            Availble Job Details
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
                        <th data-priority="2">JobTitle</th>
                        <td>{{ $row->JobTitle }}</td>
                    </tr>
                    <tr>
                        <th data-priority="3">JobDescription</th>
                        <td>{{ $row->JobDescription }}</td>
                    </tr>
                    <tr>
                        <th data-priority="4">created_by</th>
                        <td>{{ $row->createdBy->name ?? $row->created_by }}</td>
                    </tr>
                    <tr>
                        <th data-priority="5">SalaryRange</th>
                        <td>{{ $row->SalaryRange }}</td>
                    </tr>
                    <tr>
                        <th data-priority="6">PostingDate</th>
                        <td>{{ $row->PostingDate }}</td>
                    </tr>
                    <tr>
                        <th data-priority="7">ClosingDate</th>
                        <td>{{ $row->ClosingDate }}</td>
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
            <a href="{{ route('available.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
