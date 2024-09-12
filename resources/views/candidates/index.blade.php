@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For candidates
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        {{--<button type="button" class="btn btn-primary" onclick="createNewItem()">
            <i class="fa fa-plus"></i> إنشاء
        </button>--}}
        <table id="candidates" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
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
                    {{-- with count of jobApplies --}}
                    <th data-priority="9">jobApplies</th>
                    {{-- with count of JobCandidates --}}
                    <th data-priority="10">JobCandidates</th>
                    
                    <th data-priority="11">Action</th>

                </tr>
            </thead>
        </table>


    </div>
@stop
@section('scripts')
    <!-- Edit modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updatecandidateForm" name="updatecandidateForm" class="form-horizontal" >
                        @csrf
                        <input type="hidden" name="candidate_id" id="candidate_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Name" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Phone" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">City</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="City" name="City" placeholder="City" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Profile</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="profile" name="profile" placeholder="Profile" value="" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Rrsume</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="Resume" name="Resume" placeholder="Resume" value="" maxlength="50" required="">
                           {{-- Error message --}}
                        <div class="text-danger"></div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="create">
                              Save Changes
                            </button>
                        </div>
                            </div>
                        </div>

                    </form>
                </div>
                
            </div>
        </div>
    </div>



    


	<script>
        // add csrf token to ajax request
        $.ajaxSetup({
            
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
		$(document).ready(function() {
            console.log("This will get users by ajax request from route:","{{ route('candidates.index') }}");
            
			window.oTable = $('#candidates').DataTable({
					responsive: true,
                    processing: true,
                    serverSide: true,
                    // page length options
                    lengthMenu: [[5, 10, 20, 50, 100, 200, -1],[5, 10, 20, 50, 100, 200, "All"]],
                    // page length options
                    pageLength: 5,

                    ajax: "{{ route('candidates.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'FirstName', name: 'FirstName'},
                        {data: 'LastName', name: 'LastName'},
                        {data: 'Email', name: 'Email'},
                        {data: 'Phone', name: 'Phone'},
                        {data: 'city', name: 'city'},

                        {data: 'profile', name: 'profile'},
                        {data: 'Resume', name: 'Resume'},
                        {data: 'job_applies_count', name: 'job_applies_count', },
                        {data: 'job_candidates_count', name: 'job_candidates_count', },
                        {data: 'action', name: 'action', searchable: false, orderable: false},
                    ]
				})
				.columns.adjust()
				.responsive.recalc();
                 // Edit candidate Ajax
            $('body').on('click', '.candidate-edit', function() {
                var rowid = $(this).attr('data-id'), parentTr = $("[data-entry-id='"+rowid+"']");
                console.log('rowid:', rowid, 'parentTr:', parentTr);
                // read user data from datatable row
                const data = window.oTable.row(parentTr).data();
                console.log('tableRow:', data);

                $('#updatecandidateForm #candidate_id').val(data.id);
                $('#updatecandidateForm #FirstName').val(data.FirstName);
                $('#updatecandidateForm #LastName').val(data.LastName);
                $('#updatecandidateForm #Email').val(data.Email);
                $('#updatecandidateForm #Phone').val(data.Phone);
                $('#updatecandidateForm #City').val(data.city);
                $('#updatecandidateForm #profile').val(data.profile);
                $('#updatecandidateForm #Resume').val(data.Resume);
               


            });

            // Update candidate Ajax
            $('#updateBtn').click(function(e) {
                e.preventDefault();
                const rowid = $('#updatecandidateForm #candidate_id').val();
                $(this).html('Sending..');
                $(this).prop('disabled', true);
                const frmData = $('#updatecandidateForm').serialize();
                console.log('frmData:', frmData);

                $.ajax({
                    data: frmData,
                    url: "{{ route('candidates.index') }}/" + rowid,
                    type: "PUT",
                    success: function(data) {

                        $('#updatecandidateForm .form-control').removeClass('is-invalid');
                        $('#updatecandidateForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

                        $('#updatecandidateForm').trigger("reset");
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
                        $('#editForm .form-control').removeClass('is-invalid');
                        $('#editForm .text-danger').html('');
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
