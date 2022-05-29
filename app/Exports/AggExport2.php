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



class AggExport2 implements FromCollection, WithHeadings,ShouldAutoSize, WithMapping
{
    
    /**
    * @return \Illuminate\Support\Collection
    */



    public function Collection()
    {
       
        /* $courses = DB::table('courses');
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
        ->orderBy('C.name_ar', 'desc')
        ->get();
    return $trainings;

    }

   
      public function map($trainings): array{
        $fields = [
         
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
