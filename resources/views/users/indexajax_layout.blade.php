@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For Users
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">Name</th>
                    <th data-priority="3">Email</th>
                
                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')

	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('users.ajax') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('users.ajax') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                    ]
				})
				.columns.adjust()
				.responsive.recalc();
		});
	</script>

@stop
