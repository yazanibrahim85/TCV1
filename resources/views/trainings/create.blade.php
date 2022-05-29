@extends('layouts.master')
<link href="{{ asset('/css/formcss.css') }}" rel="stylesheet"> 
<script src="{{asset('js/jquery.js')}}"></script>

@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">New Training</h1>
	</div>
	
   
{{-- 	@php
     foreach ($courses as $course)
	  {
		echo $course->name_ar;
		echo "<br>";
	  }
	
	@endphp --}}

	<form action="/trainings" method="POST" >
			{{ csrf_field() }}

			<div class="form-group col-md-6">
				<label for="course_id">Course Name: </label>
				<select name="course_id" id="course_id">
					{{-- <option value="22222" class="form-control"></option> --}}
					{{-- <option value="volvo">Volvo</option>  --}}
					
					{{-- @foreach($courses as $course) --}}
					{{-- <option value="{{$course->name_ar}}" class="form-control">33333</option> --}}
					{{-- {{$course->name_ar}} --}}
					{{-- 	@foreach  --}}

						
     						@foreach ($courses as $course)
	 						 {
								<option value="{{$course->name_ar}}" class="form-control">{{$course->name_ar}}</option>
							
							 }
							 @endforeach
	
					

				{{-- 	<option value="{{$courses->name_ar}}" class="form-control"> --}}

		{{-- @foreach

		@endforeach --}}
				</select>
		</div>

		<div class="form-group col-md-6">
			<label for="participants_name[]">Participant Name: </label>
			

				<table id="tbl">
					<tr>
						<td>
							
							<select name="participants_name[]" 	>
								@foreach ($trainees as $trainee)
								 {
								   <option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>
							   
								}
								@endforeach
	   						</select>	
						</td>
						<td>
							<button type="button" id="add">Add More</button>
						</td>
					</tr>
				</table>

		</div>

<script>
    $("document").ready(function(){
        
        $("#add").click(function(){
            $("#tbl").append('<tr><td><select name="participants_name[]" id="participants_name[]">@foreach ($trainees as $trainee){<option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>}@endforeach</select></td><td><button type="button" class="del1">Delete</button></td></tr> ');
			var count = $("#participants_no").val();
			count =parseInt(count)+1;
			$('input[id=participants_no]').val(count);
        });

		$("#add1").click(function(){
            $("#tbl1").append('<tr><td><select name="Trainers_name[]" id="Trainers_name[]">@foreach ($trainers as $trainer){<option value="{{$trainer->name}}" class="form-control">{{$trainer->name}}</option>}@endforeach</select></td><td><button type="button" class="del">Delete</button></td></tr>');
        });
        
        $(document).on('click','.del',function(){
                 $(this).closest("tr").remove();  
        });

		$(document).on('click','.del1',function(){
                 $(this).closest("tr").remove();
				 var count = $("#participants_no").val();
				 count =parseInt(count)-1;
				$('input[id=participants_no]').val(count);  
        });

     /*    $("#submit").click(function(){
            $.ajax({
                url:"save.php",
                type:"post",
                data:$("#frm").serialize(),
                success:function(data){
                    $("p").html(data);
                    $("#frm")[0].reset();
                }
            });
        }); */
    });
</script>
	

		<div class="form-group col-md-6">
			<label for="Trainers_name[]">Trainer Name: </label>
			

				<table id="tbl1">
					<tr>
						<td>
							
							<select name="Trainers_name[]" id="Trainers_name[]">
								@foreach ($trainers as $trainer)
								 {
								   <option value="{{$trainer->name}}" class="form-control">{{$trainer->name}}</option>
							   
								}
								@endforeach
	   						</select>	
						</td>
						<td>
							<button type="button" id="add1">Add More</button>
						</td>
					</tr>
				</table>		
		</div>


		
		<div class="form-group col-md-1">
			<label for="participants_no">Participants Number: </label>
			<input type="text" id="participants_no" name="participants_no" value="1" class="form-control">		
		</div>

		<div class="form-group col-md-1">
			<label for="training_hours">Training Hours: </label>
			<input type="number" id="training_hours" name="training_hours" value="40" class="form-control">		
		</div>

		<div class="form-group col-md-3">
			<label for="course_begin_date">Training Begin Date: </label>
			<input type="date" name="course_begin_date" class="form-control">		
		</div>	
		

		<div class="form-group col-md-3">
			<label for="course_end_date">Training End Date: </label>
			<input type="date" name="course_end_date" class="form-control">		
		</div>	
		
		
		<div class="form-group col-md-3">
			<label for="expiration_date">Certificate Validity Till: </label>
			<input type="date" name="expiration_date" class="form-control">		
		</div>	

		<div class="form-group col-md-3">
			<label for="sponsored_by">Sponsored By: </label>
			<input type="text" name="sponsored_by" class="form-control">		
		</div>	

		<div class="form-group col-md-3">
			<label for="beneficiary">Beneficiary: </label>
			<input type="text" name="beneficiary" class="form-control">		
		</div>	



		
		<div class="form-group col-md-6">
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
		
        <div class="form-group col-md-4">
			<label for="location">Location: </label>
			<input type="text" name="location" class="form-control">		
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
                <button class="btn btn-primary btn-lg" type="submit" >Create</button>
            </div>
        </div>	


	</form>
	


@endsection