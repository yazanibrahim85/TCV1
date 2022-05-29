<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

class ExportExcelController extends Controller
{
    function index()
    {
     $courses_data = DB::select('SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id');
     return view('export_excel')->with('courses_data', $courses_data);
    }

    function excel()
    {
     $courses_data = DB::select('SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id');
     $courses_array[] = array('course_id', 'trainee_id');
     foreach($courses_data as $courses)
     {
      $courses_array[] = array(
       'course_id'  => $courses->course_id,
       'trainee_id'   => $courses->trainee_id
       
      );
     }
     /*  Excel::create('Courses Data', function($excel) use ($courses_array){
      $excel->setTitle('Courses Data');
      $excel->sheet('Courses Data', function($sheet) use ($courses_array){
       $sheet->fromArray($courses_array, null, 'A1', false, false);
      });
     })->download('xlsx'); */
    /*  return Excel::download('Courses Data', function($excel) use ($courses_array){
        $excel->setTitle('Courses Data');
        $excel->sheet('Courses Data', function($sheet) use ($courses_array){
         $sheet->fromArray($courses_array, null, 'A1', false, false);
        });
       }, 'AggregationReport.xlsx');  */
    }
}
