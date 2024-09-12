@extends('layouts.app')

@section('content')
    <!--Title-->
    <div class="card">
        <div class="card-header">
            
            <div class="d-flex justify-content-between">
                <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
                JobCandidate List</h1>
                <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#createModal">New JobCandidate</button>
            </div>

        </div>

    
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">created_by</th>
                    <th data-priority="3">candidate_id</th>
                    <th data-priority="4">job_applies</th>
                    <th data-priority="5">Action</th>


                
                </tr>
            </thead>
        </table>

    </div>
    </div>
@stop
@section('scripts')

    <!-- Create JobCandidate Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create JobCandidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                    <form action="{{ route('jobcandidate.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="job_id" class="col-sm-2 control-label">Job</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="job_id" name="job_id">

                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group"></div>
                            <label for="candidate_id" class="col-sm-2 control-label">Candidate</label>
                            <div class="col-sm-12"></div>
                                <select class="form-control" id="candidate_id" name="candidate_id">

                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Edit JobCandidate Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit JobCandidate</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>


                <div class="modal-footer">  
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>

            </div>
        </div>
    </div>

    



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

                        {data: 'createdBy.name', name: 'createdBy.name', render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.created_by)
                             return '<a href="{{route('users.index')}}/'+full.created_by+'" class="text-decoration-none user" data-id="'+full.created_by+'">'+data+'</a>';
                        }},
                        {data: 'candidate.FirstName', name: 'candidate.FirstName', render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.candidate_id)
                             return '<a href="{{route('candidates.index')}}/'+full.candidate_id+'" class="text-decoration-none user" data-id="'+full.candidate_id+'">'+data+'</a>';
                        }},
                        {data: 'jobApply.Job.JobTitle', name: 'jobApply.Job.JobTitle' , render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.job_apply_id)
                             return '<a href="{{route('jobapply.index')}}/'+full.job_apply_id+'" class="text-decoration-none user" data-id="'+full.job_apply_id+'">'+data+'</a>';
                        }},
                        {data: 'action', name: 'action', searchable: false, orderable: false},
                        


                      



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
