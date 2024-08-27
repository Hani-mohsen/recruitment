@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For Available Jobs
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">JobTitle</th>
                    <th data-priority="3">JobDescription</th>
                    <th data-priority="4">created_by</th>
                    <th data-priority="5">SalaryRange</th>
                    <th data-priority="6">PostingDate</th>
                    <th data-priority="7">ClosingDate</th>

                
                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')

	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('available.index') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('available.index') }}",
                    columns: [
                        {data: 'JobsID', name: 'JobsID'},
                        {data: 'JobTitle', name: 'JobTitle'},
                        {data: 'JobDescription', name: 'JobDescription'},
                        {data: 'created_by', name: 'created_by'},
                        {data: 'SalaryRange', name: 'SalaryRange'},
                        {data: 'PostingDate', name: 'PostingDate'},
                        {data: 'ClosingDate', name: 'ClosingDate'},



                    ]
				})
				.columns.adjust()
				.responsive.recalc();
		});
	</script>

@stop
