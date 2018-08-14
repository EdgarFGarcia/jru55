{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Survey')

@section('content_header')
    <h1>Survey</h1>
@stop

@section('content')
@include('inc.errorhandler')
@if(Auth::User()->position == "1")
<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<label>Create A Survey</label>
			<div class="box box-solid box-success">
	            <div class="box-header">
	                <h3 class="box-title">Create A Survey</h3>
	            </div>
	            <div class="box-body">
	                <label for="q1">Question 1:</label><br/>
	                <input type="text" class="form-control" id="q1"/><br/>
	                <label for="q2">Question 2:</label>
	                <input type="text" class="form-control" id="q2"/><br/>
	                <label type-"q3">Question 3:</label><br/>
	                <input type="text" class="form-control" id="q3"/><br/>
	                {{Form::label('group', 'Club')}}
					<select name="group" class="form-control" id="group">
						@foreach($queryAdmin as $out)
							<option value="{{$out->id}}">{{$out->clubs}}</option>
						@endforeach
					</select><br/>
					<button type="submit" class="btn btn-success" id="submitSurvey">Create</button>
	            </div>
	        </div>
		</div>
		<div class="col-md-6">
			<table class="table table-striped" id="surveyquetions">
				<thead>
					<tr>
						<th>Club</th>
						<th>Question 1</th>
						<th>Question 2</th>
						<th>Question 3</th>
					</tr>
				</thead>
				<tbody>
					@foreach($allSurvery as $out)
						<tr>
							<td>{{$out->clubs}}</td>
							<td>{{$out->title}}</td>
							<td>{{$out->title2}}</td>
							<td>{{$out->title3}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@elseif(Auth::User()->position == '3')
<div class="row">
	<div class="col-md-12">
		<div class="box box-solid box-success">
	           	<div class="box-header">
	                <h3 class="box-title">Answer Survey</h3>
	            </div>
	            <div class="box-body">
	            	<table class="table table-striped" id="surveyAnswer">
	            		<thead>
	            			<tr>
	            				<th>Title 1</th>
	            				<th>Title 2</th>
	            				<th>Title 3</th>
	            				<th>Answer</th>
	            			</tr>
	            		</thead>
	            		<tbody>
	            			@foreach($query as $out)
	            				@if($out->cid == Auth::User()->clubs)
		            				<tr>
			            				<td>{{$out->ct}}</td>
			            				<td>{{$out->ct2}}</td>
			            				<td>{{$out->ct3}}</td>
			            				<td><button class="btn btn-info" data-toggle="modal" data-target="#myModal" id="answer" value={{$out->sid}}>Participate</button></td>
			            			</tr>
			            		@endif
	            			@endforeach
	            		</tbody>
	            	</table>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- Modal -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title" id="title"></h4>
	      </div>
	      <div class="modal-body">
	        <label id="q1"></label><br/>
	        <input type="text" class="form-control" placeholder="Answer Here" id="answerq1"><br/>
	        <label id="q2"></label><br/>
	        <input type="text" class="form-control" placeholder="Answer Here" id="answerq2"><br/>
	        <label id="q3"></label><br/>
	        <input type="text" class="form-control" placeholder="Answer Here" id="answerq3"><br/>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-info" id="submitSurveryAnswer">Save</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	      </div>
	    </div>

	  </div>
	</div>
</div>
@endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script> 
    	var sid;
    	$(document).ready(function(){
    		$('#clubsTable').DataTable();
    		$('#surveyquetions').DataTable();
    		$('#surveyAnswer').DataTable();
    		$('#group').select2();

    		// post ajax call for submit survey
    		$(document).on('click', '#submitSurvey', function(){
    			var q1 = $('#q1').val();
    			var q2 = $('#q2').val();
    			var q3 = $('#q3').val();
    			var group = $('#group').find(":selected").val();
    			console.log(q1 + " " + q2 + " " + q3 + " " + group);
    			$.ajax({
    				url: '/api/postsurvey',
    				method: 'POST',
    				data:{
    					'q1': q1,
    					'q2': q2,
    					'q3': q3,
    					'group': group,
    				},
    				dataType:'json',
    				success:function(response){
    					console.log(response);
    					$('#q1').html('');
    					$('#q2').html('');
    					$('#q3').html('');
    					$('#group').html('');
    					toastr.success('Creating Survey Successful!');
    					setTimeout(function(){
    						reloadMe();
    					}, 1000);
    				},
    				error:function(response){
    					console.log(response);
    					toastr.error("there's an error!");
    				}
    			});
    		});

    		// answer survey
    		$(document).on('click', '#answer', function(){
    			var sid = $(this).val();
    			console.log(sid);
    			$.ajax({
    				url: '/api/getsurvey',
    				method: 'get',
    				data: {
    					'id': sid,
    				},
    				dataType: 'json',
    				success:function(response){
    					$('#title').html('');
    					$('#q1').html('');
    					$('#q2').html('');
    					$('#q3').html('');
    					$('#qid').html('');
    					$('#title').append('ID: ' + response.query.id);
    					$('#q1').append('Question One: ' + response.query.title);
    					$('#q2').append('Question One: ' + response.query.title2);
    					$('#q3').append('Question One: ' + response.query.title3);
    					$('#qid').append('id: ' + response.query.id);
    					console.log(response);
    				},
    				error:function(response){
    					console.log(response);
    				}
    			});
    		});

    		// submit survey answer
    		$(document).on('click', '#submitSurveryAnswer', function(){
    			var id = {{Auth::User()->id}}
    			var answerq1 = $('#answerq1').val();
    			var answerq2 = $('#answerq2').val();
    			var answerq3 = $('#answerq3').val();
    			console.log('clicked' + " " + id);
    			$.ajax({
    				url: '/api/getSurverAnswer',
    				method: 'POST',
    				data:{
    					'id': id,
    					'a1': answerq1,
    					'a2': answerq2,
    					'a3': answerq3,
    				},
    				dataType: 'json',
    				success:function(response){
    					console.log(response);
    					toastr.success('Thanks for your participation!');
    					setTimeout(function(){
    						reloadMe();
    					}, 1000);
    				},
    				error:function(response){
    					console.log(response);
    					toastr.error("there's an error!");
    				}
    			});
    		});
    	});
    	function reloadMe(){
    		window.location = "survey";
    	}
    </script>
@stop