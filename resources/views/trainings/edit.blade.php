@extends('layouts.master')
<link href="{{ asset('/css/formcss.css') }}" rel="stylesheet"> 
<script src="{{asset('js/jquery.js')}}"></script>

@section('content')
	<div class="col-lg-12">
		<h1 class="page-header">Edit Training</h1>
	</div>
	
	<form action="{{ '/trainings/' . $trainings->id}}" method="POST" >
			{{ csrf_field() }}
            @method('PUT')

			<?php
			$courses_id=DB::select('select courses.id,courses.name_ar from courses,trainings where trainings.course_id=courses.id and trainings.id =?', [$trainings->id]);
			//dd($courses_id[0]);
        	$course_id=$courses_id[0]->id;
			//dd($course_id);
			$courses_name=$courses_id[0]->name_ar;

		 	$SelectedtraineesName=DB::select('select trainees.name from trainees,trainings,courses_trainees where trainings.id=courses_trainees.training_id and courses_trainees.trainee_id=trainees.id and trainings.id =?', [$trainings->id]);
		
			for($countofSelectedtraineesID=0;$countofSelectedtraineesID<count($SelectedtraineesName);$countofSelectedtraineesID++)
			{
			$SelectedtraineesName[$countofSelectedtraineesID]=$SelectedtraineesName[$countofSelectedtraineesID]->name;
			}
			
			$SelectedtrainersName=DB::select('select trainers.name from trainers,trainings,courses_trainers where trainings.id=courses_trainers.training_id and courses_trainers.trainer_id=trainers.id and trainings.id =?', [$trainings->id]);
		
			for($countofSelectedtrainersID=0;$countofSelectedtrainersID<count($SelectedtrainersName);$countofSelectedtrainersID++)
			{
			$SelectedtrainersName[$countofSelectedtrainersID]=$SelectedtrainersName[$countofSelectedtrainersID]->name;
			}
			
		
			/* 	$courses_id=DB::select('select courses.id,courses.name_ar from courses,trainings where trainings.course_id=courses.id and trainings.id =?', [$trainings->id]);
			//dd($courses_id[0]);
        	$course_id=$courses_id[0]->id;
			$courses_name=$courses_id[0]->name_ar;
 			*/

			$trainings_data=DB::select('select * from trainings where trainings.id =?', [$trainings->id]);
        	$training_data_partno=$trainings_data[0]->participants_no;
			$training_data_training_hours=$trainings_data[0]->training_hours;
			$training_data_course_begin_date=$trainings_data[0]->course_begin_date;
			$training_data_course_end_date=$trainings_data[0]->course_end_date;
			$training_data_expiredate=$trainings_data[0]->expiration_date;
			$training_data_sponsored_by=$trainings_data[0]->sponsored_by;
			$training_data_beneficiary=$trainings_data[0]->beneficiary;
			$training_data_area_id=$trainings_data[0]->area_id;
			$training_data_location=$trainings_data[0]->location;
			
			
			?>
		<div class="form-group col-md-2">
			<input type="hidden" name="hidtext" id="hidtext" value="<?php echo count($SelectedtraineesName); ?>" class="form-control" >		
		</div>	
		<div class="form-group col-md-2">
			<input type="hidden" name="hidtext1" id="hidtext1" value="<?php echo count($SelectedtrainersName); ?>" class="form-control" >		
		</div>	

		<script>
		var traineeCountval = $("#hidtext").val();
		var trainerCountval = $("#hidtext1").val();
		//alert(traineeCountval);
		</script>
	
			<div class="form-group col-md-6">
				<label for="course_id">Course Name: </label>
				<select name="course_id" id="course_id">
		
					
     					 	@foreach ($courses as $course)
	 						 {
								  <?php
								  //retreive all courses names and where the selected course name related to this training choose it
								$nameofcourse=$course->name_ar;
									?>
								  @if ($nameofcourse==$courses_name)
								{
								<option value="{{$course->name_ar}}" class="form-control" selected="selected">{{$course->name_ar}}</option>
								}@else{
									<option value="{{$course->name_ar}}" class="form-control">{{$course->name_ar}}</option>	
								}@endif
									
								
							}
							 @endforeach 
	
				
				</select>
		</div>

		<div class="form-group col-md-6">
			<label for="participants_name[]">Participant Name: </label>
			

				<table id="tbl">
					<tr>
						<td>
							<?php
						//dd(count($SelectedtraineesName));
						$countSelectedtraineesName=count($SelectedtraineesName);
							?>
							
								
								 
									 <?php
									 
									if ($countSelectedtraineesName==1)
									{
										?>
										
										<select name="participants_name[]">
										<option value="{{$SelectedtraineesName[0]}}" class="form-control"><?php echo $SelectedtraineesName[0]; ?></option>	
										</select>
										
									<?php
									}elseif ($countSelectedtraineesName>1)
									{
										?>
										@for($i = 0; $i < $countSelectedtraineesName; $i++)
										<script>
										$("#tbl").append('<tr><td><select name="participants_name[]" id="participants_name[]"><option value="{{$SelectedtraineesName[$i]}}" class="form-control">{{$SelectedtraineesName[$i]}}</option>@foreach($trainees as $trainee)<option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>@endforeach</select></td><td><button type="button" class="del">Delete</button></td></tr>');
										</script>
										@endfor
									<?php
									}else
									{?>
										@foreach ($trainees as $trainee)
										<select name="participants_name[]">
										<option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>	
										</select>
										@endforeach
									<?php
									}?>
								
								  
	
							
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
					$("#tbl").append('<tr><td><select name="participants_name[]" id="participants_name[]">@foreach ($trainees as $trainee){<option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>}@endforeach</select></td><td><button type="button" class="del">Delete</button></td></tr>');
				});

				$("#add1").click(function(){
					$("#tbl1").append('<tr><td><select name="Trainers_name[]" id="Trainers_name[]">@foreach ($trainers as $trainer){<option value="{{$trainer->name}}" class="form-control">{{$trainer->name}}</option>}@endforeach</select></td><td><button type="button" class="del">Delete</button></td></tr>');
				});
				
				$(document).on('click','.del',function(){
						$(this).closest("tr").remove();  
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
							<?php
							//dd(count($SelectedtraineesName));
							$countSelectedtrainersName=count($SelectedtrainersName);
								?>
								
									 
										 <?php
										 
										if ($countSelectedtrainersName==1)
										{
											?>
										
									
												<select name="Trainers_name[]" id="Trainers_name[]">
												<option value="{{$SelectedtrainersName[0]}}" class="form-control"><?php echo $SelectedtrainersName[0]; ?></option>	
												</select>

									<?php
									}elseif ($countSelectedtrainersName>1)
									{
										?>
										@for($i = 0; $i < $countSelectedtrainersName; $i++)
										<script>
										$("#tbl1").append('<tr><td><select name="Trainers_name[]" id="Trainers_name[]"><option value="{{$SelectedtrainersName[$i]}}" class="form-control">{{$SelectedtrainersName[$i]}}</option>@foreach($trainers as $trainer)<option value="{{$trainer->name}}" class="form-control">{{$trainer->name}}</option>@endforeach</select></td><td><button type="button" class="del">Delete</button></td></tr>');
										</script>
										@endfor
									
									<?php
									}else
									{?>
									@foreach ($trainers as $trainer)
									<select name="Trainers_name[]" id="Trainers_name[]">
										<option value="{{$trainer->name}}" class="form-control">{{$trainer->name}}</option>	
									</select>
									@endforeach
									<?php
									}?>
								
								  
								
						</td>
						<td>
							<button type="button" id="add1">Add More</button>
						</td>
					</tr>
				</table>		
		</div>


		
		<div class="form-group col-md-2">
			<label for="participants_no">Participants Number: </label>
			<input type="text" name="participants_no" class="form-control" value="{{$training_data_partno}}">		
		</div>

		<div class="form-group col-md-1">
			<label for="training_hours">Training Hours: </label>
			<input type="number" id="training_hours" name="training_hours" value="{{$training_data_training_hours}}" class="form-control">		
		</div>

		<div class="form-group col-md-3">
			<label for="course_begin_date">Course Begin Date: </label>
			<input type="date" name="course_begin_date" class="form-control" value="{{$training_data_course_begin_date}}">		
		</div>	

		<div class="form-group col-md-3">
			<label for="course_end_date">Course End Date: </label>
			<input type="date" name="course_end_date" class="form-control" value="{{$training_data_course_end_date}}">		
		</div>	
		
		<div class="form-group col-md-3">
			<label for="expiration_date">Expiration Date: </label>
			<input type="date" name="expiration_date" class="form-control" value="{{$training_data_expiredate}}">		
		</div>	

		<div class="form-group col-md-3">
			<label for="sponsored_by">Sponsored By: </label>
			<input type="text" name="sponsored_by" class="form-control" value="{{$training_data_sponsored_by}}">		
		</div>	

		<div class="form-group col-md-4">
			<label for="beneficiary">Beneficiary: </label>
			<input type="text" name="beneficiary" class="form-control" value="{{$training_data_beneficiary}}">		
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
			<input type="text" name="location" class="form-control" value="{{$training_data_location}}">		
		</div>	

   
		
		<div class="form-group col-md-2">
            <div class="text-center">
                <button class="btn btn-success" type="submit" >Update</button>
            </div>
        </div>	


	</form>
	


@endsection