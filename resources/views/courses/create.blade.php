@extends('layouts.master')


@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">New Course</h1>
	</div>
	
	<form action="/courses" method="POST" >
			{{ csrf_field() }}
		
		<div class="form-group col-md-6">
			<label for="name_ar">Course Name In Arabic: </label>
			<input type="text" name="name_ar" class="form-control">		
		</div>

        <div class="form-group col-md-6">
			<label for="name_en">Course English Name: </label>
			<input type="text" name="name_en" class="form-control">		
		</div>

		<div class="form-group col-md-4">
			<label for="hours">Hours: </label>
			<input type="text" name="hours" class="form-control">		
		</div>

		
		<div class="form-group col-md-2">
            <div class="text-center">
                <button class="btn btn-success" type="submit" >Create</button>
            </div>
        </div>	


	</form>
	


@endsection