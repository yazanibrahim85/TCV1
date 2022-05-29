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

                    <form>
                      <!-- style="text-align: center; border: 1px solid" -->
                        <div class="form-group">
                        <a href="{{ url('/reports/trainerReport') }}" class="btn btn-primary btn-lg btn-block">Trainers Report</a>
                        <br>
                        </div>
                      <div class="form-group">
                        <a href="{{ url('/reports/traineeReport') }}" class="btn btn-primary btn-lg btn-block">Trainees Report</a>
                      <br>
                      </div>
                      <div class="form-group">
                        <a href="{{ url('/reports/trainingReport') }}" class="btn btn-primary btn-lg btn-block">Trainings Report</a>
                        <br>
                      </div>

                      

                      <div class="form-group">
                        <a href="{{ url('/reports/aggReports') }}" class="btn btn-primary btn-lg btn-block">Aggregation Reports</a>
                        <br>
                      </div>



                    </form>
                </div>
           </div>
        </div>
    </div>
</div>

@endsection
