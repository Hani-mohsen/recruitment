@extends('layouts.app')
@section('header')
<!-- load select2 latest css -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.3.0/select2-bootstrap-5-theme.min.css" />

@stop
@section('content')
    <!--Title-->
  

<div class="card">
    <div class="card-header">
            
        <div class="d-flex justify-content-between">
            <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
            Interview List</h1>
            <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#ajaxModel">New interview</button>
        </div>

    </div>
    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="1">Title</th>
                    <th data-priority="2">Job</th>
                    <th data-priority="3">Candidate_Id</th>
                    <th data-priority="4">Created_By</th>
                    <th data-priority="5">Interview_Date</th>
                    <th data-priority="6">Status</th>
                    <th data-priority="7">Interviewer</th>
                    <th data-priority="8">Action</th>
                
                </tr>
            </thead>
        </table>


    </div>
</div>
@stop
@section('scripts')
<div class="modal-container">
  <!-- Create Interview Modal -->
  <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="ajaxModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Add New Interview</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="interviewForm" name="interviewForm" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label for="title" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" maxlength="250" required>
                            <div class="text-danger"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job_apply_id" class="col-sm-2 control-label">Job</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="job_apply_id" name="job_apply_id">
                              @foreach ($jobApply as $apply)
                                @if($apply->Job)
                                <option value="{{ $apply->Job->id }}">{{ $apply->Job->JobTitle ?? '-' }}</option>  
                                @endif
                               @endforeach
                            </select>
                            <div class="text-danger"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="candidate_id" class="col-sm-2 control-label">Candidate_Id</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="candidate_id" name="candidate_id">
                              @foreach ($candidate as $can)
                              <option value="{{ $can->id }}">{{ $can->FirstName.' '.$can->LastName }}</option>
                          @endforeach
                            </select>
                            <div class="text-danger"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="interview_date" class="col-sm-2 control-label">Interview_Date</label>
                        <div class="col-sm-12">
                            <input type="datetime-local" class="form-control" id="interview_date" name="interview_date" placeholder="Enter interview_date" value="" maxlength="250" required>
                            <div class="text-danger"></div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <label for="interviewer" class="col-sm-2 control-label">Interviewer</label>
                        <div class="col-sm-12">
                            <select class="form-control select2" id="interviewer" name="interviewer[]" multiple>
                              @foreach ($users as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                            <div class="text-danger"></div>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                            Save New Interview
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Update User Modal -->
<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="updateModelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Update Interview</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" name="updateForm" class="form-horizontal">
                    <input type="hidden" name="interview_id" id="interview_id">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <div class="form-group">
                      <label for="interview_title" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-12">
                          <input type="text" class="form-control" id="interview_title" name="title" placeholder="Enter title" value="" maxlength="250" required>
                          <div class="text-danger"></div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="interview_job_apply_id" class="col-sm-2 control-label">Job</label>
                      <div class="col-sm-12">
                          <select class="form-control" id="interview_job_apply_id" name="job_apply_id">
                            @foreach ($jobApply as $apply)
                                @if($apply->Job)
                                <option value="{{ $apply->Job->id }}">{{ $apply->Job->JobTitle ?? '-' }}</option>  
                                @endif
                              @endforeach
                          </select>
                          <div class="text-danger"></div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="interview_candidate_id" class="col-sm-2 control-label">Candidate_Id</label>
                      <div class="col-sm-12">
                          <select class="form-control" id="interview_candidate_id" name="candidate_id">
                            @foreach ($candidate as $can)
                                <option value="{{ $can->id }}">{{ $can->FirstName.' '.$can->LastName }}</option>
                            @endforeach
                          </select>
                          <div class="text-danger"></div>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="interview_interview_date" class="col-sm-2 control-label">Interview_Date</label>
                      <div class="col-sm-12">
                          <input type="datetime-local" class="form-control" id="interview_interview_date" name="interview_date" placeholder="Enter interview_date" value="" maxlength="250" required>
                          <div class="text-danger"></div>
                      </div>
                  </div>  

                  <div class="form-group">
                      <label for="interview_interviewer" class="col-sm-2 control-label">Interviewer</label>
                      <div class="col-sm-12">
                          <select class="form-control select2" id="interview_interviewer" name="interviewer[]" multiple>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                          </select>
                          <div class="text-danger"></div>
                      </div>
                  </div>
                  <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary" id="updateBtn" value="update">
                          Update Interview
                      </button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
  <!-- load script select2 latest -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

	<script>
    // add csrf token to ajax request
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $(document).ready(function() {
      // select2 
      $(".select2").select2({
        placeholder: "Select a user",
        allowClear: true,
        width: '100%',
        theme: 'bootstrap-5',
        // set on top of modal
        dropdownParent: $('.modal-container')
      });
      
      console.log("This will get users by ajax request from route:","{{ route('interview.index') }}");
            
      window.oTable = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('interview.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},

                        {data: 'jobApply.Job.JobTitle', name: 'jobApply.Job.JobTitle'},
                        {data: 'candidate.FirstName', name: 'candidate.FirstName', render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.candidate_id)
                             return '<a href="{{route('candidates.index')}}/'+full.candidate_id+'" class="text-decoration-none user" data-id="'+full.candidate_id+'">'+data+'</a>';
                        }},
                        {data: 'createdBy.name', name: 'createdBy.name', render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.created_by)
                             return '<a href="{{route('users.index')}}/'+full.created_by+'" class="text-decoration-none user" data-id="'+full.created_by+'">'+data+'</a>';
                        }},                        {data: 'interview_date', name: 'interview_date'},
                        {data: 'status', name: 'status'},
                        {data: 'interviewer', name: 'interviewer'},
                        {data: 'action', name: 'action', searchable: false, orderable: false},

                      



                    ]
				})
				.columns.adjust().responsive.recalc();

                   // Create New Interview Ajax

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#interviewForm').serialize(),
                url: "{{ route('interview.store') }}",
                
                type: "POST",
                dataType: 'json',
                success: function (data) { 

                    $('#interviewForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('Save New Interview');
                    window.oTable.ajax.reload();
                    // Print success message
                    if(data.success){
                        toastr.success(data.success);
                    }else if(data.error){
                        toastr.error(data.error);
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#interviewForm .form-control').removeClass('is-invalid');
                    $('#interviewForm .text-danger').html('');
                    if(data.responseJSON.errors){
                        // for in errors
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#'+key).addClass('is-invalid');
                            $('#'+key).next('.text-danger').html(value);
                            toastr.error(value, 'Error in: '+key);
                        });
                    }
                    $('#saveBtn').html('Save Changes');
                },
                
            }); 

        });

        //edit interview ajax
        $('body').on('click', '.edit-interview', function() {
            var interview_id = $(this).data('id');
            $.get("{{ route('interview.index') }}" +'/' + interview_id +'/edit', function(data) {
              console.log("Data for id: ", interview_id, data);
                $('#modalHeading').html("Edit Interview");
                $('#saveBtn').val("edit-interview");
                $('#updateModel').modal('show');
                $('#interview_id').val(data.id);
                $('#interview_title').val(data.title);
                $('#interview_job_apply_id').val(data.job_apply_id);
                $('#interview_candidate_id').val(data.candidate_id);
                $('#interview_interview_date').val(data.interview_date);
                $('#interview_status').val(data.status);
                // split interviewer into array by comma and select all with select2 #interview_interviewer
                var interview_interviewer = data.interviewer.split(',');
                $('#interview_interviewer').val(interview_interviewer).trigger('change');
                
            })
        });
        // update interview ajax
        $('#updateBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
            const id = $('#interview_id').val();
            $.ajax({
                data: $('#updateForm').serialize(),
                url: "{{ route('interview.index') }}/" + id,
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#updateForm').trigger("reset");
                    $('#updateModel').modal('hide');
                    $('#updateBtn').html('Save Changes');
                    window.oTable.ajax.reload();

                    if(data.success){
                        toastr.success(data.success);
                    }else if(data.error){
                        toastr.error(data.error);
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#updateForm .form-control').removeClass('is-invalid');
                    $('#updateForm .text-danger').html('');
                    if(data.responseJSON.errors){
                        // for in errors
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#'+key).addClass('is-invalid');
                            $('#'+key).next('.text-danger').html(value);
                            toastr.error(value, 'Error in: '+key);
                        });
                    }
                    $('#updateBtn').html('Save Changes');
                },

            });
        });
        //delete interview ajax
        $('body').on('submit', '[data-ajax-delete="true"]', function(e) {
            e.preventDefault();
            var action = $(this).attr("action");
            var data = $(this).serialize();

            if(confirm("Are You sure want to delete !")){
                $.ajax({
                type: "DELETE", 
                data:"action",
                url: "{{ route('interview.index') }}"+'/'+interview_id,
                success: function (data) {
                    window.oTable.ajax.reload();
                    toastr.success(data.success);
                },
                error: function (data) {
                    console.log('Error:', data);
                    if(data.responseJSON.errors){
                        // for in errors
                        $.each(data.responseJSON.errors, function (key, value) {
                            $('#'+key).addClass('is-invalid');
                            $('#'+key).next('.text-danger').html(value);
                            toastr.error(value, 'Error in: '+key);
                        });
                    }
                }
            });
                
            }
            
        });

		});
	</script>

@stop