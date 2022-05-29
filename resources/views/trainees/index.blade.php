@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Trainees</h1>	
	<hr> 

	@auth
	@if(Auth::user()->role_id==1 Or Auth::user()->role_id==2)
	<a href="{{ route('trainees.create') }}" class="btn btn-primary">Create</a>
	
	 <a href="{{ route('trainees.uploadnewTrainees') }}" class="btn btn-primary">Upload Trainees</a>
	{{-- <a href="{{ route('trainees.bin') }}" class="btn btn-danger">Recycle Bin</a> --}}
	@endif
	@endauth
	<br>
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
			<th>Edit</th>	
			<th>Trash</th>
		</thead>		
			
		<tbody>
			@if(count($trainees)>0)
				@foreach($trainees as $trainee)
					<tr>	
						<?php
			
						$area_name=DB::select('select name from areas where id =?', [$trainee->area_id]);
					   
						 $area_name= $area_name[0]->name; 
					   
					 ?>

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
							{{-- <form action="{{ route('trainees.destroy', ['id' => $trainee->id]) }}" method="POST">
								{{csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger">Bin</button>
							</form> --}}

                            <form action="{{route('trainees.destroy', ['id' => $trainee->id])}}" method="POST">
                    
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
	<div class="text-center">{{ $trainees->links() }}</div>
	@endif
	

@endsection 

