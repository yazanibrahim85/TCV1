<?php




namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Trainer;
use App\Trainee;
use App\Course;
use App\Training;

use Session;

use Illuminate\Http\Request;

class TrainerController extends Controller
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
            $trainers=$user->trainers;
          
            return view('trainers.index',['trainers' => $trainers,'role_id'=>$role_id]);


        }elseif($role_id==2)
        {
            $user=auth()->user();

            $area_id=DB::select('select areas.id from areas,users where users.area_id=areas.id and users.id=?',[Auth::id()]);
            $area_id=$area_id[0]->id;
           //dd($area_id);
            
            $trainers=DB::select('select trainers.* from areas,trainers where trainers.area_id=areas.id and areas.id='.$area_id.' order by trainers.id desc ');
            
            return view('trainers.index',['trainers' => $trainers,'role_id'=>$role_id]);
    
        }else
        {
                return view('trainers.index',['trainers'=>Trainer::paginate(5),'role_id'=>$role_id]);
                //dd($trainings ."". $trainingsCount);
        }
        //return view('trainings.index', ['trainings'=>Training::paginate(5)]);
    
       // return view('trainers.index', ['trainers'=>Trainer::paginate(5)]);
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

        return view('trainers.create');//->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        //dd($request->area_name);
        //dd($request->area_id);

        $this->validate($request,[
            'area_id'=>'required',
			'name' => 'required|max:190',
			'address' => 'required',
			'phone_no' => 'required',
            'major' => 'required',
			'email' => 'required',
            
		]);
        //dd($request->area_id);
  
            
        $areas_id=DB::select('select id from areas where name =?', [$request->area_id]);
       // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
		//dd($courses_id[0]->id);
        $areass_id=$areas_id[0]->id;
        //dd($areas_id[0]->id);

		$trainers = Trainer::create([
            'area_id' => $areass_id,
			'name' => $request->name,
			'address' => $request->address,
			'phone_no' => $request->phone_no,
			'major' => $request->major,
			'email' => $request->email,
            
            'user_id' => Auth::id(),		
		]);
		
      
		//dd($areas_id[0]->id);
       // dd($request->area_name);
       // $area_id=$areas_id[0]->id;

		/* $payroll = new Payroll;
		$payroll->employee_id = $employee->id;
		$payroll->save(); */
		$trainers->save();
		
		
		$request->session()->flash('status', 'New Trainer created');
		return redirect()->route('trainers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $Numberoftrainings=DB::select('select count(*) as cc from courses_trainers where trainer_id =?', [$id]);
        // $courses_id=DB::select('select id from courses where name_ar =?', [$request->course_id]);
         //dd($Numberoftrainings[0]->cc);
         $Numberoftrainings=$Numberoftrainings[0]->cc;

         $TrainersCoursesinfo=DB::select("select courses.name_ar,trainings.participants_no,trainings.expiration_date,trainings.location,trainings.course_begin_date from trainings,courses_trainers,courses where courses.id=trainings.course_id and trainings.id=courses_trainers.training_id and courses_trainers.trainer_id=".$id);
        


        return view('trainers.show',['trainers'=>Trainer::findOrFail($id),'countTr'=>$Numberoftrainings,'TrainersCoursesinfo'=>$TrainersCoursesinfo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('trainers.edit', ['trainers'=>Trainer::find($id)/* ,
											'roles'=>Role::all() */]);
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
        $trainers=Trainer::findOrFail($id);
		$this->validate($request,[
			'name' => 'required|max:190',
			'address' => 'required',
			'phone_no' => 'required',
            'major' => 'required',
			'email' => 'required',
            
            
		]);
        $trainers->name = $request->name;
        $trainers->address = $request->address;
        $trainers->phone_no = $request->phone_no;
        $trainers->major = $request->major;
        $trainers->email = $request->email;
        

		$trainers->save();
		
		$request->session()->flash('status', 'Trainer records has been updated !');
		return redirect()->route('trainers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
	public function destroy(Request $request,$id)
    {
        $trainers=Trainer::findOrFail($id);
		$trainers->delete();
		$request->session()->flash('status', 'Trainer Deleted !!');
		//session()->flash('success','trainees deleted');
		return redirect()->route('trainers.index');
    }
	
	public function bin(){
		$trainers=Trainer::onlyTrashed()->get();
		return view('trainers.bin')->with('trainers', $trainers);
	}
	
	public function restore($id){
		$trainers=Trainer::withTrashed()->where('id', $id)->first();
		$trainers->restore();
		
		Session::flash('success', 'The Trainer user account is restored.');
		return redirect()->route('trainers.index');
	}
	
	public function kill($id){
		$trainers=Trainer::withTrashed()->where('id', $id)->first();
	/* 	foreach($employee->payrolls as $payroll):
			$payroll->delete();
		endforeach; */
		
		$trainers->forceDelete();
		
		Session::flash('success', 'The Trainer account has been permanently destroyed.');
		return redirect()->route('trainers.index');
	}
}
