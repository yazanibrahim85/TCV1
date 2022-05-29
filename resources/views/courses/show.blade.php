@extends('layouts.master')


@section('content')

    <div class="col-lg-12">
		<h1 class="page-header">Course: {{ $courses->name_ar }}</h1>
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
			@if(count($courses) > 0)
			  @foreach($Coursesinfo as $CI)
					<tr>
						<td>{{ $CI->name_ar }}</td>
						<td>{{ $CI->participants_no}}</td>
                        <td>{{ $CI->expiration_date}}</td>
                        <td>{{ $CI->location}}</td>
						<td>{{ $CI->course_date }}</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">No Trainings Assigned yet to this Trainee</th>
				</tr>
			@endif		
		</tbody>	
	</table>
		
@endsection