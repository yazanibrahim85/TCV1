<?php

namespace App\Exports;

use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery; 


use DB;



class AggExport implements FromCollection, WithHeadings,ShouldAutoSize, WithMapping
{
    //use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

/*     public function query()
    {
        $courses_traineesData=DB::select("SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id");
        //$courses_traineesData = $courses_traineesData->unique('course_id'); 
        //$courses_traineesData = array_slice($courses_traineesData->values()->all(), 0, 5, true);  
        return $courses_traineesData;
    } */

    public function Collection()
    {
        //select count(distinct courses_trainees.course_id),count(courses_trainees.trainee_id) from courses_trainees
       
        $courses_trainee = DB::table('courses_trainees as CT')
            ->select(
             
                DB::raw('count(distinct CT.course_id) as NumberOfTrainings'),
                DB::raw('count(CT.trainee_id) as NumberOfTrainees')
               )
           
            ->get();
        return $courses_trainee;

        //return Course::all();
        
        //return DB::select('SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id')->get();
       // return $course;
        //return DB::select('SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id');
 /*     $courses_data = DB::select('SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id');
     $courses_array[] = array('course_id', 'trainee_id');
     foreach($courses_data as $courses)
     {
      $courses_array[] = array(
       'course_id'  => $courses->course_id,
       'trainee_id'   => $courses->trainee_id
       
      );
     } */
    }

    /* public function collection()
    {
        //SELECT * FROM `courses_trainees` left outer join courses on courses.id=courses_trainees.course_id left outer join trainees ON trainees.id=courses_trainees.trainee_id left outer join trainings on trainings.id=courses_trainees.training_id
       
        $courses_traineesData=DB::select("SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id");
        //$courses_traineesData = $courses_traineesData->unique('course_id'); 
        //$courses_traineesData = array_slice($courses_traineesData->values()->all(), 0, 5, true);  
        return $courses_traineesData;
    }
 */
      public function map($courses_trainee): array{
        $fields = [
          // $courses_trainee->id,
           $courses_trainee->NumberOfTrainings,
           $courses_trainee->NumberOfTrainees,
        

      ];
     return $fields;
 } 
 


    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */

    /* public function actions(Request $request)
    {
    return [
        (new DownloadExcel)->withHeadings(),
    ];
    } */

    public function headings(): array
    {
        return [
            
           // 'Course_id',
            'Number Of Trainings',
            'Number Of Trainees', 
       
        ];
    }


}
