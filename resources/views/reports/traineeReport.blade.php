
<style type="text/css">
    @font-face {
        font-family: Muli-Bold;
        src: url('{{ public_path('resources/fonts/Raleway-Thin.ttf') }}');
    }

    .p1 {
        font-family: "Times New Roman", Times, serif;
        font-size: 18px;
        }

    .p2 {
        font-family: Arial, Helvetica, sans-serif;
        }

    .p3 {
        font-family: "Lucida Console", "Courier New", monospace;
        font-size: 18px;
        }

</style>

@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><strong>Reports</strong></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    </div>

                    
                    <form action="/reports/searchTrainee" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-row">

                           

                            
                            <div class="form-group col-md-1"></div>
                           

                                <div class="form-group col-md-2" >
                                                <label for="Traineename" class="p1">Trainee Name: </label>
                                </div>
                                <div class="form-group col-md-3" >
                                            <select name="Traineename" id="Traineename" class="p1">
                                                <option value="" class="form-control" class="p1">Choose Trainer Name ...</option>
                                        
                                            @foreach ($trainees as $trainee)
                                            {
                                            <option value="{{$trainee->name}}" class="form-control">{{$trainee->name}}</option>
                                        
                                            }
                                            @endforeach
                                            </select>
                                </div>
                            
                        </div>

                        <div class="form-row">

                           
                            
                            <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-2" >
                                <label for="area_id" class="p1">Area:    </label>
                            </div>
                            <div class="form-group col-md-3" >
                                <?php
                                        
                                $area=DB::select('select * from areas');
                          
                                ?>

                                    <select name="area_id" id="area_id" class="p1">

                                            <option value="" class="form-control" >Choose Area ...</option>
                                            @for ($x = 0; $x < count($area); $x++) 
                                            <option value="{{$area[$x]->id}}" class="form-control">{{$area[$x]->name}}</option>
                                            @endfor
                                    
                                    </select>	

                            
                            </div>
                        </div>

                        <div class="form-row">

                            
                            <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-2" >
                                <label for="age"  class="p1">Age: </label>
                            </div>
                            <div class="form-group col-md-3" >
                               <select name="age" id="age"  class="p1">
                                <option value="" class="form-control"  class="p1">Choose Age Range ...</option>
                                <option value=">'2000-01-01'" class="form-control">Younger Than Birthdate 2000-01-01 ex:2010-01-01</option>
                                <option value="<='2000-01-01'" class="form-control">Older Than Birthdate 2000-01-01 ex:1990-01-01</option>
                               
                               </select>
                            </div>	

                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-2" >

                                <label for="gender"  class="p1">Gender: </label>
                            </div>
                            <div class="form-group col-md-3" >
                               <select name="gender" id="gender" class="p1">
                                <option value="" class="form-control">Choose Gender ...</option>
                                <option value="Male" class="form-control">Male</option>
                                <option value="Female" class="form-control">Female</option>
                              
                               </select>
                            </div>	
                        </div>



                        <div class="form-row"> 
                            <div class="form-group col-md-1"></div>
                        <p><button type="submit" class="btn btn-primary btn-lg p1">Search</button><p>
                        </div>
                    </form>
                      


                </div>
            </div>
        </div>
    </div>


</div>
@endsection
