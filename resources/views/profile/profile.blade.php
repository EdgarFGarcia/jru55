{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Welcome: {{Auth::User()->lastname}}, {{Auth::User()->firstname}}</h1>
@stop

@section('content')
@include('inc.errorhandler')
@if(Auth::User()->position == '1')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
			<div class="box-header">
				<h3 class="box-title">User Profiles</h3>
			</div>
		</div>
		<div class="box-body">
			<table id="userProfiles">
				<thead>
					<tr>
						<td>Name</td>
						<td>Grade</td>
						<td>Section</td>
						<td>Club</td>
						<td>Position</td>
						<td>Edit</td>
					</tr>
				</thead>
				<tbody>
					@foreach($getAllUsers as $out)
						<tr>
							<td>{{$out->lastname}}, {{$out->firstname}}</td>
							<td>{{$out->grade}}</td>
							<td>{{$out->section}}</td>
							<td>{{$out->clubs}}</td>
							<td>{{$out->position}}</td>
							<td><a href="profile/{{$out->id}}/edit" class="btn btn-info"><i class="glyphicon glyphicon-edit"></i></a></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@else
<div class="row">
	<div class="col-md-12">
		@include('inc.errorhandler')
		{!! Form::open(['action' => ['Users\ProfilesController@update', $query->id], 'method' => 'POST'])!!}

		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
					<div class="form-group">
						{{Form::label('username', 'Username')}}
						{{Form::text('username', $query->name, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('idNumber', 'Username')}}
						{{Form::text('idNumber', $query->idNumber, ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('password', 'Password')}}
                      {{Form::password('password', ['class' => 'form-control'])}}
					</div>
					<div class="form-group">
						{{Form::label('password_confirmation', 'Confirm Password')}}
                      	{{Form::password('password_confirmation', ['class' => 'form-control'])}}
					</div>
					<div class="form-group"
						{{Form::label('firstname', 'First Name')}}
						{{Form::text('firstname', $query->firstname, ['class' => 'form-control'])}}
					</div>
						{{Form::label('middlename', 'Middle Name')}}
						{{Form::text('middlename', $query->firstname, ['class' => 'form-control'])}}
					<div class="form-group">
						{{Form::label('lastname', 'Last Name')}}
						{{Form::text('lastname', $query->lastname, ['class' => 'form-control'])}}
					</div>

					<div class="form-group">
						<label for="position">Position</label>
						@if(Auth::User()->position == '1')
							<select name="position" id="position" class="form-control">
								@foreach($positions as $position)
									<option value="{{$position->id}}">{{$position->position}}</option>
								@endforeach
							</select>
						@else
							{{Form::hidden('position', Auth::User()->position)}}
							<span class="form-control">{{$userLevel->position}}</span>
						@endif
					</div>

					<div class="form-group">
						<label for="grades">Grade</label>
						<select name="grade" id="grades" class="form-control">
							@foreach($grade as $g)
								<option value="{{$g->id}}">{{$g->grade}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="section">Section</label>
						<select name="section" id="section" class="form-control">
							@foreach($section as $s)
								<option value="{{$s->id}}">{{$s->section}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="clubs">Clubs</label>
						<select name="clubs" id="clubs" class="form-control">
							@foreach($clubs as $s)
								<option value="{{$s->id}}">{{$s->clubs}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="running">I would like to run as</label>
						<select name="candidate" id="cand" class="form-control">
							<option value="1">SELECT</option>
							@foreach($cand_position as $cand)
								<option value={{$cand->id}}>{{$cand->name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						{{Form::label('gender', 'Gender')}}
						<select name="gender" id="gender" class="form-control test">
							<option value="{{$query->gender}}">{{$query->gender}}</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
					</div>
					<div class="form-group">
						@if(is_null($query->birthdate))
							{{Form::label('birthday', 'Birth Date')}}
							{{Form::text('birthday', Carbon\Carbon::parse($query->birthdate)->format('Y-m-d'), ['class' => 'form-control', 'id' => 'bday'])}}
						@else
							{{Form::label('birthday', 'Birth Date')}}<br/>
							{{Carbon\Carbon::parse($query->birthday)->format('Y-m-d')}}
						@endif
					</div>
					<div class="form-group">
						{{Form::submit('Edit', ['class' => 'form-control btn btn-info'])}}
					</div>
				</div>
			</div>
		</div>
		{{Form::hidden('_method', 'PUT')}}
		{!! Form::close() !!}
	</div>
</div>
@endif

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> 
    	$('#bday').datetimepicker({
			format: 'YYYY/MM/DD',
		});
		$('#grades').select2();
		$('#section').select2();
		$('#clubs').select2();
		$('#gender').select2();
		$('#position').select2();
		$('#userProfiles').DataTable();
		$('#cand').select2();
    </script>
@stop