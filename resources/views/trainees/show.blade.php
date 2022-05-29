@extends('layouts.master')


@section('content')

    <div class="col-lg-12">
		<h1 class="page-header">Trainee: {{ $trainees->name }}</h1>
		<h2>Number Of Trainings: {{$countTr}} </h2>
	</div>
	<br>
	<table class= "table table-hover">
		<thead>
			<th>Trainee Name</th>
			<th>Training Name</th>
			{{-- <th>Training Name</th> --}}
            <th>Training Number of Participants</th>
			<th>Training Begin Date</th>
			<th>Training End Date</th>
            <th>Training Expiration Date</th>
			<th>Sponsored By</th>
			<th>Beneficiary</th>
			<th>Training Location</th>
			
		</thead>
		
		<tbody>
			@if(count($trainees) > 0)
		
			  @foreach($TraineesCoursesinfo as $TCI)
					<tr>
						<td><a href="{{url("/dynamic_pdf/{$trainees->id}/{$TCI->id}")}}" target="_blank" > {{ $trainees->name }} </a></td>
						{{-- <td><a href="{{ route('dynamic_pdf', ['id' => $trainees->id,'course_id'=>$TCI->id]) }}">{{ $trainees->name }}</a></td> --}}
						{{-- <td>{{ $TCI->name_ar }}</td> --}}
						<td>{{ $TCI->name_ar}}</td>
						<td>{{ $TCI->participants_no}}</td>
						<td>{{ $TCI->course_begin_date }}</td>
						<td>{{ $TCI->course_end_date }}</td>
                        <td>{{ $TCI->expiration_date}}</td>
						<td>{{ $TCI->sponsored_by }}</td>
						<td>{{ $TCI->beneficiary }}</td>
                        <td>{{ $TCI->location}}</td>
						
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