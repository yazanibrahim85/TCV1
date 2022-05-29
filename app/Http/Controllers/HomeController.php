<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;
use App\User;
use Session;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role_id=DB::select('select role_id from users where id=?',[Auth::id()]);
        $role_id=$role_id[0]->role_id;
        //$courseName=DB::select('select courses.name_ar from courses');
        if ($role_id==3)
        {
            $user=auth()->user();
            $trainings=$user->trainings;
            //dd(count($trainings));
            $trainers=$user->trainers;
            $trainees=$user->trainees;
            $dateofToday=date("Y-m-d");
            $trainingsonGoing=DB::select("select trainings.id,courses.name_en,courses.name_ar from trainings,courses where trainings.course_id=courses.id and trainings.course_begin_date <='".$dateofToday."' and trainings.course_end_date>='".$dateofToday."'");
            return view('dashboard',['trainings' => $trainings,
            'trainingsCount' => count($trainings),
            'trainingsonGoing'=>$trainingsonGoing,
            'trainingsonGoingCount'=>count($trainingsonGoing),
            'coursesCount' =>Course::count(),
            'courses' =>Course::take(4)->orderBy('id', 'DESC')->get(),
            'trainees'=>$trainees,
            'traineesCount' => count($trainees),
            'trainers'=>$trainers,
            'trainersCount' => count($trainers)]);


        }elseif($role_id==2)
        {
            $user=auth()->user();
            
            $area_id=DB::select('select areas.id from areas,users where users.area_id=areas.id and users.id=?',[Auth::id()]);
            $area_id=$area_id[0]->id;
           //dd($area_id);
            
            $trainings=DB::select('select trainings.* from areas,trainings where trainings.area_id=areas.id and areas.id='.$area_id.' order by trainings.id desc ');
           // $datetoday=date("Y-m-d");
            //$datetoday='2021-11-20';
            //$datetoday="'".$datetoday."'";
            //echo $datetoday;
            $dateofToday=date("Y-m-d");
            $trainingsonGoing=DB::select("select trainings.id,courses.name_en,courses.name_ar from trainings,courses where trainings.course_id=courses.id and trainings.course_begin_date <='".$dateofToday."' and trainings.course_end_date>='".$dateofToday."'");
            //dd($trainings); 
            $trainers=DB::select('select trainers.* from areas,trainers where trainers.area_id=areas.id and areas.id='.$area_id.' order by trainers.id desc ');
            $trainees=DB::select('select trainees.* from areas,trainees where trainees.area_id=areas.id and areas.id='.$area_id.' order by trainees.id desc ');
            return view('dashboard',['trainings' => $trainings,
            'trainingsCount' => count($trainings),
            'trainingsonGoing'=>$trainingsonGoing,
            'trainingsonGoingCount'=>count($trainingsonGoing),
            'coursesCount' =>Course::count(),
            'courses' =>Course::take(4)->orderBy('id', 'DESC')->get(),
            'trainees'=>$trainees,
            'traineesCount' => count($trainees),
            'trainers'=>$trainers,
            'trainersCount' => count($trainers)]);
    
        }else
        {
            $dateofToday=date("Y-m-d");
            $trainingsonGoing=DB::select("select trainings.id,courses.name_en,courses.name_ar from trainings,courses where trainings.course_id=courses.id and trainings.course_begin_date <='".$dateofToday."' and trainings.course_end_date>='".$dateofToday."'");
             
                return view('dashboard',['trainings' => Training::take(4)->orderBy('id', 'DESC')->get(),
                'trainingsCount' => Training::count(),
                'trainingsonGoing'=>$trainingsonGoing,
                'trainingsonGoingCount'=>count($trainingsonGoing),
                'coursesCount' =>Course::count(),
                'courses' =>Course::take(4)->orderBy('id', 'DESC')->get(),
                'trainees'=>Trainee::take(4)->orderBy('id', 'DESC')->get(),
                'traineesCount' => Trainee::count(),
                'trainers'=>Trainer::take(4)->orderBy('id', 'DESC')->get(),
                'trainersCount' => Trainer::count()]);
                //dd($trainings ."". $trainingsCount);
        }
        
        
    }
}
