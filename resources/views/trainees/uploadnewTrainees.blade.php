<!DOCTYPE html>
<html>
 <head>
  <title>Import Excel File in Laravel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br />
  
  <div class="container">
   <h3 align="center">Import Excel Trainee File </h3>
    <br />
   @if(count($errors) > 0)
    <div class="alert alert-danger">
     Upload Validation Error<br><br>
     <ul>
      @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
     </ul>
    </div>
   @endif

   @if($message = Session::get('success'))
   <strong>{{ $message }}</strong>
   <div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
           <strong>{{ $message }}</strong>
   </div>
   @endif
   {{-- <a ="{{ route('download','TraineeTemplate.xlsx') }}" type="button" class="btn btn-primary download" > Download Trainee Excel Template  </a> --}}
   
   {{-- <a onclick=“window.open(‘TraineeTemplate.xlsx) class="btn btn-large pull-right"><i class="icon-download-alt"> </i> Download Trainee Excel Template </a>
 --}}

        <p><center><a href="/TraineeTemplate.xlsx" download>Download Trainee Excel Template </a></center></p>
   <form method="post" enctype="multipart/form-data" action="{{ url('/trainees/uploadnewTrainees/import') }}">
    {{ csrf_field() }}
    <div class="form-group">
     <table class="table">
      <tr>
        
       <td width="40%" align="right"><label>Select File for Upload</label></td>
       <td width="30">
        <input type="file" name="select_file" />
       </td>
       <td width="30%" align="left">
        <input type="submit" name="upload" class="btn btn-primary" value="Upload">
       </td>
      </tr>
      <tr>
       <td width="40%" align="right"></td>
       <td width="30"><span class="text-muted">.xls, .xslx</span></td>
       <td width="30%" align="left"></td>
      </tr>
     </table>
    </div>
   </form>
   
   <br />
   <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title">Trainee Data</h3>
    </div>
    <div class="panel-body">
     <div class="table-responsive">
      <table class="table table-bordered table-striped">
       <tr>
        <th>Trainee's Name</th>
        <th>Date Of Birth</th>
        <th>Identification Number</th>
        <th>Area</th>
        <th>Address</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Major</th>
        <th>Email</th>
       </tr>
       @foreach($data as $row)
       <tr>
        <td>{{ $row->name }}</td>
        <td>{{ $row->dob }}</td>
        <td>{{ $row->identification_no }}</td>
        <td>{{ $row->area_id }}</td>
        <td>{{ $row->address }}</td>
        <td>{{ $row->gender }}</td>
        <td>{{ $row->phone_no }}</td>
        <td>{{ $row->major }}</td>
        <td>{{ $row->email }}</td>



       </tr>
       @endforeach
      </table>
     </div>
    </div>
   </div>
  </div>
 </body>
</html>