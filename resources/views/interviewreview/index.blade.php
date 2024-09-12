@extends('layouts.app')

@section('content')
  <div class="card">

    <div class="card-header">
            
        <div class="d-flex justify-content-between">
            <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
            Interviewrevew List</h1>
            <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#ajaxModel">New interview review</button>
        </div>

    </div>    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2"> Interview_Id</th>
                    <th data-priority="3">Created_By</th>
                    <th data-priority="4">Review</th>
                    <th data-priority="5">Rating</th>
                    <th data-priority="6">Action</th>

                </tr>
            </thead>
        </table>


    </div>


</div>
@stop
@section('scripts')
<div class="modal-container">
    <!-- Create Interviewreview Modal -->
    <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create Interviewreview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="interviewreviewForm" name="interviewreviewForm" class="form-horizontal" novalidate="">

                        <div class="form-group">
                            <label for="interviewer" class="col-sm-2 control-label">Interview_Id</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="interviewer" name="interviewer" multiple>
                                  @foreach ($intervew as $view)
                                      <option value="{{ $view->id }}">{{ $view->title }}</option>
                                  @endforeach
                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interviewer" class="col-sm-2 control-label">Created_By</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="interviewer" name="interviewer" multiple>
                                  @foreach ($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                                  @endforeach
                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review" class="col-sm-2 control-label">Review</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="review" name="review" placeholder="Enter review" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rating" class="col-sm-2 control-label">Rating</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="rating" name="rating" placeholder="Enter rating" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Edit Interviewreview Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Interviewreview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form id="updateForm" name="updateForm" class="form-horizontal" novalidate="">

                        <div class="form-group"><
                            <label for="interviewer" class="col-sm-2 control-label">Interview_Id</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="interviewer" name="interviewer" multiple>
                                  @foreach ($intervew as $view)
                                      <option value="{{ $view->id }}">{{ $view->title }}</option>
                                  @endforeach
                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="interviewer" class="col-sm-2 control-label">Created_By</label>
                            <div class="col-sm-12">
                                <select class="form-control select2" id="interviewer" name="interviewer" multiple>
                                  @foreach ($users as $user)
                                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                                  @endforeach
                                </select>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="review" class="col-sm-2 control-label">Review</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="review" name="review" placeholder="Enter review" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rating" class="col-sm-2 control-label">Rating</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="rating" name="rating" placeholder="Enter rating" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="update">
                                Update Interview
                            </button>
                        </form>
                        </div>
          
                </div>
            </div>
        </div>
   
        

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
                        {data: 'interview.title', name: 'interview.title', render: function(data, type, full, meta){
                            if("undefined" !== typeof full.interview_id)
                             return '<a href="{{route('interview.index')}}/'+full.interview_id+'" class="text-decoration-none interview" data-id="'+full.interview_id+'">'+data+'</a>';
                            
                        }},

                        {data: 'createdBy.name', name: 'createdBy.name', render: function(data, type, full, meta){
                            console.log(data, type, "full:",full, meta);
                            if("undefined" !== typeof full.created_by)
                             return '<a href="{{route('users.index')}}/'+full.created_by+'" class="text-decoration-none user" data-id="'+full.created_by+'">'+data+'</a>';
                        }},
                        {data: 'review', name: 'review'},
                        {data: 'rating', name: 'rating'},
                        {data: 'action', name: 'action', searchable: false, orderable: false},

                    ]
				})
				.columns.adjust().responsive.recalc();
                // Create New Interview Ajax

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#interviewreviewForm').serialize(),
                url: "{{ route('interviewreview.store') }}",
                
                type: "POST",
                dataType: 'json',
                success: function (data) { 

                    $('#interviewreviewForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    $('#saveBtn').html('Save New Interviewreview');
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
                    $('#interviewreviewForm .form-control').removeClass('is-invalid');
                    $('#interviewreviewForm .text-danger').html('');
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
 $('body').on('click', '.edit-interviewreview', function() {
            var id = $(this).data('id');
            $.get("{{ route('interviewreview.index') }}" +'/' + id +'/edit', function (data) {

                $('#updateModal').modal('show');
                $('#updateModalLabel').html("Edit Interviewreview");
                $('#updateForm').html(data);
                $('#interviewreview_id').val(data.id);
                $('#created_by').val(data.createdBy.name);
                $('#interview_id').val(data.interview.title);
                $('#review').val(data.review);
                $('#rating').val(data.rating);



            })

            });
                    //delete interview ajax
            $('body').on('click', '.delete-interviewreview', function() {

                var id = $(this).data("id");
                confirm("Are You sure want to delete !");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('interviewreview.store') }}"+'/'+id,
                    success: function (data) {
                        window.oTable.ajax.reload();
                        toastr.success(data.success);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        });
    });


	</script>


@stop
