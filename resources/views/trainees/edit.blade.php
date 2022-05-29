@extends('layouts.master')


@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">Edit Trainee</h1>
	</div>
	
	<form action="{{ '/trainees/' . $trainees->id}}" method="POST" >
			{{ csrf_field() }}
            @method('PUT')

		<div class="form-group col-md-6">
			<label for="name">Name: </label>
			<input type="text" name="name" class="form-control" value="{{$trainees->name}}">		
		</div>
	
		<div class="form-group col-md-6">
			<label for="dob">Date of Birth: </label>
			<input type="date" name="dob" class="form-control" value="{{$trainees->dob}}">		
		</div>
		
		<div class="form-group col-md-12">
			<label for="identification_no">Identification Number: </label>
			<input type="text" name="identification_no" class="form-control" value="{{$trainees->identification_no}}">		
		</div>
		
		<div class="form-group col-md-6">
			<label for="address">Address: </label>
			<input type="text" name="address" class="form-control" value="{{$trainees->address}}">		
		</div>
		
		<div class="form-group col-md-4">
			<label for="gender">Gender: </label>
			<input type="text" name="gender" class="form-control" value="{{$trainees->gender}}">		
		</div>
		
		<div class="form-group col-md-2">
			<label for="phone_no">Phone Number: </label>
			<input type="text" name="phone_no" class="form-control" value="{{$trainees->phone_no}}">		
		</div>	

        <div class="form-group col-md-2">
			<label for="major">major: </label>
			<input type="text" name="major" class="form-control" value="{{$trainees->major}}">		
		</div>	

        <div class="form-group col-md-3">
			<label for="Email">Email: </label>
			<input type="email" name="email" class="form-control" value="{{$trainees->email}}">		
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
                <button class="btn btn-success" type="submit" >Update</button>
            </div>
        </div>	


	</form>
	


@endsection