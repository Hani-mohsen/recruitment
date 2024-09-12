@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            Candidate Details
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
                        <th data-priority="2">FirstName</th>
                        <td>{{ $row->FirstName }}</td>
                    </tr>
                    <tr>
                        <th data-priority="3">LastName</th>
                        <td>{{ $row->LastName }}</td>
                    </tr>
                    <tr>
                        <th data-priority="4">Email</th>
                        <td>{{ $row->Email }}</td>
                    </tr>
                    <tr>
                        <th data-priority="5">Phone</th>
                        <td>{{ $row->Phone }}</td>
                    </tr>
                    <tr>
                        <th data-priority="6">city</th>
                        <td>{{ $row->city }}</td>
                    </tr>
                    <tr>
                        <th data-priority="7">profile</th>
                        <td>{{ $row->profile }}</td>
                    </tr>
                    <tr>
                        <th data-priority="8">Resume</th>
                        <td>{{ $row->Resume }}</td>
                    </tr>
                    <tr>
                        <th data-priority="9">jobApplies</th>
                        <td>{{ $row->jobApplies ? $row->jobApplies->count() : 0 }}</td>
                    </tr>
                    <tr>
                        <th data-priority="10">jobCandidates</th>
                        <td>{{ $row->jobCandidates ? $row->jobCandidates->count() : 0 }}</td>
                    </tr>
                    <tr>
                        <th data-priority="11">interviews</th>
                        <td>{{ $row->interviews ? $row->interviews->count() : 0 }}</td>
                    </tr>
                    <tr></tr>
                        <th data-priority="12">interview reviews</th>
                        <td>
                            @php
                             $interviewReviews = 0;
                             foreach ($row->interviews->all() as $key => $interviews) {
                                 if($interviews->interviewReviews){
                                     dd($interviews->interviewReviews);
                                    $interviewReviews += count($interviews->interviewReviews);
                                }
                             }
                            @endphp
                            {{ $interviewReviews }}</td>
                    @else
                    <tr>
                        <td>User Found</td>
                    </tr>
                    @endif
    
                </thead>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('candidates.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
