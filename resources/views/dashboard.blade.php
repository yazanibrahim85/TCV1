@extends('layouts.master')

@section('content')
	<hr>	
	<h1 class="text-center">Dashboard</h1>	
	<hr>
		<?php
           // dd(count($trainings));
        ?>
		<div align="center">
			@if(Auth::user()->role_id==1 or Auth::user()->role_id==2)
			
			<div class="card text-white bg-danger mb-3" style="max-width: 18rem;" align="center">
				<div class="card-header">On-Going Courses</div>
				<div class="card-body">
					
				<h5 class="card-title">{{$trainingsonGoingCount}}</h5>
				@foreach($trainingsonGoing as $training)

				<a href="{{url("/trainings/{$training->id}")}}" target="_blank" ><p class="card-text">{{ $training->name_en }} - - {{ $training->name_ar }}</p></a>
				@endforeach
				</div>
			
			</div>
			@endif
		</div>
        <div class="row">
			
        <div class="col-sm-3">
        <div class="card border-secondary mb-3 ml-3" style="max-width: 12rem; text-align: center;">
            <div class="card-header">Trainings issued</div>
            <div class="card-body text-secondary">
              <p class="card-text" >{{ $trainingsCount }}</p>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
            <div class="card border-secondary mb-3 ml-3" style="max-width: 12rem; text-align: center;">
              <div class="card-header">Trainers Count</div>
              <div class="card-body text-secondary">
                <p class="card-text" >{{ $trainersCount }}</p>
              </div>
            </div>
          </div>
        <div class="col-sm-3">
          <div class="card border-secondary mb-3 ml-3" style="max-width: 12rem; text-align: center;">
            <div class="card-header">Trainees Count</div>
            <div class="card-body text-secondary">
              <p class="card-text" >{{ $traineesCount }}</p>
            </div>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="card border-secondary mb-3 ml-3" style="max-width: 12rem; text-align: center;">
            <div class="card-header">Courses Count</div>
            <div class="card-body text-secondary">
              
              <p class="card-text" >{{ $coursesCount }}</p>
            </div>
          </div>
        </div>

		
    </div>


		

	
	
	<hr>
	
	<h3>Latest Trainings</h3>
	
	<table class= "table table-hover">
		<thead>	
			<tr>
				<th>Date Added</td>
				<th>Course Name</th>
				<th>Training Start Date</th>
				<th>Training End Date</th>
				<th>Location</th>
				<th>Number Of Participants</th>
			</tr>
		</thead>		
			
		<tbody>
			@if($trainingsCount> 0)
				@foreach($trainings as $training)
					<tr>	
						<?php
						$courseName=DB::select("select courses.name_ar from courses,trainings where courses.id=trainings.course_id and trainings.id=".$training->id);
						//dd($courseName[0]->name_ar);
						?>	
						<td>{{ $training->created_at }}</td>
						<td>{{ $courseName[0]->name_ar }}</td>
						<td>{{ $training->course_begin_date }}</td>
						<td>{{ $training->course_end_date }}</td>
						<td>{{ $training->location }}</td>
						<td>{{ $training->participants_no }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">Empty</th>
				</tr>
			@endif
		</tbody>							
	</table>
	
	<hr>
	
	<h3>Latest Trainees</h3>
	
	<table class= "table table-hover">
		<thead>	
			<tr>
				<th>Date Added</td>
				<th>Name</th>
				<th>Address</th>
				<th>Gender</th>
				<th>Major</th>
			</tr>
		</thead>		
			
		<tbody>
			@if($traineesCount> 0)
				@foreach($trainees as $trainee)
					<tr>		
						<td>{{ $trainee->created_at }}</td>
						<td>{{ $trainee->name }}</td>
						<td>{{ $trainee->address }}</td>
						<td>{{ $trainee->gender }}</td>
						<td>{{ $trainee->major }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">Empty</th>
				</tr>
			@endif
		</tbody>							
	</table> 

	
	<hr>
	
	<h3>Latest Trainers</h3>
	
	<table class= "table table-hover">
		<thead>	
			<tr>
				<th>Date Added</td>
				<th>Name</th>
				<th>Address</th>
				<th>Email</th>
				<th>Major</th>
			</tr>
		</thead>		
			
		<tbody>
			@if($trainersCount> 0)
				@foreach($trainers as $trainer)
					<tr>		
						<td>{{ $trainer->created_at }}</td>
						<td>{{ $trainer->name }}</td>
						<td>{{ $trainer->address }}</td>
						<td>{{ $trainer->email }}</td>
						<td>{{ $trainer->major }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">Empty</th>
				</tr>
			@endif
		</tbody>							
	</table> 


@endsection

