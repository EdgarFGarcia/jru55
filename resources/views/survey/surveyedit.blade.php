{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')
    <!-- <h1>Survey</h1> -->
@stop

@section('content')
@include('inc.errorhandler')
<div class="row">
	<div class="col-md-12">
		{{Form::open(['action' => ['Surveys\Surveys@update', $query->id], 'method' => 'POST'])}}
		{{Form::hidden('student_id', $query->id)}}
		<div class="col-md-6">
			<div class="box box-solid box-success">
                <div class="box-header">
                    <h3 class="box-title">Survey</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<div class="form-body">
	                    {{Form::label('q1', 'Question: ' . $query->title)}}
	                    {{Form::text('q1', '', ['class' => 'form-control', 'required', 'placeholder' => 'Answer Here'])}}
                    </div>
                    <div class="form-body">
	                    {{Form::label('q2', 'Question: ' . $query->title2)}}
	                    {{Form::text('q2', '', ['class' => 'form-control', 'required', 'placeholder' => 'Answer Here'])}}
                    </div>
                    <div class="form-body">
	                    {{Form::label('q3', 'Question: ' . $query->title3)}}
	                    {{Form::text('q3', '', ['class' => 'form-control', 'required', 'placeholder' => 'Answer Here'])}}
                    </div>
                    <br/>
                    <div class="form-body">
                   		{{Form::submit('Save', ['class' => 'btn btn-success'])}}
                	</div>
                </div><!-- /.box-body -->
            </div>
		</div>

		{{Form::hidden('_method', 'PUT')}}
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
    		// $('#clubsTable').DataTable();
    	});
    </script>
@stop