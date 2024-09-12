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
                    @if($user)
                    <tr>
                        <th data-priority="1">Id</th>
                        <td>{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <th data-priority="2">Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th data-priority="3">Email</th>
                        <td>{{ $user->email }}</td>
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
            <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
        </div>
    </div>

@stop
