@extends('layouts.master')


@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">New Trainee</h1>
	</div>
	
	<form action="/trainees" method="POST" >
			{{ csrf_field() }}
		
		<div class="form-group col-md-4">
			<label for="name">Name: </label>
			<input type="text" name="name" class="form-control">		
		</div>
	
		<div class="form-group col-md-3">
			<label for="dob">Date of Birth: </label>
			<input type="number" name="dob" min="1900" max="2099" step="1" value="2000" class="form-control">	
			
		</div>
		
		<div class="form-group col-md-3">
			<label for="identification_no">Identification Number: </label>
			<input type="text" name="identification_no" class="form-control">		
		</div>
		
		
		<div class="form-group col-md-3">
			<label for="area_id">Area: </label>
			

			<?php
					
			$area_name=DB::select('select name from areas');
		    // dd($area_name[0]);
			 //dd(count($area_name));
			//dd($area_name::all()->count());
		 	// $area_name= $area_name[0]->name;
			// {{$area_namee[0]->name}}
			// {{$area_namee[0]->name}}
	 		 ?>

				<select name="area_id" id="area_id">

				
						@for ($x = 0; $x < count($area_name); $x++) 
						<option value="{{$area_name[$x]->name}}" class="form-control">{{$area_name[$x]->name}}</option>
						@endfor
				
	   			</select>	

		
		</div>
		
		<div class="form-group col-md-3">
			<label for="address">Address: </label>
			<input type="text" name="address" class="form-control">		
		</div>
		
		<div class="form-group col-md-3">
			<label for="gender">Gender: </label>
			
			<select name="gender" id="gender">

				<option value="Male" class="form-control">Male</option>
				<option value="Female" class="form-control">Female</option>
		
		   </select>		
		</div>
		
		<div class="form-group col-md-3">
			<label for="phone_no">Phone Number: </label>
			<input type="text" name="phone_no" class="form-control">		
		</div>	

        <div class="form-group col-md-3">
			<label for="major">Major: </label>
			<input type="text" name="major" class="form-control">		
		</div>	

        <div class="form-group col-md-3">
			<label for="Email">Email: </label>
			<input type="email" name="email" class="form-control">		
		</div>		
				
		{{-- <div class="form-group col-md-6">
			<label for="role">Select a Role</label>
			<select name="role_id"  cols="5" rows="5" class="form-control">
				@foreach($roles as $role)
					<option value="{{ $role->id}}">{{ $role->name }}</option>
				@endforeach
			</select>
		</div> --}}
		
		{{-- <div class="form-group col-md-6">
			<label for="full_time">Position:</label>
			<select name="full_time" id="full_time" class="form-control">
				<option value="1">Full-Time</option>
				<option value="0">Part-Time</option>					
			</select>
		</div> --}}
		<div class="form-group col-md-2">
            <div class="text-center">
                <button class="btn btn-success" type="submit" >Create</button>
            </div>
        </div>	


	</form>
	


@endsection