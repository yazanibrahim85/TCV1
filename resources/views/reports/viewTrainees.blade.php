@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Trainees</h1>	
	<hr> 
		
	<br>

	
	<p><a href="{{ URL::route('trainess.uploadnewTrainees.export')  }}" type="button" class="btn btn-primary btn-lg">Export Trainees Data</button></a></p>
		

	<br>
	<table class= "table table-hover" id="filterTable">
		<thead>					
			<th>Name</th>
			<th>Date Of Birth</th>
            <th>ID</th>
            <th>Area</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Phone No</th>
            <th>Major</th>
            <th>Email</th>

		</thead>		
				
			<tbody>
		
				
		
					<tr>
					<?php
					//dd($trainers);
					if (!empty($trainees[0]->id))
					{
						foreach($trainees as $trainee)
						{
							
							//dd ($trainer->area_id);
							$area_name=DB::select('select name from areas where id =?', [$trainee->area_id]);
						
							$area_name= $area_name[0]->name; ?>
		
							<tr>
							<td><a href="{{ route('trainees.show', ['id' => $trainee->id]) }}">{{ $trainee->name }}</a></td>
							<td>{{ $trainee->dob }}</td>
							<td>{{ $trainee->identification_no }}</td>
							<td>{{ $area_name }}</td>
							<td>{{ $trainee->address }}</td>
							<td>{{ $trainee->gender }}</td>
							<td>{{ $trainee->phone_no}}</td>
							<td>{{ $trainee->major}}</td>
							<td>{{ $trainee->email }}</td>
						<td>
							<a href="{{ route('trainees.edit', ['id' => $trainee->id]) }}" class="btn btn-info">Edit</a>
						</td>
						<td>
						
		
							<form action="{{route('trainees.destroy', ['id' => $trainee->id])}}" method="POST">
					
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
		
		