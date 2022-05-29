@extends('layouts.master')


@section('content')

	<hr>	
		<h1 class="text-center">Courses</h1>	
	<hr> 
	
	<a href="{{ route('courses.create') }}" class="btn btn-primary">Create</a>
	{{-- <a href="{{ route('trainees.bin') }}" class="btn btn-danger">Recycle Bin</a> --}}
	
	<br>
	<br>
	<table class= "table table-hover" id="filterTable">
		<thead>					
			<th>Course Name In Arabic</th>
			<th>Course Name In English</th>
			<th>Course Training Hours</th>
		</thead>		
			
		<tbody>
			@if($courses->count()> 0)
				@foreach($courses as $course)
					<tr>								
						<td><a href="{{ route('courses.show', ['id' => $course->id]) }}">{{ $course->name_ar }}</a></td>
                        <td>{{ $course->name_en }}</td>
						<td>{{ $course->hours }}</td>
						<td>
							<a href="{{ route('courses.edit', ['id' => $course->id]) }}" class="btn btn-info">Edit</a>
						</td>
						<td>
							{{-- <form action="{{ route('trainees.destroy', ['id' => $trainee->id]) }}" method="POST">
								{{csrf_field() }}
								{{method_field('DELETE')}}
								<button class="btn btn-danger">Bin</button>
							</form> --}}

                            <form action="{{route('courses.destroy', ['id' => $course->id])}}" method="POST">
                    
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
	<div class="text-center">{{ $courses->links() }}</div>
@endsection 

