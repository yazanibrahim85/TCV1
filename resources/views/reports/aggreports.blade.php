
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

                    <div class="form-group">
                        <a href="{{ url('/reports/AggReport') }}" class="btn btn-primary btn-lg btn-block">Number of Trainings,Trainees Report</a>
                        <br>
                      </div>

                      <div class="form-group">
                        <a href="{{ url('/reports/AggReport2') }}" class="btn btn-primary btn-lg btn-block">Download Aggregation Report,Number of Male/Female in each Training</a>
                        <br>
                      </div>


                     
                     
                      
                    
                    <form action="/reports/AggReport3" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-row">

                           

                            <div class="form-group col-md-2"></div>
                           
                            <div class="form-row">
                                         <div class="form-group col-md-1"></div>
                           

                                         
                                    <label for="TDate" class="p1">Training Date From : </label>
                                    
                                    <div class="form-group col-md-3" >
                                    <input type="date" name="TDate" id="TDate" class="p1" onchange="myFunction2()">
                                    </div>	

                            </div>

                        </div>
                            <div class="form-row">
                                 <div class="form-group col-md-2"></div>
                           
                                
                                    <label for="EDate" class="p1">   &nbsp;&nbsp;&nbsp;&nbsp; Training Date To : &nbsp;&nbsp;&nbsp;&nbsp;  </label>
                              
                                    <div class="form-group col-md-3" >

                                        <input type="date" name="EDate" id="EDate" class="p1" onchange="myFunction1()">
                                    </div>
                            </div>	

                            <script>
                                function myFunction1() 
                                        {
                                            var number=document.getElementById("EDate").value;  
                                            var number2=document.getElementById("TDate").value;
                                               // alert(number);  

                                        if(number && number2)// !== null and number2 !== null) )
                                        {
                                            document.getElementById("btn").disabled = false;
                                            //alert('YES');
                                        }
                                        }
                                function myFunction2() 
                                        {
                                        
                                            var number=document.getElementById("EDate").value;  
                                            var number2=document.getElementById("TDate").value;
                                               // alert(number);  

                                        if(number && number2) //!== null and number2 !== null) )
                                        {
                                            document.getElementById("btn").disabled = false;
                                            //alert('YES');
                                        }


                                        }
                            </script>



                        
                        <div class="form-row" > 
                            <div class="form-group col-md-1"></div>
                            <div class="form-group col-md-12" ><p>  <button type="submit" class="btn btn-primary btn-lg btn-block" id='btn' disabled >Download Aggregation Report Based On Date</button></p></div>
                        </div>
                    </form>


           


                      


                </div>
            </div>
        </div>
    </div>


</div>
@endsection
