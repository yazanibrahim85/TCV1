<!DOCTYPE html>
<html>
 <head>
  <title>Export PDF</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center">Export PDF</h3><br />
   
   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Training Data</h4>
    </div>
    <div class="col-md-5" align="right">
        <a href="{{url("/dynamic_pdfff/pdf/{$training_data[0]->id}")}}" target="_blank" > Convert into PDF </a>
        {{--  <a href="{{ route('dynamic_pdf.pdf', ['id' => $trainee_data[0]->id,'course_id' => $course_data[0]->id]) }}" class="btn btn-danger">Convert into PDF</a>  --}}
     {{-- <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-danger">Convert into PDF</a> --}}
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table table-striped table-bordered">
     <thead>
      <tr>
       <th>Training Location</th>
       <th>Training Expiration Date</th>
      </tr>
     </thead>
     <tbody>
     @foreach($training_data as $training)
      <tr>
       <td>{{ $training->location }}</td>
       <td>{{ $training->expiration_date }}</td>
      </tr>
     @endforeach
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>