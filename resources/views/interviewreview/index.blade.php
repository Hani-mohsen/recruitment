@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For Interview 
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2"> Interview_Id</th>
                    <th data-priority="3">Created_By</th>
                    <th data-priority="4">Review</th>
                    <th data-priority="5">Rating</th>
                    

                
                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')

	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('interviewreview.index') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('interviewreview.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'interview_id', name: 'interview_id'},

                       {data: 'created_by', name: 'created_by'},
                        {data: 'review', name: 'review'},
                        {data: 'rating', name: 'rating'},


                      



                    ]
				})
				.columns.adjust()
				.responsive.recalc();
		});
	</script>

@stop
