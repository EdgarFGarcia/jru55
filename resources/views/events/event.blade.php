{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Events')

@section('content_header')
    <h1>Events</h1>
@stop

@section('content')
@if(Auth::User()->position == '1')
<div class="row">
	<div class="col-md-12">
		@include('inc.errorhandler')
		{!! Form::open(['action' => 'Events\EventsHandlerController@store', 'method' => 'POST']) !!}
		
			<div class="box-body">
				<div class="form-group col-md-4">
					<div class="box box-primary">
						<div class="box-header with-border">
							{{Form::hidden('created_by', $user)}}

							<div class="form-group">
								<labal for="grade">Who | Grade</labal>
								<select name="grade" id="grade" class="form-control">
									@foreach($grade as $grades)
										<option value="{{$grades->id}}">{{$grades->grade}}</option>
									@endforeach
								</select>
							</div>

							<div class="form-group">
								<label for="date">When</label>
								{{Form::text('date', '', ['class' => 'form-control', 'id' => 'date', 'required'])}}
							</div>

							<div class="form-group">
								<label for="where">Where</label>
								{{Form::text('where', '', ['class' => 'form-control', 'required'])}}
							</div>

							<div class="form-group">
								{{Form::label('title', 'Title Of Event')}}
								{{Form::text('title', '', ['class' => 'form-control', 'required', 'id' => 'title',])}}
							</div>

							<div class="form-group">
								{{Form::label('body', 'Body of the Event')}}
								{{Form::textarea('body', '', ['class' => 'form-control', 'required', 'id' => 'body'])}}
							</div>

							<div class="form-group">
								{{Form::label('category', 'Category')}}
								{{Form::text('category', '', ['class' => 'form-control', 'required', 'id' => 'category'])}}
							</div>

							{{Form::submit('Add', ['class' => 'btn btn-primary'])}}
						</div>
					</div>
				</div>

				<div class="col-md-8">
					<div class="box box-primary">
						<div class="box-header with-border">
							<strong>Events</strong>
							<table class="table table-striped table-hover" id="dataTableEvent">
								<thead>
									<tr>
										<th>Title</th>
										<th>Body</th>
										<th>Category</th>
										<th>Created At</th>
										<th>Created By</th>
										<th>Approved By</th>
										<th>Date Approved</th>
										<th>Edit</th>
									</tr>
								</thead>
								<tbody>
									@foreach($query as $out)
										<tr>
											<td>{{$out->title}}</td>
											<td>{{$out->body}}</td>
											<td>{{$out->category}}</td>
											<td>{{ Carbon\Carbon::parse($out->created_at)->format('m/d/Y') }}</td>
											<td>{{$out->created_by}}</td>
											<td>
												@if(!empty($out->dateapproved))
													Yes
												@else
													No
												@endif									
											</td>
											<td>{{ Carbon\Carbon::parse($out->updated_at)->format('m/d/Y') }}</td>
											<td><a href="event/{{$out->id}}/edit" class="btn btn-danger"><i class="glyphicon glyphicon-edit"></i></a></td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

			</div>
		{!! Form::close() !!}
	</div>
</div>
@else
	You don't have an access here check the dashboard for updates
@endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    	$(document).ready(function(){
    		$('#dataTableEvent').DataTable();
    		$('#date').datetimepicker({
				format: 'YYYY/MM/DD',
			});
    		$('#grade').select2();
    	});
    </script>
@stop