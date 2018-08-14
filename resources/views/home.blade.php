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
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<strong><i class="fa fa-calendar"></i> Events</strong>
					<table class="table table-striped table-hover" id="dataTableEvent" style="width:100%">
						<thead>
							<tr>
								<th>Who</th>
								<th>When</th>
								<th>Where</th>
								<th>Title</th>
								<th>Body</th>
								<th>Category</th>
								<th>Created At</th>
								<th>Created By</th>
							</tr>
						</thead>
						<tbody>
							@foreach($queryEvents as $out)
								@if($out->dateapproved == '1' && $out->is_active == '1')
								<tr>
									<td>{{$out->grade}}</td>
									<td>{{ Carbon\Carbon::parse($out->whenevet)->format('m/d/Y H:i') }}</td>
									<td>{{$out->where}}</td>
									<td>{{$out->title}}</td>
									<td>{{$out->body}}</td>
									<td>{{$out->category}}</td>
									<td>{{ Carbon\Carbon::parse($out->created_at)->format('m/d/Y') }}</td>
									<td>{{$out->created_by}}</td>
								</tr>
								@else
									<strog>Admin Waiting Approval</strog>
								@endif
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
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
    	});
    </script>
@stop