@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Trainers</h1>	
	<hr> 
	
	<a href="{{ route('trainers.create') }}" class="btn btn-primary">Create</a>
	{{-- <a href="{{ route('trainees.bin') }}" class="btn btn-danger">Recycle Bin</a> --}}
	
	<br>
	<br>
	<table class= "table table-hover" id="filterTable">
		<thead>					
			<th>Name</th>
			<th>Area</th>
			<th>Address</th>
            <th>Phone Number</th>
            <th>Major</th>
            <th>Email</th>
           
			<th>Edit</th>	
			<th>Trash</th>
		</thead>		
			
		<tbody>
			@if(count($trainers)> 0)
				@foreach($trainers as $trainer)
					<tr>
					<?php
					
						$area_name=DB::select('select name from areas where id =?', [$trainer->area_id]);
						  //dd($area_name[0]->id);
						  $area_name= $area_name[0]->name;
						
					  ?>	

						<td><a href="{{ route('trainers.show', ['id' => $trainer->id]) }}">{{ $trainer->name }}</a></td>
						<td>{{ $area_name}}</td>
						<td>{{ $trainer->address}}</td>
                        <td>{{ $trainer->phone_no}}</td>
                        <td>{{ $trainer->major}}</td>
                        <td>{{ $trainer->email }}</td>
						
						<td>
							<a href="{{ route('trainers.edit', ['id' => $trainer->id]) }}" class="btn btn-info">Edit</a>
						</td>
						<td>
							{{-- <form action="{{ route('trainees.destroy', ['id' => $trainee->id]) }}" method="POST">
								{{csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger">Bin</button>
							</form> --}}

                            <form action="{{route('trainers.destroy', ['id' => $trainer->id])}}" method="POST">
                    
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-left"> Delete</button>
        
                            </form>

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
	<div class="text-center">{{ $trainers->links() }}</div>
	@endif
	
	@endsection 

