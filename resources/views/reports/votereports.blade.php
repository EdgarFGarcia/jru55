{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@include('inc.errorhandler')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header">
				<h3 class="box-title">Vote Reports</h3>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<!-- <div class="col-md-6"> -->
						<label>Position</label><br/>
						<select name="position" id="position" class="form-control">
							@foreach($query as $out)
								<option value={{$out->id}}>{{$out->name}}</option>
							@endforeach
						</select>
					<!-- </div> -->
					{{--<div class="col-md-6">
						{{Form::label('from', 'From')}}
						{{Form::text('from', '', ['class' => 'form-control', 'id' => 'from'])}}
					</div>--}}
					<button class="btn btn-info" id="sendVote">Send</button>
				</div>
			</div>
			<table id="dataTableVote" class="table table-striped">
				<thead>
					<tr>
						<th>Running For</th>
						<th>Number Of Votes</th>
						<th>Lastname</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    	$(document).ready(function(){
    		$('#dataTableEvent').DataTable();
    		$('#from').datetimepicker({
				format: 'YYYY-MM-DD',
			});

			$(document).on('click', '#sendVote', function(){
				var position = $('#position').val();
				// var from = $('#from').val();
				$.ajax({

					url: '/api/getvotingreports',
					method: 'POST',
					data: {
						'position': position,
						// 'from': from
					},
					success:function(response){
						console.log(response);
						var dataTableVote = $('#dataTableVote');
						$.each(response.query, function(idx, items){
					        dataTableVote.append("<tr><td>"+items.name+"</td><td>"+items.votes+"</td><td>"+items.lastname+"</td></tr>");
					    });
					    toastr.success('Results are out');
					},
					error:function(response){
						console.log(response);
						toastr.error("There's an error");
					}

				});
			});
    	});
    </script>
@stop