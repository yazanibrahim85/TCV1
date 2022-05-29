<?php



namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;
use App\courses_trainers;
use App\courses_trainees;

use Session;

use Illuminate\Http\Request;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
    /**
     * Display a listing of the resource.
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
          
            return view('trainings.index',['trainings' => $trainings,'role_id'=>$role_id]);


        }elseif($role_id==2)
        {
            $user=auth()->user();

            $area_id=DB::select('select areas.id from areas,users where users.area_id=areas.id and users.id=?',[Auth::id()]);
            $area_id=$area_id[0]->id;
           //dd($area_id);
            
            $trainings=DB::select('select trainings.* from areas,trainings where trainings.area_id=areas.id and areas.id='.$area_id.' order by trainings.id desc ');
            
            return view('trainings.index',['trainings' => $trainings,'role_id'=>$role_id]);
    
        }else
        {
            return view('trainings.index',['trainings'=>Training::paginate(5),'role_id'=>$role_id]);
                //dd($trainings ."". $trainingsCount);
        }
        //return view('trainings.index', ['trainings'=>Training::paginate(5)]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /*  $roles=Role::all();
		if($roles->count()==0){
			Session::flash('Success', 'you must have at least 1 role created before attempting to create an employee');
			return redirect()->back();
		} */
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        return view('trainings.create', ['courses' => $courses,'trainers' => $trainers,'trainees' => $trainees]);

       // return view('');//->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
			'course_id' => 'required',
			'participants_no' => 'required',
            'training_hours' => 'required',
            'course_begin_date' => 'required',
            'course_end_date' => 'required',
			'expiration_date' => 'required',
            'sponsored_by' => 'required',
            'beneficiary' => 'required',
            'area_id' =>'required',
            'location' => 'required',
			
		]);
        //$courses_id = DB::table('courses')->select('id')->where('name_ar', '=', "'".$request->course_id."'")->get();
        //dd($courses_id);
        //$courses_id='test';
        $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
		//dd($courses_id[0]->id);
        $courses_id=$courses_id[0]->id;

        $areas_id=DB::select('select id from areas where name =?', [$request->area_id]);
        // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
         //dd($courses_id[0]->id);
         $areass_id=$areas_id[0]->id;
            //dd($areass_id);
           

        $trainings = Training::create([
            //$courses=Course::all();
           
            //$request->course_id;
			'course_id' => $courses_id,
			'participants_no' => $request->participants_no,
            'training_hours' => $request->training_hours,
            'course_begin_date' => $request->course_begin_date,	
            'course_end_date' => $request->course_end_date,	
			'expiration_date' => $request->expiration_date,
            'sponsored_by' => $request->sponsored_by,	
            'beneficiary' => $request->beneficiary,
            'area_id' =>$areass_id,
			'location' => $request->location,
			
            'user_id' => Auth::id(),
		]);
		
		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$trainings->save();
        //dd(count($request->Trainers_name));
       // dd(count($request->Trainers_name));
        //$xx=6;
        $trainersCount=count($request->Trainers_name);
        for ($x = 0;$x<$trainersCount;$x++)
        {
            $trainerr_id=DB::select('select id from trainers where name =?', [$request->Trainers_name[$x]]);
            // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
             //dd($courses_id[0]->id);
             $trainerr_id=$trainerr_id[0]->id;

             $training_id=DB::table('trainings')->latest('id')->first();
             //$training_id=$training_id[0];
             //dd( $training_id->id);
        $courses_trainers = courses_trainers::create([

          
            //$request->course_id;
			'course_id' => $courses_id,
			'trainer_id' => $trainerr_id,
            'training_id'=>$training_id->id,
		]);
        }
		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$courses_trainers->save();


        $traineesCount=count($request->participants_name);
        for ($x = 0;$x<$traineesCount;$x++)
        {
            $traineee_id=DB::select('select id from trainees where name =?', [$request->participants_name[$x]]);
            // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
             //dd($courses_id[0]->id);
             $traineee_id=$traineee_id[0]->id;
             $training_id=DB::table('trainings')->latest('id')->first();
             $courses_trainees = courses_trainees::create([

			'course_id' => $courses_id,
			'trainee_id' => $traineee_id,
            'training_id'=>$training_id->id,
		]);
        }
	
		$courses_trainees->save();

		
		
		$request->session()->flash('status', 'A New Training created');
		return redirect()->route('trainings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();

        $Numberoftrainers=DB::select('select count(*) as cc from courses_trainers,trainings where trainings.id=courses_trainers.training_id and training_id =?', [$id]);
        $Numberoftrainers=$Numberoftrainers[0]->cc;
        //dd($Numberoftrainers);
        $NumberoftrainingHours=DB::select('select training_hours from trainings where id=?', [$id]);
        $NumberoftrainingHours=$NumberoftrainingHours[0]->training_hours;
        $TrainerName=DB::select('select trainers.name from trainers,courses_trainers,trainings where trainers.id=courses_trainers.trainer_id and trainings.id=courses_trainers.training_id and training_id =?', [$id]);
        //dd($TrainerName);
        //$TrainerName=$TrainerName[0]->cc;

        $TraineeName=DB::select('select trainees.name from trainees,courses_trainees,trainings where trainees.id=courses_trainees.trainee_id and trainings.id=courses_trainees.training_id and training_id =?', [$id]);
        //dd($TraineeName);
        //$TraineeName=$TraineeName[0]->cc;



        $Numberoftrainees=DB::select('select count(*) as cc from courses_trainees,trainings where trainings.id=courses_trainees.training_id and training_id =?', [$id]);
        $Numberoftrainees=$Numberoftrainees[0]->cc;

        $courseName=DB::select('select courses.name_ar from courses,trainings where trainings.course_id=courses.id and trainings.id =?', [$id]);
        //$courseName=$courseName[0]->name_ar;
       // dd($courseName);

       // ['courses' => $courses,'trainers' => $trainers,'trainees' => $trainees]
        return view('trainings.show', ['id'=>$id,'TraineeName'=>$TraineeName,'TrainerName'=>$TrainerName,'courseName'=>$courseName,'trainings'=>Training::find($id) ,'courses' => $courses,'trainers' => $trainers,'NumberoftrainingHours'=>$NumberoftrainingHours,'trainees' => $trainees,'Numberoftrainers'=>$Numberoftrainers,'Numberoftrainees'=>$Numberoftrainees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courses=Course::all();
        $trainers=Trainer::all();
        $trainees=Trainee::all();
       // ['courses' => $courses,'trainers' => $trainers,'trainees' => $trainees]
        return view('trainings.edit', ['trainings'=>Training::find($id) ,'courses' => $courses,'trainers' => $trainers,'trainees' => $trainees]);
											//'roles'=>Role::all() */]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $trainings=Training::findOrFail($id);
		$this->validate($request,[
            'course_id' => 'required',
			'participants_no' => 'required',
            'training_hours' => 'required',
            'course_begin_date' => 'required',
			'expiration_date' => 'required',
            'location' => 'required',
			
		]);
        $coursee_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
       // dd($coursee_id[0]->id);
        $trainings->course_id=$coursee_id[0]->id;

        $trainings->participants_no = $request->participants_no;
        $trainings->training_hours = $request->training_hours;
        $trainings->course_begin_date = $request->course_begin_date;
        $trainings->course_end_date = $request->course_end_date;
        $trainings->expiration_date = $request->expiration_date;
        $trainings->beneficiary = $request->beneficiary;
        $trainings->sponsored_by = $request->sponsored_by;
        $trainings->location = $request->location;
        

		$trainings->save();

		
            /*Delete All Old Data*/
       
        DB::table('courses_trainers')->where('training_id', $id)->delete();
        DB::table('courses_trainees')->where('training_id', $id)->delete();
            /************************************ */
            $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
            //dd($courses_id[0]->id);
            $courses_id=$courses_id[0]->id;
    
            $areas_id=DB::select('select id from areas where name =?', [$request->area_id]);
            // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
             //dd($courses_id[0]->id);
             $areass_id=$areas_id[0]->id;


        $trainersCount=count($request->Trainers_name);
        for ($x = 0;$x<$trainersCount;$x++)
        {
            $trainerr_id=DB::select('select id from trainers where name =?', [$request->Trainers_name[$x]]);
            // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
             //dd($courses_id[0]->id);
             $trainerr_id=$trainerr_id[0]->id;

             $training_id=DB::table('trainings')->latest('id')->first();
             //$training_id=$training_id[0];
             //dd( $training_id->id);
            $courses_trainers = courses_trainers::create([

          
            //$request->course_id;
			'course_id' => $courses_id,
			'trainer_id' => $trainerr_id,
            'training_id'=>$training_id->id,
		]);
        }
		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$courses_trainers->save();


        $traineesCount=count($request->participants_name);
        for ($x = 0;$x<$traineesCount;$x++)
        {
            $traineee_id=DB::select('select id from trainees where name =?', [$request->participants_name[$x]]);
            // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
             //dd($courses_id[0]->id);
             $traineee_id=$traineee_id[0]->id;
             $training_id=DB::table('trainings')->latest('id')->first();
             $courses_trainees = courses_trainees::create([

			'course_id' => $courses_id,
			'trainee_id' => $traineee_id,
            'training_id'=>$training_id->id,
		]);
        }
	
		$courses_trainees->save();




		$request->session()->flash('status', 'Training records has been updated !');
		return redirect()->route('trainings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request,$id)
    {
        $trainings=Training::findOrFail($id);
        DB::table('courses_trainers')->where('training_id', $id)->delete();
        DB::table('courses_trainees')->where('training_id', $id)->delete();
		$trainings->delete();
        /* $courses_trainees->delete();
        $courses_trainers->delete(); */
		$request->session()->flash('status', 'Training Deleted !!');
		//session()->flash('success','trainees deleted');
		return redirect()->route('trainings.index');
    }
	
	public function bin(){
		$trainings=Training::onlyTrashed()->get();
		return view('trainings.bin')->with('trainings', $trainings);
	}
	
	public function restore($id){
		$trainings=Training::withTrashed()->where('id', $id)->first();
		$trainings->restore();
		
		Session::flash('success', 'The Trainer user account is restored.');
		return redirect()->route('trainings.index');
	}
	
	public function kill($id){
		$trainings=Training::withTrashed()->where('id', $id)->first();
	/* 	foreach($employee->payrolls as $payroll):
			$payroll->delete();
		endforeach; */
		
		$trainings->forceDelete();
		
		Session::flash('success', 'The Training has been permanently destroyed.');
		return redirect()->route('trainings.index');
	}
}
