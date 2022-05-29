@extends('layouts.master')


@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">Edit Course</h1>
	</div>
	
	<form action="{{ '/courses/' . $courses->id}}" method="POST" >
			{{ csrf_field() }}
            @method('PUT')

		<div class="form-group col-md-6">
			<label for="name_ar">Course Name In Arabic: </label>
			<input type="text" name="name_ar" class="form-control" value="{{$courses->name_ar}}">		
		</div>

        <div class="form-group col-md-6">
			<label for="name_en">Course Name In English: </label>
			<input type="text" name="name_en" class="form-control" value="{{$courses->name_en}}">		
		</div>

		<div class="form-group col-md-4">
			<label for="hours">Course Training Hours: </label>
			<input type="text" name="hours" class="form-control" value="{{$courses->hours}}">		
		</div>

        
		<div class="form-group col-md-2">
            <div class="text-center">
                <button class="btn btn-success" type="submit" >Update</button>
            </div>
        </div>	


	</form>
	


@endsection