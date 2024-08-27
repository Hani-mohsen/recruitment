@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For candidates
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <button type="button" class="btn btn-primary" onclick="createNewItem()">
            <i class="fa fa-plus"></i> إنشاء
        </button>
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">First Name</th>
                    <th data-priority="3">Last Name</th>

                    <th data-priority="4">Email</th>
                    <th data-priority="5">Phone</th>
                    <th data-priority="6">City</th>

                    <th data-priority="7">Profile</th>
                    <th data-priority="8">Resume</th>
                
                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')

	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('candidates.ajax') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('candidates.ajax') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'FirstName', name: 'FirstName'},
                        {data: 'LastName', name: 'LastName'},
                        {data: 'Email', name: 'Email'},
                        {data: 'Phone', name: 'Phone'},
                        {data: 'city', name: 'city'},

                        {data: 'profile', name: 'profile'},
                        {data: 'Resume', name: 'Resume'},



                    ]
				})
				.columns.adjust()
				.responsive.recalc();
		});
        function createNewItem() {
            // منطق إنشاء عنصر جديد هنا
            alert('تم الضغط على زر الإنشاء!');
        }
	</script>

@stop
