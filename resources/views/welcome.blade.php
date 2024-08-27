{{-- 
write bootstrap home template for application with topbar and footer, menue is:
-Home
-Users
-Candidates
-Jobs
-JobApply
-Interview
-InerviewReview
-Setting
-Logout
-Login

--}}
@extends('layouts.app')
@section('content')
    @if(Auth::check())
    <h1>Welcome back, {{ Auth::user()->name }}</h1>
    @else
    <h1>Welcome, please login</h1>
    @endif
@stop
