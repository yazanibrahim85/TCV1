@extends('layouts.master')


@section('content')


<hr>	
<h1 class="text-center">Trainers</h1>	
<hr> 


<br>

<p><a href="{{ URL::route('trainess.uploadnewTrainers.exportTrainers')  }}" type="button" class="btn btn-primary btn-lg">Export Trainers Data</button></a></p>
	

<br>
<table class= "table table-hover" id="filterTable">
	<thead>					
		<th>Name</th>
		<th>Area</th>
		<th>Address</th>
		<th>Phone Number</th>
		<th>Major</th>
		<th>Email</th>
		<th>Role_ID</th>
	</thead>		
	
	<tbody>

		

			<tr>
			<?php
			//dd($trainers);
			if (!empty($trainers[0]->id))
			{
				foreach($trainers as $trainer)
				{
					
					//dd ($trainer->area_id);
					$area_name=DB::select('select name from areas where id =?', [$trainer->area_id]);
				
					$area_name= $area_name[0]->name; ?>

					<tr>
					<td><a href="{{ route('trainers.show', ['id' => $trainer->id]) }}">{{ $trainer->name }}</a></td>
				<td>{{ $area_name}}</td>
				<td>{{ $trainer->address}}</td>
				<td>{{ $trainer->phone_no}}</td>
				<td>{{ $trainer->major}}</td>
				<td>{{ $trainer->email }}</td>
				<td>{{ $trainer->role_id }}</td>
				<td>
					<a href="{{ route('trainers.edit', ['id' => $trainer->id]) }}" class="btn btn-info">Edit</a>
				</td>
				<td>
				

					<form action="{{route('trainers.destroy', ['id' => $trainer->id])}}" method="POST">
			
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

