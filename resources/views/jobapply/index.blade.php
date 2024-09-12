@extends('layouts.app')

@section('content')
   <div class="card">
    <div class="card-header">
       <div class="d-flex justify-content-between">
                <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
                Jobapply List</h1>
            </div>
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">createdBy</th>
                    <th data-priority="2">Available_Job_Id</th>
                    <th data-priority="4">Action</th>
                
                </tr>
            </thead>
        </table>


    </div>
   </div>
@stop
@section('scripts')


    <!-- Update Jobapply Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Jobapply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="updateForm" name="updateForm" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group"></div>
                            <label for="createdBy" class="col-sm-2 control-label">createdBy</label>
                            <div class="col-sm-12"></div>
                                <input type="text" class="form-control" id="createdBy.FirstName" name="createdBy.FirstName" placeholder="Enter createdBy">
                            </div>
                            <div class="form-group">
                                <label for="Available_Job_Id" class="col-sm-2 control-label">JobJobTitle
                                    <input type="text" class="form-control" id="Job.JobTitle" name="Job.JobTitle" placeholder="Enter Available_Job_Id">
                                </div>

                    </form>

                </div>  

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="update">Save changes</button>
                </div>

            </div>
        </div>
    



	<script>
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('jobapply.index') }}");
            
			var table = $('#example').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('jobapply.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'createdBy.FirstName', name: 'createdBy.FirstName'},
                        {data: 'Job.JobTitle', name: 'Job.JobTitle'},
                        {data: 'action', name: 'action', searchable: false, orderable: false},
                    ]
				})
				.columns.adjust().responsive.recalc();
   // Edit candidate Ajax
   $('body').on('click', '.jobapply-edit', function() {
                var rowid = $(this).attr('data-id'), parentTr = $("[data-entry-id='"+rowid+"']");
                console.log('rowid:', rowid, 'parentTr:', parentTr);
                // read user data from datatable row
                const data = window.oTable.row(parentTr).data();
                console.log('tableRow:', data);

                $('#createdBy').val(data.createdBy);
                $('#Available_Job_Id').val(data.Available_Job_Id);



            });
            
 // Update candidate Ajax
 $('#updateBtn').click(function(e) {
                e.preventDefault();
                const rowid = $('#updateForm  #candidate_id').val();
                $(this).html('Sending..');
                $(this).prop('disabled', true);
                const frmData = $('#updateForm').serialize();
                console.log('frmData:', frmData);

                $.ajax({
                    data: frmData,
                    url: "{{ route('jobapply.index') }}/" + rowid,
                    type: "PUT",
                    success: function(data) {

                        $('#updateForm .form-control').removeClass('is-invalid');
                        $('#updateForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

                        $('#updateForm').trigger("reset");
                        $('#editModel').modal('hide');
                        $('#updateBtn').html('Save Changes');

                        $('[data-entry-id=' + rowid + ']').addClass('table-success');
                        setTimeout(() => {
                            $('[data-entry-id=' + rowid + ']').removeClass(
                                'table-success');
                            setTimeout(() => {
                                $('[data-entry-id=' + rowid + ']').addClass(
                                    'table-success')
                            }, 100);
                        }, 200);

                        setTimeout(() => {
                            window.oTable.ajax.reload();
                            // add class table-success after reload oTable ajax finish rendering
                            window.oTable.initComplete = function() {
                                $('[data-entry-id=' + rowid + ']').addClass(
                                    'table-success');
                            };
                        }, 600);
                        // Print success message
                        if (data.success) {
                            toastr.success(data.success);
                        } else if (data.error) {
                            toastr.error(data.error);
                        }

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#updateForm .form-control').removeClass('is-invalid');
                        $('#updateForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

                        if (data.responseJSON.errors) {
                            // for in errors
                            $.each(data.responseJSON.errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).next('.text-danger').html(value);
                                toastr.error(value, 'Error in: ' + key);
                            });
                        }

                        $('#updateBtn').html('Save Changes');
                    },
                    // dataType: 'json',


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
                    data: data,
                    url: action,
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
