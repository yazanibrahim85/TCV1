@extends('layouts.master')


@section('content')

    <div class="col-lg-12">
		<h1 class="page-header">Trainer: {{ $trainers->name }}</h1>
		<h2>Number Of Trainings: {{$countTr}} </h2>
	</div>
	<br>
	<table class= "table table-hover">
		<thead>
			<th>Training Name</th>
            <th>Training Number of Participants</th>
            <th>Training Expiration Date</th>
			<th>Training Location</th>
			<th>Training Date</th>
		</thead>
		
		<tbody>
			@if(count($trainers) > 0)
			  @foreach($TrainersCoursesinfo as $TCI)
					<tr>
						<td>{{ $TCI->name_ar }}</td>
						<td>{{ $TCI->participants_no}}</td>
                        <td>{{ $TCI->expiration_date}}</td>
                        <td>{{ $TCI->location}}</td>
						<td>{{ $TCI->course_begin_date }}</td>
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