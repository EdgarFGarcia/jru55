{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Event Report')

@section('content_header')
    <h1>Event Report</h1>
@stop

@section('content')
@include('inc.errorhandler')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header">
				<h3 class="box-title">Event Reports</h3>
			</div>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-6">
						<label>Grade</label><br/>
						<select name="grade" id="grade" class="form-control">
							@foreach($query as $out)
								<option value="{{$out->id}}">{{$out->grade}}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-6">
						{{Form::label('from', 'From')}}
						{{Form::text('from', '', ['class' => 'form-control', 'id' => 'from'])}}
					</div>
					<button class="btn btn-info" id="sendEventReport">Send</button>
				</div>
			</div>
			<table id="userProfiles" class="table table-striped">
				<thead>
					<tr>
						<th>Title</th>
						<th>Body</th>
						<th>When</th>
						<th>Where</th>
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
    		$('#grade').select2();
    		$('#from').datetimepicker({
				format: 'YYYY-MM-DD',
			});

			$(document).on('click', '#sendEventReport', function(){
				var from = $('#from').val();
				var grade = $('#grade').val();
				console.log(from + " " + grade);
				$.ajax({
					url: '/api/geteventreports',
					method: 'POST',
					data:{
						'from': from,
						'grade': grade,
					},
					dataType: 'json',
					success:function(response){
						console.log(response);
						var userProfiles = $('#userProfiles');
						$.each(response.query, function(idx, items){
					        userProfiles.append("<tr><td>"+items.title+"</td><td>"+items.body+"</td><td>"+items.whenevent+"</td><td>"+items.where+"</td></tr>");
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