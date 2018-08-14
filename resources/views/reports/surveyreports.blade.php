{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Survey Report')

@section('content_header')
    <h1>Survey Report</h1>
@stop

@section('content')
@include('inc.errorhandler')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header">
				<h3 class="box-title">Survey Reports</h3>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
					<label>Club</label><br/>
						<select name="club" id="club" class="form-control">
							@foreach($query as $out)
								<option value="{{$out->id}}">{{$out->clubs}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						{{Form::label('from', 'From')}}
						{{Form::text('from', '', ['class' => 'form-control', 'id' => 'from'])}}
					</div>
					<button class="btn btn-info" id="sendReport">Send</button>
				</div>
			</div>
			<table id="dataTableEvent" class="table table-striped">
				<thead>
					<tr>
						<th>Question 1</th>
						<th>Question 2</th>
						<th>Question 3</th>
						<th>Respondent</th>
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
    		// $('#dataTableEvent').DataTable();
    		$('#from').datetimepicker({
				format: 'YYYY-MM-DD',
			});

			$(document).on('click', '#sendReport', function(){
				var from = $('#from').val();
				var club = $('#club').val();
				console.log(club + " " + from);
				$.ajax({
					url: '/api/getsurveyreport',
					method: 'POST',
					data:{
						'from': from,
						'club': club
					},
					dataType: 'json',
					success:function(response){
						console.log(response);
						var dataTableEvent = $('#dataTableEvent');
						$.each(response.query, function(idx, items){
					        dataTableEvent.append("<tr><td>"+items.title+"</td><td>"+items.title2+"</td><td>"+items.title3+"</td></tr>");
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