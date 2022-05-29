<?php

namespace App\Http\Controllers;
use App\Imports\TraineeImport;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Excel;
use App\Http\Controllers\Controller;
use App\Models\Trainee;
use App\Training;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Exports\TraineesExport;
use App\Exports\TrainersExport;
use App\Exports\TrainingsExport;
use App\Exports\AggExport;
use App\Exports\AggExport2;
use App\Exports\AggExport3;

use Session;

class uploadnewTraineesController extends Controller
{
    
    function index()
    {
     $data = DB::table('trainees')->orderBy('id', 'DESC')->get();
     return view('trainees.uploadnewTrainees', compact('data'));
     

    }

  public function export() 
    {
        return Excel::download(new TraineesExport, 'Trainees.xlsx');
    }

    public function exportTrainers() 
    {
        return Excel::download(new TrainersExport, 'Trainers.xlsx');
    }

    public function exportTrainings() 
    {
       

        return Excel::download(new TrainingsExport, 'Trainings.xlsx');
    }

    public function exportAggregation() 
    {
        $courses = DB::table('courses');
        $trainings=DB::table('trainings');
        $trainees=DB::table('trainees');
        $areas=DB::table('areas');
        $courses_trainee = DB::table('courses_trainees as CT')
            ->leftJoinSub($courses, 'C', 'C.id','=','CT.course_id')
            ->LeftJoinSub($trainees,'Tr','Tr.id','=','CT.trainee_id')
            ->LeftJoinSub($trainings,'T','T.course_id','=','C.id')
            ->leftJoinSub($areas,'A','A.id','=','T.area_id')
            ->select(
                'T.id',
                'C.name_ar',
                'C.name_en',
                DB::raw('count(Tr.gender) as gender1'),
                'Tr.gender',
                'T.course_begin_date',
                'T.course_end_date',
                'T.sponsored_by',
                'T.beneficiary',
                'A.name'
               )
            
            ->groupBy('Tr.gender','C.name_ar')
            ->orderBy('C.name_ar', 'desc')
            //->orderBy('C.id', 'ASC')
            ->get();

            foreach($courses_trainee as $ct)
            {
              $cc=$ct->id;
              if (!empty($cc)){
                                    $training=Training::find($cc);
                                    if (!empty($training->id))
                                    {
                                        if ($ct->gender == 'Male')
                                        {
                                        $training->Male = $ct->gender1;
                                        }elseif ($ct->gender == 'Female')
                                        {
                                        $training->Female = $ct->gender1;
                                        }
                                    $training->save();
                                    }
                              }
            }
            

        return Excel::download(new AggExport, 'AggregationReport.xlsx');
    }

    public function exportAggregation2() 
    {

        $courses = DB::table('courses');
        $trainings=DB::table('trainings');
        $trainees=DB::table('trainees');
        $areas=DB::table('areas');
        $courses_trainee = DB::table('courses_trainees as CT')
            ->leftJoinSub($courses, 'C', 'C.id','=','CT.course_id')
            ->LeftJoinSub($trainees,'Tr','Tr.id','=','CT.trainee_id')
            ->LeftJoinSub($trainings,'T','T.course_id','=','C.id')
            ->leftJoinSub($areas,'A','A.id','=','T.area_id')
            ->select(
                'T.id',
                'C.name_ar',
                'C.name_en',
                DB::raw('count(Tr.gender) as gender1'),
                'Tr.gender',
                'T.course_begin_date',
                'T.course_end_date',
                'T.sponsored_by',
                'T.beneficiary',
                'A.name'
               )
            
            ->groupBy('Tr.gender','C.name_ar')
            ->orderBy('C.name_ar', 'desc')
            //->orderBy('C.id', 'ASC')
            ->get();

            foreach($courses_trainee as $ct)
            {
              $cc=$ct->id;
              if (!empty($cc)){
                                    $training=Training::find($cc);
                                    if (!empty($training->id))
                                    {
                                        if ($ct->gender == 'Male')
                                        {
                                        $training->Male = $ct->gender1;
                                        }elseif ($ct->gender == 'Female')
                                        {
                                        $training->Female = $ct->gender1;
                                        }
                                    $training->save();
                                    }
                              }
            }

        return Excel::download(new AggExport2, 'AggregationReport2.xlsx');
    }

    public function exportAggregation3(Request $request) 
    {
        $TDate=$request->TDate;
        $EDate=$request->EDate;

        $courses = DB::table('courses');
        $trainings=DB::table('trainings');
        $trainees=DB::table('trainees');
        $areas=DB::table('areas');
        $courses_trainee = DB::table('courses_trainees as CT')
            ->leftJoinSub($courses, 'C', 'C.id','=','CT.course_id')
            ->LeftJoinSub($trainees,'Tr','Tr.id','=','CT.trainee_id')
            ->LeftJoinSub($trainings,'T','T.course_id','=','C.id')
            ->leftJoinSub($areas,'A','A.id','=','T.area_id')
            ->select(
                'T.id',
                'C.name_ar',
                'C.name_en',
                DB::raw('count(Tr.gender) as gender1'),
                'Tr.gender',
                'T.course_begin_date',
                'T.course_end_date',
                'T.sponsored_by',
                'T.beneficiary',
                'A.name'
               )
            
            ->groupBy('Tr.gender','C.name_ar')
            ->orderBy('C.name_ar', 'desc')
            //->orderBy('C.id', 'ASC')
            ->get();

            foreach($courses_trainee as $ct)
            {
              $cc=$ct->id;
              if (!empty($cc)){
                                    $training=Training::find($cc);
                                    if (!empty($training->id))
                                    {
                                        if ($ct->gender == 'Male')
                                        {
                                        $training->Male = $ct->gender1;
                                        }elseif ($ct->gender == 'Female')
                                        {
                                        $training->Female = $ct->gender1;
                                        }
                                    $training->save();
                                    }
                              }
            }
            

        return Excel::download(new AggExport3($request->TDate,$request->EDate), 'AggregationReport3.xlsx');//->with('TDate',$TDate);
    }





    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     
     //$data = Excel::load(new TraineeImport, $path)->get();
     
     Excel::import(new TraineeImport,$path);

     $data = DB::table('trainees')->orderBy('id', 'DESC')->get();
    // return view('trainees.index')->with('success', 'Excel Data Imported successfully.');
     //return back()->with('success', 'Excel Data Imported successfully.');

     $request->session()->flash('status', 'Excel Data Imported successfully.');
	 return redirect()->route('trainees.index');

    }
     /* 
     if($data->count() > 0)
     {
      foreach($data->toArray() as $key => $value)
      {
       foreach($value as $row)
       {
        $insert_data[] = array(
         'name'  => $row['name'],
         'dob'   => $row['dob'],
         'identification_no'   => $row['identification_no'],
         'area_id'    => $row['area_id'],
         'address'  => $row['address'],
         'gender'   => $row['gender'],
         'phone_no'   => $row['phone_no'],
         'major'   => $row['major'],
         'email'   => $row['email']
        );
       }
      }

      if(!empty($insert_data))
      {
       DB::table('trainees')->insert($insert_data);
      }
     }
     return back()->with('success', 'Excel Data Imported successfully.');
    } */
}
