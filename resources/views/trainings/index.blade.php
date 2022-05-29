@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Trainings</h1>	
	<hr> 
	
{{-- 	<a href="{{ route('trainings.create') }}" class="btn btn-primary">Create</a> --}}
	{{-- <a href="{{ route('trainees.bin') }}" class="btn btn-danger">Recycle Bin</a> --}}
	
	<br>
	<br>
	<table class= "table table-hover" id="filterTable">
		<thead>					
			<th>Course Name</th>
			<th>Participants Number</th>
			<th>Training Hours</th>
			<th>Course Begin Date</th>
			<th>Course End Date</th>
            <th>Certificate Validity Till</th>
			<th>Area</th>
            <th>Location</th>
			<th>Edit</th>	
			<th>Trash</th>
		</thead>		
			
		<tbody>
			@if(count($trainings)> 0)
				@foreach($trainings as $training)
				
					<tr>	
						<?php
						  $courses_name=DB::select('select name_ar from courses where id =?', [$training->course_id]);
							//dd($courses_id[0]->id);
							$courses_name= $courses_name[0]->name_ar;

							$area_name=DB::select('select name from areas where id =?', [$training->area_id]);
						  //dd($area_name[0]->id);
						  $area_name= $area_name[0]->name;

						?>					
						<td><a href="{{ route('trainings.show', ['id' => $training->id]) }}">{{ $courses_name }}</a></td>
						<td>{{ $training->participants_no}}</td>
						<td>{{ $training->training_hours}}</td>
						<td>{{ $training->course_begin_date }}</td>
						<td>{{ $training->course_end_date }}</td>
                        <td>{{ $training->expiration_date}}</td>
						<td>{{ $area_name}}</td>
                        <td>{{ $training->location}}</td>
                        
						
						<td>
							@if(Auth::user()->role_id==1)
							<a href="{{ route('trainings.edit', ['id' => $training->id]) }}" class="btn btn-info">Edit</a>
							@endif
						</td>
						<td>
							{{-- <form action="{{ route('trainees.destroy', ['id' => $trainee->id]) }}" method="POST">
								{{csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger">Bin</button>
							</form> --}}
							@if(Auth::user()->role_id==1)
                            <form action="{{route('trainings.destroy', ['id' => $training->id])}}" method="POST">
                    
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-left"> Delete</button>
        
                            </form>
							@endif
						</td>
					</tr>
				@endforeach
			@else
				<tr> 
					<th colspan="5" class="text-center">Empty</th>
				</tr>
			@endif
		</tbody>						
	</table>
	
	@if($role_id==3 or $role_id==2)

	
		
	@else
	
	<div class="text-center">{{ $trainings->links() }}</div>
	@endif
	
@endsection 


