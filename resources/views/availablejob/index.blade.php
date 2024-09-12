@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">

            <div class="d-flex justify-content-between">
                <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
                    Availablejob List</h1>
                <button type="button" class="btn btn-info mx-2" data-bs-toggle="modal" data-bs-target="#ajaxModel">New
                    Availablejob</button>
            </div>

        </div>
        <!--Card-->
        <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
            <table id="example" class="table table-bordered table-striped table-hover"
                style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                <thead>
                    <tr>

                        <th data-priority="1">Id</th>
                        <th data-priority="2">JobTitle</th>
                        <th data-priority="3">JobDescription</th>
                        <th data-priority="4">created_by</th>
                        <th data-priority="5">SalaryRange</th>
                        <th data-priority="6">PostingDate</th>
                        <th data-priority="7">ClosingDate</th>
                        <th data-priority="8">Action</th>


                    </tr>
                </thead>
            </table>


        </div>
    </div>
@stop
@section('scripts')
    <!-- Create Availablejob Modal -->

    <div class="modal fade" id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Add New Job</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="jobForm" name="jobForm" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="jobTitle">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle"
                                placeholder="Enter job title">
                        </div>
                        <div class="form-group">
                            <label for="jobDescription">Job Description</label>
                            <textarea class="form-control" id="jobDescription" name="jobDescription" rows="3"
                                placeholder="Enter job description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="salaryRange">Salary Range</label>
                            <input type="text" class="form-control" id="salaryRange" name="salaryRange"
                                placeholder="Enter salary range">
                        </div>
                        <div class="form-group">
                            <label for="postingDate">Posting Date</label>
                            <input type="date" class="form-control" id="postingDate" name="postingDate">
                        </div>
                        <div class="form-group">
                            <label for="closingDate">Closing Date</label>
                            <input type="date" class="form-control" id="closingDate" name="closingDate">
                            {{-- Error message --}}
                            <div class="text-danger"></div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">
                                    Save New Job
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!--update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modelHeading">Update Availablejob</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updatejobForm" name="updatejobForm" class="form-horizontal">
                        @csrf
                        <input type="hidden" id="job_id" name="job_id" value="">
                        <div class="form-group">
                            <label for="jobTitle">Job Title</label>
                            <input type="text" class="form-control" id="jobTitle" name="jobTitle"
                                placeholder="Enter job title">
                        </div>
                        <div class="form-group">
                            <label for="jobDescription">Job Description</label>
                            <textarea class="form-control" id="jobDescription" name="jobDescription" rows="3"
                                placeholder="Enter job description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="salaryRange">Salary Range</label>
                            <input type="text" class="form-control" id="salaryRange" name="salaryRange"
                                placeholder="Enter salary range">
                        </div>
                        <div class="form-group">
                            <label for="postingDate">Posting Date</label>
                            <input type="date" class="form-control" id="postingDate" name="postingDate">
                        </div>
                        <div class="form-group"></div>
                        <label for="closingDate">Closing Date</label>
                        <input type="date" class="form-control" id="closingDate" name="closingDate">
                        {{-- Error message --}}
                        <div class="text-danger"></div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="updateBtn" value="create">
                              Save Changes
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
            console.log("This will get users by ajax request from route:", "{{ route('available.index') }}");

            window.oTable = $('#example').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('available.index') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },

                        {
                            data: 'JobTitle',
                            name: 'JobTitle'
                        },
                        {
                            data: 'JobDescription',
                            name: 'JobDescription'
                        },
                        {
                            data: 'createdBy.name',
                            name: 'createdBy.name'
                        },
                        {
                            data: 'SalaryRange',
                            name: 'SalaryRange'
                        },
                        {
                            data: 'PostingDate',
                            name: 'PostingDate'
                        },
                        {
                            data: 'ClosingDate',
                            name: 'ClosingDate'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            searchable: false,
                            orderable: false
                        },




                    ]
                })
                .columns.adjust().responsive.recalc();
            // Create New Vailablejob Ajax

            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Sending..');

                $.ajax({
                    data: $('#jobForm').serialize(),
                    url: "{{ route('available.store') }}",

                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#jobForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#saveBtn').html('Save New Job');
                        window.oTable.ajax.reload();
                        // Print success message
                        if (data.success) {
                            toastr.success(data.success);
                        } else if (data.error) {
                            toastr.error(data.error);
                        }

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#jobForm .form-control').removeClass('is-invalid');
                        $('#jobForm .text-danger').html('');
                        if (data.responseJSON.errors) {
                            // for in errors
                            $.each(data.responseJSON.errors, function(key, value) {
                                $('#' + key).addClass('is-invalid');
                                $('#' + key).next('.text-danger').html(value);
                                //toastr.error(value, 'Error in: '+key);
                            });
                        }
                        $('#saveBtn').html('Save Changes');
                    },

                });

            });
            // Edit User Ajax
            $('body').on('click', '.job-edit', function() {
                var rowid = $(this).attr('data-id'), parentTr = $("[data-entry-id='"+rowid+"']");
                console.log('rowid:', rowid, 'parentTr:', parentTr);
                // read user data from datatable row
                const data = window.oTable.row(parentTr).data();
                console.log('tableRow:', data);

                $('#updatejobForm #job_id').val(data.id);
                $('#updatejobForm #jobTitle').val(data.JobTitle);
                $('#updatejobForm #jobDescription').val(data.JobDescription);
                $('#updatejobForm #salaryRange').val(data.SalaryRange);
                $('#updatejobForm #postingDate').val(data.PostingDate);
                $('#updatejobForm #closingDate').val(data.ClosingDate);


            });

            // Update User Ajax
            $('#updateBtn').click(function(e) {
                e.preventDefault();
                const rowid = $('#job_id').val();
                $(this).html('Sending..');
                $(this).prop('disabled', true);
                const frmData = $('#updatejobForm').serialize();
                console.log('frmData:', frmData);

                $.ajax({
                    data: frmData,
                    url: "{{ route('available.index') }}/" + rowid,
                    type: "PUT",
                    success: function(data) {

                        $('#updatejobForm .form-control').removeClass('is-invalid');
                        $('#updatejobForm .text-danger').html('');
                        $('#updateBtn').prop('disabled', false);

                        $('#updatejobForm').trigger("reset");
                        $('#updateModel').modal('hide');
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
                        $('#updatejobForm .form-control').removeClass('is-invalid');
                        $('#updatejobForm .text-danger').html('');
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
            })

            // Delete Job Ajax
            $('body').on('click', '.job-delete', function(e) {
                e.preventDefault();
                const
                    form = $(this).parents('form'),
                    endPoint = form.attr('action'),
                    form_data = form.serialize(),
                    user_id = $(this).data('id');
                console.log('endPoint:', endPoint, 'user_id:', user_id);

                if (confirm("Are You sure want to delete !")) {
                    $.ajax({
                        type: "DELETE",
                        url: endPoint,
                        data: form_data,
                        success: function(data) {
                            window.oTable.ajax.reload();
                            toastr.success(data.success);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            toastr.error(data.error);
                        }
                    });
                }
            });


        });
    </script>

@stop
