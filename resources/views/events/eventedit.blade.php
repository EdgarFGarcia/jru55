{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Events Edit')

@section('content_header')
	<h1>
        Events Edit<small>{{$query->title}}</small> <br/>
        <small><a href="/event"> <i class="fa fa-arrow-left"></i><span> Back</span></a></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li>Isaac Lopez Integerated School</li>
        <li>Events Edit {{$query->title}}</li><br/>
    </ol>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		@include('inc.errorhandler')
		{!! Form::open(['action' => ['Events\EventsHandlerController@store'], 'method' => 'POST']) !!}

		
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="form-group">
						{{Form::label('who', 'Who')}}
						<select name="who" id="who" class="form-control">
							<option value="{{$who->gid}}" selected="selected">{{$who->grade}}</option>
							@foreach($grades as $grade)
								<option value="{{$grade->id}}">{{$grade->grade}}</option>
							@endforeach
						</select>						
					</div>

					<div class="form-group">
						{{Form::label('when', 'When')}}
						{{Form::text('when', Carbon\Carbon::parse($query->whenevent)->format('Y-m-d H:i'), ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						{{Form::label('where', 'Where')}}
						{{Form::text('where', $query->where, ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						{{Form::label('title', 'Title Of Event')}}
						{{Form::text('title', $query->title, ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						{{Form::label('body', 'Title Of Event')}}
						{{Form::textarea('body', $query->body, ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						{{Form::label('category', 'Title Of Event')}}
						{{Form::text('category', $query->category, ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						{{Form::checkbox('active', $query->is_active, $query->is_active, [])}}
						{{Form::label('active', 'Is Active')}}
						<br/>
						{{Form::checkbox('approve', $query->dateapproved, $query->dateapproved, [])}}
						{{Form::label('approve', 'Approved')}}
					</div>

					{{Form::submit('Edit', ['class' => 'btn btn-info'])}}
				</div>
			</div>
		</div>

		{!! Form::close() !!}
	</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
    	$(document).ready(function(){
    		$('#who').select2();
    		$('#when').datetimepicker({
				format: 'YYYY/MM/DD H:m',
			});
    	});
    </script>
@stop