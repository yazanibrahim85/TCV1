

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

                    
                    <form action="/reports/searchTraining" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-row">

                           

                            <div class="form-group col-md-1"></div>
                           

                                <div class="form-group col-md-2" >
                                        <label for="courseName" class="p1">Course Name: </label>
                                </div>
                                <div class="form-group col-md-3" >
                                    <select name="courseName" id="courseName" class="p1">
                                        <option value="" class="form-control">Choose Course Name ...</option>
                                
                                    @foreach ($courses as $course)
                                    {
                                    <option value="{{$course->id}}" class="form-control">{{$course->name_ar}}</option>
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

                                            <option value="" class="form-control">Choose Area ...</option>
                                            @for ($x = 0; $x < count($area); $x++) 
                                            <option value="{{$area[$x]->id}}" class="form-control">{{$area[$x]->name}}</option>
                                            @endfor
                                    
                                    </select>	

                            
                                </div>
                            </div>

                            <div class="form-row">
                            <div class="form-group col-md-1"></div>
                           

                                <div class="form-group col-md-2" >
                                <label for="TDate" class="p1">Training Date: </label>
                                </div>
                                <div class="form-group col-md-3" >
                               <select name="TDate" id="TDate" class="p1">
                                <option value="" class="form-control">Choose Training Date ...</option>
                                <option value="A" class="form-control">In Last One Month From Now</option>
                                <option value="B" class="form-control">In Last Two Months From Now</option>
                                <option value="C" class="form-control">In Last Twelve Months From Now</option>
                               </select>
                            </div>	

                            </div>


                            <div class="form-row">
                            <div class="form-group col-md-1"></div>
                           

                                <div class="form-group col-md-2" >

                                <label for="EDate" class="p1">Expiration Date: </label>
                                </div>
                                <div class="form-group col-md-3" >

                               <select name="EDate" id="EDate" class="p1">
                                <option value="" class="form-control">Choose Expiration Date ...</option>
                                <option value="A" class="form-control">In Last One Month From Now</option>
                                <option value="B" class="form-control">In Last Two Months From Now</option>
                                <option value="C" class="form-control">In Last Twelve Months From Now</option>
                               </select>
                                </div>
                            </div>	





                        
                        <div class="form-row"> 
                            <div class="form-group col-md-1"></div>
                       <p> <button type="submit" class="btn btn-primary btn-lg p1">Search</button></p>
                        </div>
                    </form>
                      


                </div>
            </div>
        </div>
    </div>



@endsection