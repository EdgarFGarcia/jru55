{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Create A Survey')

@section('content_header')
    <h1>Create A Survey</h1>
@stop

@section('content')
@include('inc.errorhandler')
<div class="row">
	<div class="col-md-12">
		{{Form::open(['action' => ['Surveys\Surveys@addSurvey'], 'method' => 'POST'])}}
		<div class="form-group">
			{{Form::label('group', 'Club')}}
			<select name="group" class="form-control" id="group">
				@foreach($queryAdmin as $out)
					<option value="{{$out->id}}">{{$out->clubs}}</option>
				@endforeach
			</select>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('survey1', 'Survey One Question')}}
				{{Form::textarea('survey1', '', ['class' => 'form-control', 'required'])}}
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				{{Form::label('survey2', 'Survey One Question')}}
				{{Form::textarea('survey2', '', ['class' => 'form-control', 'required'])}}
			</div>
		</div>
		<div class="form-group">
			{{Form::label('survey3', 'Survey One Question')}}
			{{Form::textarea('survey3', '', ['class' => 'form-control', 'required'])}}
		</div>
		{{Form::submit('Save', ['class' => 'btn btn-primary'])}}
		{{Form::close()}}
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
    		$('#group').select2();
    	});
    </script>
@stop