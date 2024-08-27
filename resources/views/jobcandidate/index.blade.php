@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For JobCandidate
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
                    <th data-priority="2">created_by</th>
                    <th data-priority="3">candidate_id</th>
                    <th data-priority="4">job_applies</th>


                
                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')

	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('jobcandidate.index') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('jobcandidate.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},

                        {data: 'created_by', name: 'created_by'},
                        {data: 'candidate_id', name: 'candidate_id'},
                        {data: 'job_apply_id', name: 'job_apply_id'},

                      



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
