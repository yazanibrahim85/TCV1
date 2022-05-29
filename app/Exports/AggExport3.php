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



class AggExport3 implements FromCollection, WithHeadings,ShouldAutoSize, WithMapping
{
    //use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $TDate;
    protected $EDate;
    function __construct($TDate,$EDate) {
            $this->TDate = $TDate;
            $this->EDate = $EDate;
    }

/*     public function query()
    {
                $courses_traineesData=DB::select("SELECT courses_trainees.course_id,courses_trainees.trainee_id FROM courses_trainees left outer join courses on courses.id=course_id left outer join trainees ON trainees.id=trainee_id left outer join trainings on trainings.id=training_id");
                //$courses_traineesData = $courses_traineesData->unique('course_id'); 
                //$courses_traineesData = array_slice($courses_traineesData->values()->all(), 0, 5, true);  
                return $courses_traineesData;


       select C.name_ar,C.name_en,T.course_begin_date,T.course_end_date,T.sponsored_by,T.beneficiary,trainees.gender,count(trainees.gender) from courses_trainees CT 
       left outer join courses C on CT.course_id=C.id 
       left outer join trainings T on T.course_id=C.id 
       left outer join trainees on trainees.id=CT.trainee_id 
       group by C.name_ar,trainees.gender

    } */

     public function Collection()
    {
       
       /*  $courses = DB::table('courses');
        $trainings=DB::table('trainings');
        $trainees=DB::table('trainees');
        $areas=DB::table('areas');
        $courses_trainee = DB::table('courses_trainees as CT')
            ->leftJoinSub($courses, 'C', 'C.id','=','CT.course_id')
            ->LeftJoinSub($trainees,'Tr','Tr.id','=','CT.trainee_id')
            ->LeftJoinSub($trainings,'T','T.course_id','=','C.id')
            ->leftJoinSub($areas,'A','A.id','=','T.area_id')
            ->select(
             
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
        return $courses_trainee; */

        $courses = DB::table('courses');
        $areas=DB::table('areas');
        $trainings=DB::table('trainings as T')
        ->leftJoinSub($courses, 'C', 'C.id','=','T.course_id')
        ->leftJoinSub($areas,'A','A.id','=','T.area_id')
        ->select(
            'C.name_ar',
            'C.name_en',
            'T.participants_no',
            'T.Female',
            'T.Male',
            'T.course_begin_date',
            'T.course_end_date',
            'T.sponsored_by',
            'T.beneficiary',
            'A.name'
           )
           ->where('T.course_begin_date', '>=', $this->TDate)
           ->where('T.course_begin_date', '<=', $this->EDate)
        ->orderBy('C.name_ar', 'desc')
        ->get();
    return $trainings;
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
      public function map($trainings): array{
        $fields = [
          // $courses_trainee->id,
          $trainings->name_ar,
          $trainings->name_en,
          $trainings->participants_no,
          $trainings->Female,
          $trainings->Male,
          $trainings->course_begin_date,
          $trainings->course_end_date,
          $trainings->sponsored_by,
          $trainings->beneficiary,
          $trainings->name, 


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
            
            'Name_Ar',
            'Name_En', 
            'Summation of Gender',
            'Female',
            'Male',
            'Training Begin Date',
            'Training End Date',
            'Sponsored By',
            'Beneficiary',
            'Area Name', 
        ];
    }


}
