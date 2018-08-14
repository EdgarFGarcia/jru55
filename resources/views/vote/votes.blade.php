{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@include('inc.errorhandler')
@if(Auth::User()->position == '1')
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid box-success">
            <div class="box-header">
                <h3 class="box-title">President</h3>
            </div>
            <div class="box-body">
                <table id="tableVoting">
                    <thead>
                        <tr>
                            <td>Candidate Name</td>
                            <td>Votes</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($query as $out)
                            <tr>
                                <td>{{$out->lastname}}, {{$out->firstname}}</td>
                                <td>{{$out->votes}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
	<div class="col-md-12">
		{{Form::open(['action' => ['Vote\Voting@store'], 'method' => 'POST'])}}

			<div class="box box-solid box-success">
                <div class="box-header">
                    <h3 class="box-title">Survey</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                	<table id="voteTable">
                		<thead>
                			<tr>
                				<td>Name of Candidate</td>
                				<td>Running For</td>
                				<td>School Year</td>
                				<td>Cast a vote for this candidate</td>
                			</tr>
                		</thead>
                		<tbody>
                			@foreach($query as $out)
                			<tr>
                                {{Form::hidden('id', $out->student_id)}}
                				<td>{{$out->lastname}}, {{$out->firstname}}</td>
                				<td>{{$out->name}}</td>
                				<td>{{ Carbon\Carbon::parse($out->year_of)->format('Y') }}</td>
                				<td><button type="submit" class="btn btn-info"><i class="fa fa-plus"></i></button></td>
                			</tr>
                			@endforeach
                		</tbody>
                	</table>
                </div><!-- /.box-body -->
            </div>

		{{Form::close()}}
	</div>
</div>
@endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    	$(document).ready(function(){
    		$('#voteTable').DataTable();
            $('#tableVoting').DataTable();
    	});
    </script>
@stop