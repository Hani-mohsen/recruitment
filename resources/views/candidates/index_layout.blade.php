@extends('layouts.app')

@section('content')
    <!--Title-->
    <h1 class=" text-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl ">
        Table For Candidates
    </h1>

    <!--Card-->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="example" class="table table-bordered table-striped table-hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
            <thead>
                <tr>

                    <th data-priority="1">Id</th>
                    <th data-priority="2">Name</th>
                    <th data-priority="3">Email</th>
                
                </tr>
            </thead>
            <tbody>
                
                @foreach ($candidates as $c)
                <tr>
                    <td>{{ $c->id }}</td>
                    <td>{{ $c->FirstName }}</td>
                    <td>{{ $c->LastName }}</td>
                    <td>{{ $c->Email }}</td>
                    <td>{{ $c->Phone }}</td>
                    <td>{{ $c->city }}</td>
                    <td>{{ $c->profile }}</td>
                    <td>{{ $c->Resume }}</td>
                </tr>
                @endforeach
                

                <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                
                
            </tbody>

        </table>


    </div>
@stop
@section('partials.script')

	<script>
		$(document).ready(function() {

			var table = $('#example').DataTable({
					responsive: true
				})
				.columns.adjust()
				.responsive.recalc();
		});
	</script>

@stop
