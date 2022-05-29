@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Trainings</h1>	
	<hr> 
		
	<br>
	{{-- <p><a href="{{ route('trainess.uploadnewTrainings.exportTrainings', ['id'=>$training_id]) }}" class="btn btn-primary btn-lg">Export Trainings Data</a></p>
	 --}}
	
		<p><a href="{{ URL::route('trainess.uploadnewTrainings.exportTrainings')  }}" type="button" class="btn btn-primary btn-lg">Export Trainings Data</button></a></p>
   
	<br>
	<table class= "table table-hover" id="filterTable">
		<thead>					
			<th>Course Name</th>
			<th>participants_no</th>
			<th>course_begin_date</th>
			<th>course_end_date</th>
            <th>expiration_date</th>
			<th>sponsored_by</th>
			<th>beneficiary</th>
			<th>Area</th>
            <th>location</th>
            

		</thead>		
				
			<tbody>
		
				
		
					<tr>
					<?php
					//dd($trainers);
					if (!empty($trainings[0]->id))
					{
						foreach($trainings as $training)
						{
							
						
						  	$courses_name=DB::select('select name_ar from courses where id =?', [$training->course_id]);
							//dd($courses_id[0]->id);
							$courses_name= $courses_name[0]->name_ar;

							$area_name=DB::select('select name from areas where id =?', [$training->area_id]);
						  //dd($area_name[0]->id);
						  $area_name= $area_name[0]->name;

						?>					
						<td><a href="{{ route('trainings.show', ['id' => $training->id]) }}">{{ $courses_name }}</a></td>
						<td>{{ $training->participants_no}}</td>
						<td>{{ $training->course_begin_date }}</td>
						<td>{{ $training->course_end_date }}</td>
                        <td>{{ $training->expiration_date}}</td>
						<td>{{ $training->sponsored_by }}</td>
						<td>{{ $training->beneficiary }}</td>
						<td>{{ $area_name}}</td>
                        <td>{{ $training->location}}</td>
                        

						<td>
							<a href="{{ route('trainings.edit', ['id' => $training->id]) }}" class="btn btn-info">Edit</a>
						</td>
						<td>
						
		
							<form action="{{route('trainings.destroy', ['id' => $training->id])}}" method="POST">
					
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger float-left"> Delete</button>
		
							</form>
		
						</td>
					</tr>
						<?php }
						
					}
					else {?>
							<tr> 
							<th colspan="5" class="text-center">Empty</th>
						</tr>
						<?php } ?>
		
		
		
						
					</tr>
			
		
			</tbody> 						
		</table>
		
		@endsection 
		
		