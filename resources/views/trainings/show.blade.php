@extends('layouts.master')


@section('content')

    	<div class="col-lg-12">
		
		<h1 class="page-header"><a href="{{url("/dynamic_pdf/{$id}")}}" target="_blank" > Training: {{ $courseName[0]->name_ar}}</a> </h1>
			
		<div class="form-group col-md-6">
		<h4>Number Of Training Hours: {{$NumberoftrainingHours}} </h4>
		</div>

		<div class="form-group col-md-6">
		<h4>Number Of Trainers: {{$Numberoftrainers}} </h4>
		</div>
		<div class="form-group col-md-6">
		<h4>Number Of Trainees: {{$Numberoftrainees}} </h4>
		</div>
		<div class="form-group col-md-6">
		<h4>Training Begin Date: {{$trainings->course_begin_date}} </h4>
		</div>
		<div class="form-group col-md-6">
			<h4>Training End Date: {{$trainings->course_end_date}} </h4>
		</div>
		<div class="form-group col-md-6">
		<h4>Training Expiration Date: {{$trainings->expiration_date}} </h4>
		</div>
		<div class="form-group col-md-6">
		<h4>Training Location: {{$trainings->location}} </h4>
		</div>
	</div>
	<br>
	<table class= "table table-hover">
		<thead>
			<th>Trainer Name</th>
		</thead>
		
		<tbody>
			@if(count($TrainerName) > 0)
			  @foreach($TrainerName as $TName)
					<tr>
						<td>{{ $TName->name }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">No Trainings Assigned yet to this Trainer</th>
				</tr>
			@endif		
		</tbody>	
	</table>

	<table class= "table table-hover">
		<thead>
			<th>Trainee Name</th>
		</thead>
		
		<tbody>
			@if(count($TraineeName) > 0)
			  @foreach($TraineeName as $TName)
					<tr>
						<td>{{ $TName->name }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">No Trainings Assigned yet to this Trainer</th>
				</tr>
			@endif		
		</tbody>	
	</table>

		
@endsection