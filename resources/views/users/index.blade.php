@extends('layouts.app')

@section('content')

    <!--Card-->
    <div class="card">
        <div class="card-header">
            
            <div class="d-flex justify-content-between">
                <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
                Users List</h1>
                <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#ajaxModel">New user</button>
            </div>

        </div>
        <div class="card-body p-0">
            <div id='recipients' class="p-3 mt-6 lg:mt-0 rounded shadow bg-white">
                <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                    <thead>
                        <tr>

                            <th data-priority="1">Id</th>
                            <th data-priority="2">Name</th>
                            <th data-priority="3">Email</th>
                            <th data-priority="4">Action</th>
                        
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    


@stop
@section('scripts')
  
    <!-- Create User Modal -->
    <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="ajaxModelLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading">Add New User</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="userForm" name="userForm" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="" maxlength="150" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="" maxlength="150" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="password_confirm" name="comfirm_password" placeholder="Confirm password" value="" maxlength="150" required>
                                {{-- Error message --}}
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                                Save New User
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
                    <h4 class="modal-title" id="modelHeading">Update User</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateUserForm" name="updateUserForm" class="form-horizontal">
                        <input type="hidden" name="user_id" id="user_id">
                        <input type="hidden" name="_method" value="PUT">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="username" name="name" placeholder="Enter name" value="" maxlength="250" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="useremail" name="email" placeholder="Enter email" value="" maxlength="150" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="userpassword" name="password" placeholder="Enter password" value="" maxlength="150" required>
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirm" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control" id="userpassword_confirm" name="comfirm_password" placeholder="Confirm password" value="" maxlength="150" required>
                                {{-- Error message --}}
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="note" class="col-sm-2 control-label">Note</label>
                            <div class="col-sm-12">
                                {{-- textarea --}}
                                <textarea class="form-control" id="usernote" name="note" rows="5"></textarea>
                                {{-- Error message --}}
                                <div class="text-danger"></div>
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="update">
                                Update User
                            </button>
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
            console.log("This will get users by ajax request from route:","{{ route('users.index') }}");
            
			window.oTable = $('#example').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', searchable: false, orderable: false},
                ]
            }).columns.adjust().responsive.recalc();
            
            // Create New User Ajax

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#userForm').serialize(),
                    url: "{{ route('users.store') }}",
                    
                    type: "POST",
                    dataType: 'json',
                    success: function (data) { 

                        $('#userForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#saveBtn').html('Save New User');
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
                        $('#userForm .form-control').removeClass('is-invalid');
                        $('#userForm .text-danger').html('');
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

            // Edit User Ajax
            $('body').on('click', '.user-edit', function () {
                var user_id = $(this).data('rowid');
                // read user data from datatable row
                const data = window.oTable.row($(this).parents('tr')).data();
                console.log('tableRow:', data);
                
                $('#user_id').val(data.id);
                $('#username').val(data.name);
                $('#useremail').val(data.email);
                $('#usernote').val(data.note);
                
            });
            // Update User Ajax
            $('#updateBtn').click(function (e) {
                e.preventDefault();
                const userId = $('#user_id').val();
                $(this).html('Sending..');
                $(this).prop('disabled', true);
                const frmData = $('#updateUserForm').serialize();
                console.log('frmData:', frmData);
                
                $.ajax({
                    data: frmData,
                    url: "{{ route('users.index') }}/" + userId,
                    type: "PUT",
                    success: function (data) {

                        $('#updateUserForm .form-control').removeClass('is-invalid');
                        $('#updateUserForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

                        $('#updateUserForm').trigger("reset");
                        $('#updateModel').modal('hide');
                        $('#updateBtn').html('Save Changes');

                        $('[data-entry-id=' + userId + ']').addClass('table-success');
                        setTimeout(() => {
                            $('[data-entry-id=' + userId + ']').removeClass('table-success');
                            setTimeout(() => {
                                $('[data-entry-id=' + userId + ']').addClass('table-success')
                            }, 100);
                        }, 200);

                        setTimeout(() => {
                            window.oTable.ajax.reload();
                            // add class table-success after reload oTable ajax finish rendering
                            window.oTable.initComplete = function () {
                                $('[data-entry-id=' + userId + ']').addClass('table-success');
                            };
                        }, 600);
                        // Print success message
                        if(data.success){
                            toastr.success(data.success);
                        }else if(data.error){
                            toastr.error(data.error);
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#updateUserForm .form-control').removeClass('is-invalid');
                        $('#updateUserForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

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
                    // dataType: 'json',


                });
            })
            // Delete User Ajax
            $('body').on('click', '.user-delete', function (e) {
                e.preventDefault();
                const 
                form = $(this).parents('form'), 
                endPoint = form.attr('action'), 
                form_data = form.serialize(),
                user_id = $(this).data('id');
                console.log('endPoint:', endPoint, 'user_id:', user_id);
                
                if(confirm("Are You sure want to delete !")){
                    $.ajax({
                        type: "DELETE",
                        url: endPoint,
                        data: form_data,
                        success: function (data) {
                            window.oTable.ajax.reload();
                            toastr.success(data.success);
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            toastr.error(data.error);
                        }
                    });
                }
            });
            


            
		});
	</script>

@stop
